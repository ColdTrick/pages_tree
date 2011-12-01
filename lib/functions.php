<?php 

	function pages_tree_display_pages($page){
		
		static $can_edit;
		if(!isset($can_edit)){
			$can_edit = $page->canWriteToContainer();
		}
		
		$result = "";
		$options = array(
				"type" => "object",
				"subtype" => "page",
				"limit" => false,
				"metadata_name_value_pairs" => array("parent_guid" => $page->getGUID()),
				"order_by" => "e.time_created asc"
			);
			
		if($children = elgg_get_entities_from_metadata($options)){
			// apply optional sorting
			$ordered_children = array();
			
			foreach($children as $key => $child){
				if(isset($child->order)){
					$order = (int) $child->order;
					$ordered_children[$order] = $child;
					unset($children[$key]);
				}
			} 
			ksort($ordered_children);
			
			$ordered_children = array_merge($ordered_children, $children);
			
			// build result
			$result .= "<ul>";
			foreach($ordered_children as $child_page){
				$result .= "<li";
				
				if(!$can_edit){
					$result .= " rel='non_edit'";
				}
				$result .= "><a id='" . $child_page->getGUID() . "' title='" . $child_page->title . "' href='" . $child_page->getURL() . "'>" . $child_page->title . "</a>";
				$result .= pages_tree_display_pages($child_page, $can_edit); // traverse deeper into the tree
				$result .= "</li>";	
			}	
			$result .= "</ul>";
		}
		
		return $result;
	}