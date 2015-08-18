<!DOCTYPE HTML>
<html>
<head>

	<?php print $head; ?>
	<title><?php print $head_title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, maximum-scale=1.0">
	<?php print $styles; ?>
	<?php print $scripts; ?>
    <!--[if IE]>
      <script src="/academicaffairs/etctest/includes/scripts/placeholder.min.js"></script>
      <script>(function($){ $(document).ready(function(){
          $('input, textarea').placeholder();
        }); })(jQuery);</script>
    <![endif]-->
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
<div id="BackToTop"></div>
</body>
</html>