<?php
	
	$page_guid = (int) get_input('page_guid');
	$tree_guid = (int) get_input('treeguid', $page_guid);
	
	if(!empty($tree_guid)){
		
		if(($page = get_entity($tree_guid)) && ($page->getSubtype() == "page_top")){
?>
		
		<script type="text/javascript">
			$(document).ready(function(){
				$('#pages_tree_sidebar_tree').load("<?php echo $vars["url"]; ?>pg/pages_tree/load?treeguid=<?php echo $tree_guid; ?>&page_guid=<?php echo $page_guid; ?>");
			});
		</script>
		
		<div id="pages_tree_container" class="contentWrapper">
			<h3><?php echo elgg_echo("pages:navigation"); ?></h3>
			
			<div id="pages_tree_sidebar_tree">
				<?php echo elgg_view("ajax/loader"); ?>
			</div>
			
			<div class="clearfloat"></div>
		</div>		
<?php 
		}
	}