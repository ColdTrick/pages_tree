<?php

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