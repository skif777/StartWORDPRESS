<?php 

/**
 * Объединение скриптов в один файл
 */
add_action( 'wp_enqueue_scripts', 'merge_all_scripts', 9999 );
function merge_all_scripts() 
{
	global $wp_scripts;
	
	/*
		#1. Reorder the handles based on its dependency, 
			The result will be saved in the to_do property ($wp_scripts->to_do)
	*/
	$wp_scripts->all_deps($wp_scripts->queue);	
	
	// New file location: E:xampp\htdocs\wordpresswp-content\theme\wdc\merged-script.js
	$merged_file_location = get_stylesheet_directory() . DIRECTORY_SEPARATOR . 'js' . '/scripts.js';
	
	$merged_script	= '';
	
	// Loop javascript files and save to $merged_script variable
	foreach( $wp_scripts->to_do as $handle) 
	{
		/*
			Clean up url, for example wp-content/themes/wdc/main.js?v=1.2.4
			become wp-content/themes/wdc/main.js
		*/
		$src = strtok($wp_scripts->registered[$handle]->src, '?');
		
		/**
			#2. Combine javascript file.
		*/
		// If src is url http / https		
		if (strpos($src, 'http') !== false)
		{
			// Get our site url, for example: http://webdevzoom.com/wordpress
			$site_url = site_url();
		
			/*
				If we are on local server, then change url to relative path,
				e.g. http://webdevzoom.com/wordpress/wp-content/plugins/wpnewsman/css/menuicon.css
				become: /wp-content/plugins/wpnewsman/css/menuicon.css,
				this is for reduse the HTTP Request
				
				if not, e.g. https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css,
				then leave as is (we'll skip it)
			*/
			if (strpos($src, $site_url) !== false)
				$js_file_path = str_replace($site_url, '', $src);
			else
				$js_file_path = $src;
			
			/*
				To be able to use file_get_contents function we need to remove slash,
				e.g. /wp-content/plugins/wpnewsman/css/menuicon.css
				become wp-content/plugins/wpnewsman/css/menuicon.css
			*/
			$js_file_path = ltrim($js_file_path, '/');
		}
		else 
		{			
			$js_file_path = ltrim($src, '/');
		}
		
		// Check wether file exists then merge
		if  (file_exists($js_file_path)) 
		{
			// #3. Check for wp_localize_script
			$localize = '';
			if (@key_exists('data', $wp_scripts->registered[$handle]->extra)) {
				$localize = $obj->extra['data'] . ';';
			}
			$merged_script .=  $localize . file_get_contents($js_file_path) . ';';
		}
	}
	
	// write the merged script into current theme directory
	file_put_contents ( $merged_file_location , $merged_script);
	
	// 5. Deregister handles
	foreach( $wp_scripts->to_do as $handle ) 
	{
		wp_deregister_script($handle);
	}
}