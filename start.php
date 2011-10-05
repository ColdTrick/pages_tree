<?php 

	require_once(dirname(__FILE__) . "/lib/functions.php");
	
	function pages_tree_init(){
		
		// extend CSS
		elgg_extend_view("css", "pages_tree/css");

		// register page handler for nice URL's
		register_page_handler("pages_tree", "pages_tree_page_handler");
	}
	
	function pages_tree_page_handler($page){
		switch($page[0]){
			case "reorder":
				include(dirname(__FILE__) . "/procedures/reorder.php");
				break;
			default:
				forward();
		}
	}
	
	/**
	 * Extend pages permissions when reordering pages
	 *
	 * @param unknown_type $hook
	 * @param unknown_type $entity_type
	 * @param unknown_type $returnvalue
	 * @param unknown_type $params
	 */
	function pages_tree_write_permission_check($hook, $entity_type, $returnvalue, $params) {
		global $PAGES_TREE_REORDERING;
		if($params['entity']->getSubtype() == 'page' || $params['entity']->getSubtype() == 'page_top'){
			if ($PAGES_TREE_REORDERING == true) {
				return true;
			}
		}		
	}
	
	
	// register default elgg events
	register_elgg_event_handler("init", "system", "pages_tree_init");
	
	// write permission plugin hooks
	register_plugin_hook('permissions_check', 'object', 'pages_tree_write_permission_check');
	
?>