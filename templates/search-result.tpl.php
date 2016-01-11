<li class="<?php print $classes; ?>"<?php print $attributes; ?>>
	<?php print render($title_prefix); ?>
	<h2 class="title"<?php print $title_attributes; ?>>

		<?php
			if ($result['type'] == "Staff")
			{
				print '<a href="/staff#'.slugify($title).'">'.$title.'</a>';
			}
			else
			{
				print '<a href="'.$url.'">'.$title.'</a>';
			}
		?>

	</h2>
	<?php print render($title_suffix); ?>
	<div class="search-snippet-info">
		<?php if ($snippet): ?>
			<p class="search-snippet"<?php print $content_attributes; ?>><?php print $snippet; ?></p>
		<?php endif; ?>
	</div>
</li> 