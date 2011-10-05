<?php

		// disable pages metatags

?>
<script src="<?php echo $vars["url"]; ?>mod/pages_tree/vendors/jstree/jquery.tree.min.js"></script>

<script type="text/javascript">
	function pages_tree_reorder(page_guid, parent_guid, order){
		var reorder_url = "<?php echo $vars["url"];?>pg/pages_tree/reorder";
		$.post(reorder_url, {"page_guid": page_guid, "parent_guid": parent_guid, "order": order});		
	}
</script>