    <div id="MobileCheck"></div>
    <div class="center clearfix">
        <div id="idbar-menu-button">
            <svg id="menu-button-svg">
                <use xlink:href="<?php echo THEMEDIR; ?>/assets/img/idbar.svg#icon-idbar-menu-icon"/>
            </svg>
        </div>
        <div class="rit-logo">
            <a href="http://rit.edu" target="_blank">
                <svg id="rit-logo-rit">
                    <use xlink:href="<?php echo THEMEDIR; ?>/assets/img/idbar.svg#icon-idbar-rit-logo-rit"/>
                </svg>
                <svg id="rit-logo-text">
                    <use xlink:href="<?php echo THEMEDIR; ?>/assets/img/idbar.svg#icon-idbar-rit-logo-text"/>
                </svg>
            </a>
        </div>
        <div id="idbar-search-button">
            <svg>
                <use xlink:href="<?php echo THEMEDIR; ?>/assets/img/idbar.svg#icon-idbar-search-icon"/>
            </svg>
        </div>
        <div class="search-container">
            <?php print render($page['search']); ?>
        </div>
        <div id="idbar-search-close-button">
            <svg>
                <use xlink:href="<?php echo THEMEDIR; ?>/assets/img/idbar.svg#icon-idbar-close-button-circle" id="icon-idbar-close-button-circle"/>
                <use xlink:href="<?php echo THEMEDIR; ?>/assets/img/idbar.svg#icon-idbar-close-button-x" id="icon-idbar-close-button-x"/>
            </svg>
        </div>
    </div>