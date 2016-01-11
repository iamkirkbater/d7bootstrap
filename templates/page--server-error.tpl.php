<section id="identity-bar">
    <?php include("sections/idbar.php"); ?>
</section>

<section id="mobile-menu">
	<?php print render($page['mobile_menu']); ?>
</section>

<?php include ("sections/header.php"); ?>

<section class="gray-area server-error-page">
    <div class="container">
        <?php print render($tabs); ?>
        <h1><?php print $title; ?></h1>
        <?php print render($page['content']); ?>
    </div>
</section>

<?php include("sections/footer.php"); ?>