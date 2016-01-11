<div id="banner">
    <div class="container">
        <?php if (count($banners) > 1): ?>
            <div class="banner banner--slideshow">
                <?php

                /**
                 * If the banners should not be random, comment out this line.
                 */
                shuffle($banners);


                /**
                 * Note: If you do not set up an Image Style called "Banner Image" this will fail to work properly.
                 */
                ?>
                <?php foreach ($banners as $banner) : ?>
                    <div>
                        <img src="<?php print image_style_url('banner_image', $banner['uri']); ?>" alt="<?php print $title; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="banner banner--single">
                <img src="<?php print image_style_url('banner_image', $banners[0]['uri']); ?>" alt="<?php print $title; ?>">
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    (function($){$(window).load(function() {
        $('.banner--slideshow').slick({
            arrows: false,
            autoplay: true,
            dots: true,
            autoplaySpeed: 5000
        });
    });})(jQuery);
</script>