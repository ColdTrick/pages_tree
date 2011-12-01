<?php ?>
#pages_tree_container {
	overflow: auto;
}

#pages_tree_container > h3 {
	background: none;
	border-top: none;
	border-bottom: 1px solid #cccccc;
	font-size:1.25em;
	line-height:1.2em;
	margin:0 0 5px 0;
	padding:0 0 5px 5px;
	color:#0054A7;
}

#pages_tree_sidebar_tree.tree{
	display: block;
}
/* extending file tree classic theme */

#pages_tree_sidebar_tree.tree li {
	line-height: 20px;
}
 
#pages_tree_sidebar_tree.tree li span {
	padding: 1px 0px;
}

#pages_tree_sidebar_tree.tree-classic li a {
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border: 1px solid transparent;	
}

#pages_tree_sidebar_tree.tree-classic li a:hover {
	border: 1px solid #CCCCCC;
}

#pages_tree_sidebar_tree.tree-classic li a.clicked {
	background: #DEDEDE;
    border: 1px solid #CCCCCC;
    color: #999999;
}

#pages_tree_sidebar_tree.tree-classic li a.clicked:hover {
	background: #CCCCCC;
    border: 1px solid #CCCCCC;
    color: white;
}

#pages_tree_sidebar_tree.tree-classic li a.ui-state-hover{
	background: #0054A7;
	border: 1px solid #0054A7;	
	color: white;
}