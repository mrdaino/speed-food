<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<title><?php echo $title;?></title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo PATHCSS."style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?php echo PATHCSS."cssCrop/imgareaselect-animated.css"?>">

<!--[if IE 7]> <link rel="stylesheet" type="text/css" href="<?php echo PATHCSS."font-awesome-ie7.min.css" ?>"> <![endif]-->
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo PATHJS."customScroll.js"; ?>"></script>
<script type='text/javascript' src="<?php echo PATHJS."jquery.layout.min.js"; ?>"></script>
<script type='text/javascript' src="<?php echo PATHJS."jquery.imgareaselect.js"; ?>"></script>
<script type='text/javascript' src="<?php echo PATHJS."jquery.imgareaselect.min.js"; ?>"></script>
<script type='text/javascript' src="<?php echo PATHJS."jquery.imgareaselect.pack.js"; ?>"></script>
<script type='text/javascript' src="<?php echo PATHJS."jquery_ui.js"; ?>"></script>
<script type='text/javascript' src="<?php echo PATHJS."utilities.js"; ?>"></script>
<script type="text/javascript" src="<?php echo PATHJS."jscolor/jscolor.js"; ?>"></script>


<?php
if(isset($template)){
	if(!($template!="login")){
?>
<script type="text/javascript" src="<?php echo PATHUTILITIES.$template  ?>/js/ajax.js">  </script>
<?php
	}
}else{
	$template="";
}
?>
</head>
<body>
	<div id="logo_head">
		<div id="content_logo">
			<a target="_blank" href="<?php echo URILOGO; ?>"><img src="<?php echo PATHLOGOCMS?>" id="logo_cms"/></a>
		</div>
	</div>
	<div id="contenuto">
<?php
if($template!="login"){
	include("menu/menu.php");
}
?>


