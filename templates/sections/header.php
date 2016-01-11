<header id="header">
    <div class="fixed">
        <div class="container">
            <section class="header-left">
                <a href="<?php print $front_page;?>">
                    <svg id="twc-logo--header">
                        <use xlink:href="<?php echo THEMEDIR; ?>/assets/img/twc-assets.svg#twc-logo"/>
                    </svg>
                </a>
            </section>

            <section class="header-right">
                <nav id="quick-links--header" class="quick-links">
                    <?php print render($page['header_quick_links']); ?>
                </nav>

                <nav id="main-menu--header">
                    <?php print render($page['main_menu']); ?>
                </nav>
            </section>
        </div>
    </div>
</header>