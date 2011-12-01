<?php

	/** 
	 * jQuery call to load the tree of a Page
	 * 
	 */

	$treeguid = (int) get_input("treeguid");
	$page_guid = (int) get_input("page_guid", $treeguid);
	
	echo elgg_view("pages_tree/tree", array("tree_guid" => $treeguid, "page_guid" => $page_guid));