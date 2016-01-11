<section id="identity-bar">
	<?php include("sections/idbar.php"); ?>
</section>

<section id="mobile-menu">
	<?php print render($page['mobile_menu']); ?>
</section>

<?php

include ("sections/header.php");

include("sections/title-bar.php");

if (!empty($node->field_banner))
{
	$banners = $node->field_banner['und'];
	include("components/banner.php");
}
?>

<main>
	<div class="container">
		<?php print render($messages); ?>
		<?php print render($tabs); ?>
		<?php print render($page['content']); ?>
	</div>
</main>

<?php include("sections/footer.php"); ?>