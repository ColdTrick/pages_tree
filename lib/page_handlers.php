<?php

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