<?php 

	require_once(dirname(__FILE__) . "/lib/functions.php");
	require_once(dirname(__FILE__) . "/lib/hooks.php");
	require_once(dirname(__FILE__) . "/lib/page_handlers.php");
	
	function pages_tree_init(){
		
		// extend CSS
		elgg_extend_view("css", "pages_tree/css");

		// register page handler for nice URL's
		register_page_handler("pages_tree", "pages_tree_page_handler");
	}
	
	// register default elgg events
	register_elgg_event_handler("init", "system", "pages_tree_init");
	
	// write permission plugin hooks
	register_plugin_hook('permissions_check', 'object', 'pages_tree_write_permission_check');
	