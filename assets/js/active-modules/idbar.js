(function($){
    var shown = {shown:false},
        idbar = {search: shown},
        search;

    // Initialize RitProd global variable for configuration storage if it's not already done.
    if (window.hasOwnProperty('RitProd'))
    {
        if (RitProd.hasOwnProperty('idbar'))
        {
            RitProd.idbar.search = shown;
        }
        else
        {
            RitProd.idbar = idbar;
        }
    }
    else
    {
        RitProd = {idbar: idbar};
    }

    search = RitProd.idbar.search;

    $(document).ready(function() {
        search.toAnimate = $('.search-container,#idbar-search-button,#idbar-menu-button');
        search.menuCloseButton = $('#idbar-search-close-button');

        // Assign the click handler to the mobile-search button
        $('#idbar-search-button').on('click', function()
        {
            if(!RitProd.idbar.search.shown) {
                search.resizeSearch();
            }
            else
            {
                search.resetSearch();
            }
        });

        search.menuCloseButton.on('click', function() {
            search.resetSearch();
        });
    });

    /**
     * Abstracted the transforms into a traslate function
     * @param width
     * @returns {{-webkit-transform: string, -moz-transform: string, transform: string}}
     */
    search.translate = function(width) {
        return {
            '-webkit-transform': 'translate3d(' + width + ',0,0)',
            '-moz-transform': 'translate3d(' + width + ',0,0)',
            'transform': 'translate3d(' + width + ',0,0)'
        }
    };

    /**
     * Resizes the search based on the window size.
     * TODO: Add Calc support.
     */
    search.resizeSearch = function(){
        var windowWidth = $(window).width(),
            buttonWidth = $('#idbar-search-button').innerWidth(),
            animateWidth = -windowWidth + buttonWidth + "px",
            menuCloseWidth = -windowWidth * .10 + "px";

        search.toAnimate.css(search.translate(animateWidth));
        search.menuCloseButton.css(search.translate(menuCloseWidth));
        RitProd.idbar.search.shown = true;
    };

    /**
     * Resets the search size to 0, so it's hidden.
     */
    search.resetSearch = function() {
        search.toAnimate.css(search.translate("0"));
        search.menuCloseButton.css(search.translate("0"));
        RitProd.idbar.search.shown = false;
    };

})(jQuery);

(function($) {

    var menuButton,
        menu;

    RitProd.idbar.menu = {
        shown: false
    };

    $(document).ready(function() {
        menuButton = $('#idbar-menu-button');

        menuButton.on('click', function() {
            $('body').toggleClass('mobile-out');
        });
    });

    menu = RitProd.idbar.menu;
    menu.menuButton = menuButton;

    menu.showMenu = function() {
        $('body').addClass('mobile-out');
    };

    menu.hideMenu = function() {
        $('body').removeClass('mobile-out');
    };


})(jQuery);