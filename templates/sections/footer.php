<footer id="footer">
    <div class="container">
        <section class="footer-left">
            <div class="twc-logo">
                <a href="<?php print $front_page; ?>">
                    <svg id="twc-logo--footer">
                        <use xlink:href="<?php echo THEMEDIR; ?>/assets/img/twc-assets.svg#twc-logo--with-rit"/>
                    </svg>
                </a>
            </div>

            <div class="rit-info">
                <a href="http://rit.edu" target="_blank">
                    <div class="rit-logo">
                        <svg id="rit-logo--footer">
                            <use xlink:href="<?php echo THEMEDIR; ?>/assets/img/idbar.svg#icon-idbar-rit-logo-rit"/>
                        </svg>
                    </div>
                </a>
                <p class="copyright">Copyright &copy; Rochester Institute of Technology<br/>
                    All Rights Reserved.  <a href="http://www.rit.edu/disclaimer" target="_blank">Disclaimer</a>. <a href="http://www.rit.edu/copyright" target="_blank">Copyright Infringement</a></p>
            </div>
        </section>

        <section class="footer-middle">
            <nav id="main-menu--footer">
                <?php print render($page['footer_menu']); ?>
            </nav>
        </section>

        <section class="footer-right">
            <div class="contact-info--footer">
                <h4>Contact</h4>
                <p>Rochester Institute of Technology<br>
                    90 Lomb Memorial Drive<br>
                    Rochester, NY 14623-5603</p>
            </div>

            <div id="quick-links--footer" class="quick-links">
                <?php print render($page['footer_quick_links']); ?>
            </div>
        </section>
    </div>
</footer>