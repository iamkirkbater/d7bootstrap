<div class="search-results-container">
	<?php if ($search_results): ?>
		<h3><?php print 'Search results for "'.arg(2).'"'; ?></h3>
		<ol class="search-results <?php print $module; ?>-results">
			<?php print $search_results; ?>
		</ol>
		<?php print $pager; ?>
	<?php else : ?>
		<h3><?php print t('Your search for \''.arg(2).'\' yielded no results');?></h3>
		<?php print search_help('search#noresults', drupal_help_arg()); ?>
	<?php endif; ?>
</div>