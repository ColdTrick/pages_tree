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
	
	function pages_tree_pagesetup(){
		
		$context = get_context();
		$user = get_loggedin_user();
		
		if(!empty($user) && ($context == "pages")){
			if($parts = parse_url(current_page_url(), PHP_URL_PATH)){
				$parts = explode("/", $parts);
				
				if(!empty($parts) && is_array($parts)){
					foreach($parts as $index => $part){
						if($part != "pages"){
							unset($parts[$index]);
						} else {
							unset($parts[$index]);
							break;
						}
					}
					
					$page = array_values($parts);
					
					switch($page[0]){
						case "view":
							if(isset($page[1])){
								if(($page = get_entity($page[1])) && ($page->getSubtype() == "page" || $page->getSubtype() == "page_top")){
									if(!$page->canEdit()){
										remove_submenu_item(elgg_echo("pages:newchild"), "pagesactions");
										remove_submenu_item(elgg_echo("pages:delete"), "pagesactions");
									}
								}
							}
							break;
					}
				}
			}
		}
	}
	
	// register default elgg events
	register_elgg_event_handler("init", "system", "pages_tree_init");
	register_elgg_event_handler("pagesetup", "system", "pages_tree_pagesetup");
	
	// write permission plugin hooks
	register_plugin_hook('permissions_check', 'object', 'pages_tree_write_permission_check');
	