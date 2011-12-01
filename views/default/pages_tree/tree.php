<?php

	$tree_guid = $vars["tree_guid"];
	$page_guid = $vars["page_guid"];
	
	$page = get_entity($tree_guid);

?>
<script type="text/javascript">
	var pages_tree_first;
	
	$(function(){
		$("#pages_tree_sidebar_tree").tree({ 
			"opened": ["<?php echo $page_guid; ?>"],
			"selected": ["<?php echo $page_guid; ?>"],
			"ui": {
				"theme_name": "classic"
			},
			"rules": {
				"multiple": false,
				"drag_copy": false,
				// only nodes of type root can be top level nodes
				"valid_children" : [ "root" ] 
			},
			"callback": {
				
				"onmove": function (NODE, REF_NODE, TYPE, TREE_OBJ, RB){
					var page_guid = TREE_OBJ.get_node(NODE).find("a").attr("id");
					var parent_guid = TREE_OBJ.parent(NODE).find("a:first").attr("id");
					var order = TREE_OBJ.parent(NODE).children("ul").children("li").children("a").makeDelimitedList("id");

					pages_tree_reorder(page_guid, parent_guid, order);
				},
				"onselect": function(NODE, TREE_OBJ){
					if(!pages_tree_first){
						pages_tree_first = true;
						return;
					}
					
					var location = TREE_OBJ.get_node(NODE).find("a").attr("href");
					if(location && (location !== document.location.href)){
						document.location.href = location;
					}
				}
			},
			types : {
				// all node types inherit the "default" node type
				"default" : {
					deletable : false,
					renameable : false
				},
				"root" : {
					draggable : false
				},
				"non_edit" : {
					draggable : false
				}
			}
		});
	});
</script>

<ul>
	<li id="pages_tree_sidebar_tree_main" rel="root">
		<a id="<?php echo $page->getGUID(); ?>" href="<?php echo $page->getURL(); ?>"><?php echo $page->title; ?></a>
	
		<?php
			echo pages_tree_display_pages($page);
		?>
	</li>
</ul>