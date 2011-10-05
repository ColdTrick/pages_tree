<?php 

	/**
	 * jQuery call to reorder a page
	 */

	if(isloggedin()){
		$page_guid = (int) get_input("page_guid");
		$parent_guid = (int) get_input("parent_guid");
		$order = str_replace("::", ",", get_input("order"));
		
		if(!empty($page_guid) && !empty($parent_guid)){
			// check if page_guid is a page
			if($page = get_entity($page_guid)){
				$page_subtype = $page->getSubtype(); 
				if($page_subtype != "page" || !$page->canWriteToContainer()){
					unset($page);
				}
			}
			
			// check if parent_guid is a page
			if($parent = get_entity($parent_guid)){
				$parent_subtype = $parent->getSubtype(); 
				if($parent_subtype != "page" && $parent_subtype != "page_top"){
					unset($parent);
				}
			}
			
			if(!empty($page) && !empty($parent)){				
				// reorder
				$page->parent_guid = $parent->getGUID();
				$order = string_to_tag_array($order);
				if(!empty($order) && !is_array($order)){
					$order = array($order);
				}
				
				if(!empty($order)){
					global $PAGES_TREE_REORDERING;
					$PAGES_TREE_REORDERING = true;
					
					foreach($order as $index => $order_guid){
						if($current_page = get_entity($order_guid)){
							if($current_page->getSubtype() == "page"){
								$current_page->order = $index;
							}
						}
					}
					
					$PAGES_TREE_REORDERING = false;
				}
			}
		}
	}

?>