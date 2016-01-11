<?php

define('THEMEDIR',base_path().path_to_theme());
define('CACHE_FIX','?'.time());

function themename_menu_link($variables) {

	$element = $variables['element'];
	$sub_menu = '';

	$title = '<span>' . $element['#title'] . '</span>';
	$href = $element['#href'];
	$options = $element['#localized_options'];

	if ($element['#original_link']['menu_name'] == "menu-quick-links")
	{
		$className = $element['#original_link']['title'];
		$className = strtolower($className);

		if ($className == "twc@rit.edu")
		{
			$className = "mail";
		}
		$className = preg_replace("/\s+/", "-", $className);
		$element['#attributes']['class'][] = "quick-links-".$className;
	}

	if($element['#below'])
	{
		$below = $element['#below'];
		$below = reset($below);
		$options = $element['#localized_options'];
		$element['#attributes']['class'][] = 'has-dropdown';
		if(isset($options['attributes']['class']) && in_array('active-trail', $options['attributes']['class']))
		{
			$element['#attributes']['class'][] = 'opened';
			$options['attributes']['class'][] = 'opened';
		}
		$sub_menu = drupal_render($element['#below']);
	}
	else
	{
		$href = $element['#href'];
		$options = $element['#localized_options'];
		$sub_menu = '';
	}

	if (strpos($href,'http://')!==false or strpos($href,'https://')!==false)
	{
		$options['attributes']['target'] = '_blank';
	}

	$options['html'] = 'TRUE';

	$output = l($title, $href, $options);
	return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function themename_preprocess_image(&$variables)
{
	$attributes = &$variables['attributes'];

	foreach (array('width', 'height') as $key) {
		unset($attributes[$key]);
		unset($variables[$key]);
	}
}

function themename_preprocess_html(&$variables){

	// Construct page title.
	$breadcrumb = array_reverse(drupal_get_breadcrumb());
	array_pop($breadcrumb);

	if(drupal_get_title() == 'Home')
	{
		$vars['head_title'] = variable_get('site_name');
	}
	else if (drupal_get_title()) {
		$head_title[] = strip_tags(drupal_get_title());
	}

	$head_title[] = check_plain(variable_get('site_name'));
	$head_title[] = 'RIT';

	$variables['head_title_array'] = $head_title;
	$variables['head_title'] = implode(' | ',$head_title);
}

function themename_preprocess_page(&$variables) {
	if (isset($variables['node']))
	{
		if ($variables['node']->nid == "438") // if it's the Support Us Page
		{
			$variables['theme_hook_suggestions'][] = "page__support_us";
		}

		if ($variables['node']->nid == "460" || $variables['node']->nid == "461") // if it's the 404 page or 403 page, respectively
		{
			// I wish drupal had a better way to deal with these error pages....
			$variables['theme_hook_suggestions'][] = "page__server_error";
		}

		if ($variables['node']->nid == "487" )
		{
			$variables['theme_hook_suggestions'][] = "page__branding";
		}
	}
}

function themename_form_alter(&$form, &$form_state, $form_id) {
	if (array_key_exists("submitted", $form))
	{
		foreach ($form["submitted"] as $key => $value)
		{
			if (is_array($form["submitted"][$key]) && array_key_exists("#type", $form["submitted"][$key]) && in_array($form["submitted"][$key]['#type'], array("textfield", "webform_email", "textarea")))
			{
				$form["submitted"][$key]['#attributes']["placeholder"] = t($form["submitted"][$key]["#default_value"]);  // add Default Value as placeholder
				unset($form["submitted"][$key]['#default_value']);
				if ($form["submitted"][$key]['#required'] == 1)
				{
					$form["submitted"][$key]['#attributes']["required"] = t("true");
				}
			}
		}
	}

//	// if it's a custom search block, add the svg
//	$needsSvgIcon = strpos($form['#form_id'],"custom_search_blocks_form");
//
//	if (is_bool($needsSvgIcon) === false)
//	{
//		$form['actions']['submit']['#prefix'] = '<label>';
//		$form['actions']['submit']['#suffix'] = '<svg width="14px" height="14px"><use xlink:href="' . THEMEDIR . '/assets/img/idbar.svg#icon-idbar-search-icon"></use></svg></label>';
//	}
}

function themename_breadcrumb($variables) {
	$breadcrumb = $variables ['breadcrumb'];

	if (!empty($breadcrumb)) {

		// Always remove the "Home" link in the breadcrumb trail.
		array_shift($breadcrumb);

		if (!empty($breadcrumb))
		{
			// If the breadcrumb trail is still not empty, then print it out.
			// Provide a navigational heading to give context for breadcrumb links to
			// screen-reader users. Make the heading invisible with .element-invisible.
			$output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
			$bread = array();

			foreach ($breadcrumb as $bc)
			{
				if (strpos($bc, "Media Services") === false)
				{
					$bread[] = $bc;
				}
				else
				{
					$bread[] = '<a href="/services/media-services">RIT Production Services</a>';
				}
			}

			$output .= '<div class="breadcrumb">' . $bread[0] . ' / </div>';
			return $output;
		}
	}
}

function themename_preprocess_field(&$variables, $hook)
{
	$element = $variables['element'];
	// Add specific suggestions that can override the default implementation.
	$variables['theme_hook_suggestions'] = array(
			'field__' . $element['#field_type'],
			'field__' . $element['#field_name'],
		// note that 'field__'.$element_['#bundle'] is removed here.  This prevents cascading, but if you already rely on this functionality it will break.
			'field__' . $element['#field_name'] . '__' . $element['#bundle'],
	);
}

function themename_print_no_photo_placeholder_image($email)
{
	print '<a href="mailto:'.$email.'"><img src="' . file_create_url("public://staff_photos/no-photo.jpg") . '" alt="Photo Unavailable"></a>';
}

function isAdmin()
{
	global $user;
	return in_array('administrator', array_values($user->roles));
}

function d($var) {
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
}

function slugify ($var) {
	$var = strtolower($var);
	$var = preg_replace("/[^\w]+/", '-', $var);
	return $var;
}