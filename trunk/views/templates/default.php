<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?= $page_title ?></title>

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="user-scalable=false,initial-scale=1.0" />
<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

<script src="js/fixed.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="css/iphone.css">

</head>

<body onload="Load()" style="margin:0px; width:320px;" onorientationchange="updateOrientation()">

<div id="debug" style="position:absolute; z-index:999; top:0; left:0;
  background:black; color:white; display:none;"></div>
  
<script type="text/javascript">
function Load(){
}
</script>

<div id="header"><h1>My Todo</h1></div> 

		<div id="container">
			<div id="content">
			        <?php require_once $view ?>
			</div>
		</div>
	
		<div id="footer">
			<ul>
				<li class="due active"><span>Due Date</span></li>
				<li class="priority"><span>Priority</span></li>
				<li class="courses"><span>Courses</span></li>
				<li class="trash"><span>Trash</span></li>
			</ul>
		</div>
</body>
</html>
