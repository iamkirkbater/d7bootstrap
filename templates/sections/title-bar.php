<div id="title-bar">
    <div class="container">
        <div class="title-bar--left">
            <?php
                if ($breadcrumb && $title != "Search") {
                    print $breadcrumb;
                }
            ?>
            <?php if (isset($node) && $node->type == "featured_story") : ?>
                <h1 id="page-title">You can <?php print strtolower($title); ?></h1>
            <?php elseif ($title == "Search") : ?>
                <h1 id="page-title">Search Results</h1>
            <?php else : ?>
                <h1 id="page-title"><?php print $title; ?></h1>
            <?php endif; ?>
        </div>
        <div class="title-bar--right">
            <?php
                if (isset($node) && !empty($node->field_icon))
                {
                    $icon = $node->field_icon['und'][0]['uri'];
                    $icon = file_create_url($icon);

                    print '<img class="icon--title-bar" src="'.$icon.'" alt="'.$node->title.'">';
                }

                if ($view = views_get_page_view())
                {
                    if ($view->name == "staff_directory" && $view->current_display == "page"): ?>
                        <div class="staff-search">
                            <input type="search" id="staff-search" name="staff-search" placeholder="Search">
                            <svg width="13px" height="13px"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/sites/all/themes/twc/assets/img/idbar.svg#icon-idbar-search-icon"></use></svg>
                        </div>
                    <?php endif;
                }
            ?>
        </div>
    </div>
</div>