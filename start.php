<?php 

	require_once(dirname(__FILE__) . "/lib/functions.php");
	
	function pages_tree_init(){
		
		// extend CSS
		elgg_extend_view("css", "pages_tree/css");

		// register page handler for nice URL's
		register_page_handler("pages_tree", "pages_tree_page_handler");
	}
	
	function pages_tree_page_handler($page){
		$result = false;
		
		switch($page[0]){
			case "reorder":
				$result = true;
				
				include(dirname(__FILE__) . "/procedures/reorder.php");
				break;
			case "load":
				$result = true;
				
				include(dirname(__FILE__) . "/procedures/load.php");
				break;
		}
		
		return $result;
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
		
		if($PAGES_TREE_REORDERING === true){
			if(!empty($params["entity"]) && $params["entity"] instanceof ElggObject){
				$entity = $params["entity"];
				
				if(($entity->getSubtype() == "page") || ($entity->getSubtype() == "page_top")){
					return true;
				}
			}
		}		
	}
	
	// register default elgg events
	register_elgg_event_handler("init", "system", "pages_tree_init");
	
	// write permission plugin hooks
	register_plugin_hook('permissions_check', 'object', 'pages_tree_write_permission_check');
	