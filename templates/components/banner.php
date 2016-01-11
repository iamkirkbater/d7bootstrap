<div id="banner">
    <div class="container">
        <?php if (count($banners) > 1): ?>
            <div class="banner banner--slideshow">
                <?php shuffle($banners); ?>
                <?php foreach ($banners as $banner) : ?>
                    <div>
                        <img src="<?php print image_style_url('featured_story_banner', $banner['uri']); ?>" alt="<?php print $title; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="banner banner--single">
                <img src="<?php print image_style_url('featured_story_banner', $banners[0]['uri']); ?>" alt="<?php print $title; ?>">
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