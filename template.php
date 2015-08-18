<?php

define('DIR',base_path().path_to_theme().'/');
define('CACHE_FIX','?'.time());

function themename_menu_link($variables) {
	
	$element = $variables['element'];
	$sub_menu = '';
	
	$title = '<span>' . $element['#title'] . '</span>';
	$href = $element['#href'];
	$options = $element['#localized_options'];

	if($element['#below'])
	{
		$below = $element['#below'];
		$below = reset($below);
		$href = $below['#href'];
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