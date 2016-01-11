(function($) {

    $(document).ready(function() {    // This function gets whether it's mobile or Desktop.  Only apply the "fixed" state to the header if on desktop.
        // This function returns the CSS "content" property of a hidden div.  This is located in the IDBar, and the css is in _idbar.scss
        window.checkMobile = function ()
        {
            return getComputedStyle(jQuery('#MobileCheck')[0]).content.replace(/\"/g, '') == "mobile";
        };
        isMobile = checkMobile();

        // TWC Giving page clickers
        $('.tab').on('click', function () {
            var t = $(this),
                tabContainer = $(this).parent(),
                pages = $('.page-tab'),
                pageContainer = pages.parent(),
                isActive = t.hasClass('tab-active');

            var removeTabActiveClass = function () {
                tabContainer.find('.tab-active').removeClass('tab-active');
            };

            pageContainer.find('.active').removeClass('active').slideUp();
            tabContainer.find('.accordion.active').removeClass('active').slideUp(removeTabActiveClass);

            if (!isMobile)
            {
                removeTabActiveClass();
            }

            if (!isActive)
            {
                t.addClass('tab-active');
                pageContainer.find('#' + t.data('for')).addClass('active').slideDown();
                t.next('.accordion').addClass('active').slideDown();
            }
            else
            {
                pageContainer.find('.default').addClass('active').slideDown();
                $('.accordion.default').addClass('active').slideDown();
            }
        });

        // TWC Staff Page Fuzzy Search
        searchedStaff = allStaff = $('.staff-pod');
        filteredLetter = null;

        var addAllActiveClass = function() {
            $('.letter.active').removeClass('active');
            $('.letter.all').addClass('active');
        };

        var staffSearch = function(search) {
            var t = $(this);
            var val = "";
            var staff = searchedStaff;
            var re; // regex placeholder

            if (t.is($(window)))
            {
                // if this is the window, we're calling this on document load.  Otherwise, it's being called on keypress
                // so we need to set the variables for each case.
                t = $('#staff-search');
                val = search.replace('-', ' ');
                t.val(val);
                re = new RegExp(val.replace(/\s+/, '\\s+'));
            }
            else
            {
                val = t.val();
                re = new RegExp(val.toLowerCase().replace(/\s+/, '\\s+'))
            }

            removeNoResultsText();

            if (filteredLetter)
            {
                filteredLetter = null;
                addAllActiveClass();
            }

            if (val.length >= 2)
            {
                staff.each(function(){
                    if ($(this).find('.name').html().toLowerCase().match(re))
                    {
                        $(this).appendTo("#shown-staff");
                    }
                    else
                    {
                        $(this).appendTo("#hidden-staff");
                    }
                });
                searchedStaff = staff;

                checkForNoResults("No staff members matching '"+val+"' found.");
            }
            else
            {
                // we use allStaff here so that the original order is preserved.
                allStaff.each(function() { $(this).appendTo("#shown-staff"); });
                searchedStaff = allStaff;
            }
        };

        $('#staff-search').on('keyup', staffSearch);

        var staffLetterSelector = function () {
            var t = $(this),
                staff = allStaff;

            removeNoResultsText();
            $('#staff-search').val('');

            if (t.html().toLowerCase() == "all")
            {
                filteredLetter = null;
                allStaff.each(function() {
                    $(this).appendTo("#shown-staff");
                });

                addAllActiveClass();
            }
            else
            {
                filteredLetter = t.html().trim();
                re = new RegExp(filteredLetter);
                allStaff.each(function() {
                    if ($(this).find('.name').html().match(re))
                    {
                        $(this).appendTo("#shown-staff");
                    }
                    else
                    {
                        $(this).appendTo("#hidden-staff");
                    }
                });
                searchedStaff = $('#shown-staff').find('.staff-pod');

                checkForNoResults('No staff members were found with a first or last name beginning with '+filteredLetter+'.');

                $('.letter.active').removeClass('active');
                t.addClass('active');
            }
        };

        var servicesLetterSelector = function() {

            var t = $(this),
                services = $('.all-services-table'),
                noResultsRow = services.find('.no-results'),
                letter = "all";

            letter = t.html().toLowerCase();
            noResultsRow.find('.letter').html(letter.toUpperCase());

            if (letter == "all")
            {
                services.find('tr').show();
                addAllActiveClass();
            }
            else
            {
                var countOfServices = 0;
                services.find('tr').each(function() {
                    if ($(this).hasClass('no-results'))
                    {
                        return;
                    }
                    var p = $(this).find('td').first().children(),
                        a = p.children(),
                        thisLetter;

                    if (a.html() == undefined)
                    {
                        thisLetter = p.html().substring(0, 1);
                    }
                    else
                    {
                        thisLetter = a.html().substring(0, 1);
                    }

                    if (letter.toUpperCase() != thisLetter.toUpperCase())
                    {
                        $(this).hide();
                    }
                    else
                    {
                        $(this).show();
                        countOfServices++;
                    }
                });

                if (countOfServices > 0)
                {
                    noResultsRow.hide();
                }
                else
                {
                    noResultsRow.show();
                }
            }
        };

        $('#letter-selector').on('click', '.letter', function(e) {
            e.preventDefault();

            if ($('body').hasClass("page-node-463")) // if it's the services page
            {
                servicesLetterSelector.bind(this)();
            }
            else
            {
                staffLetterSelector.bind(this)();
            }
        });

        $(document).on('ready', function() {
            if ($('#staff-directory').length)
            {
                if (hash = window.location.hash)
                {
                    staffSearch(hash.substr(1));
                }
            }

            // Add last row in hidden state to the all services table that says no services could be found
            var noResultsRow = $('<tr style="display: none;" class="no-results"><td colspan="4" style="text-align:center; padding-top: 67px; border-bottom: 0;">No Results Found for Services starting with <span class="letter"></span></td></tr>'),
                services = $('.all-services-table');

            services.append(noResultsRow);

        });

        function checkForNoResults(errorMessage) {
            if ($('#shown-staff').find('.staff-pod').length == 0)
            {
                $('#shown-staff').append('<div class="no-results">'+errorMessage+'</div>');
            }
        }

        function removeNoResultsText() {
            $('.no-results').remove();
        }

        $(window).resize(function() {
            isMobile = checkMobile();
        });

        function scrollTop() {
            $('html, body').animate({
                scrollTop: 0
            },500);
        }

        $(".backtotop").click(function(){ scrollTop(); });

        $(window).on('scroll', function() {
            var top = $(this).scrollTop();
            $('.backtotop').toggleClass('shown', top>400);
            if (!isMobile)
            {
                $('body').toggleClass('fixed-header', top>52);
                $('body').toggleClass('shrunk-header', top>100);
            }
        });


        // Only make top level nav items clickable in the footer menu
        $('#main-menu--header .has-dropdown > a, #mobile-menu .has-dropdown > a').click(function (e) {e.preventDefault();});

        $('#mobile-menu .has-dropdown > a').click(function() {
            if ($(this).next('ul').is(':visible')) {
                $(this).removeClass('open');
            }
            else
            {
                $(this).addClass('open');
            }

            $(this).next('ul').slideToggle();
        });

        $(document).on('click', 'body.mobile-out', function(e){
            if ($('body').is(e.target)) {
                e.preventDefault();
                RitProd.idbar.menu.hideMenu();
            }
        })

    });
})(jQuery);