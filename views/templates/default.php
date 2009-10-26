<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?= $page_title ?></title>

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="user-scalable=false,initial-scale=1.0" />
<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<!--
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript"> google.load("jquery", "1.3.2"); </script>
    <script src="jqtouch/jqtouch.min.js" type="application/x-javascript" charset="utf-8"></script>
    <style type="text/css" media="screen">@import "jqtouch/jqtouch.min.css";</style>
    <style type="text/css" media="screen">@import "themes/jqt/theme.min.css";</style>-->
    
<!--    <script src="jquery.js" type="text/javascript" charset="utf-8"></script>
	<script src="jqt/jqtouch.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript" charset="utf-8">
		jQT = new $.jQTouch();
	</script>-->
<!--	<style type="text/css" media="screen">@import "jqt/jqtouch.css";</style>
	<style type="text/css" media="screen">@import "jqt/theme.css";</style>-->
	


<script src="js/fixed.js" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" type="text/css" href="css/iphone.css">


</head>

<body onload="Load()" style="margin:0px; width:320px;" onorientationchange="updateOrientation()">

<div id="debug" style="position:absolute; z-index:999; top:0; left:0;
  background:black; color:white; display:none;"></div>
  
<script type="text/javascript">
function Load(){
    jQT.addAnimation({
        name: 'slideback',
        selector: '.slideback'
    });
}
</script>

<div id="header">
	<ul>
		<li id="assignments_tab" class="active">Assignments</li>
		<li id="courses_tab">Courses</li>
	</ul>
</div> 

		<div id="container">
			<div id="content">
			       <!-- <?php require_once $view ?>-->
				<div id="due_content">
					<ul class="edgetoedge slideback">
						<li class="sep">Overdue</li>
						<li>A1</li>
						<li>A2</li>
						<li class="sep">Today</li>
						<li>A3</li>
						<li>A4</li>
					</ul>
				</div>
				<div id="priority_content">
					<ul class="edgetoedge slideback">
						<li class="sep">High</li>
						<li>A1</li>
						<li>A2</li>
						<li class="sep">Normal</li>
						<li>A3</li>
						<li>A4</li>
						<li class="sep">Low</li>
						<li>A5</li>
						<li>A6</li>
						<li>A5</li>
						<li>A6</li>
						<li>A5</li>
						<li>A6</li>
						<li>A5</li>
						<li>A6</li>
					</ul>
				</div>
				<div id="course_content">
					<ul class="edgetoedge slideback">
						<li class="sep">CS147</li>
						<li>A1</li>
						<li>A2</li>
						<li class="sep">MATH51</li>
						<li>A3</li>
						<li>A4</li>
					</ul>
				</div>
				<div id="done_content">
					<ul class="edgetoedge slideback">
						<li>A1</li>
						<li>A2</li>
						<li>A3</li>
						<li>A4</li>
					</ul>
				</div>
			</div>
		</div>
	
		<div id="footer">
			<ul>
				<li class="due active" id="duedate_sort"><span>Due Date</span></li>
				<li class="priority" id="priority_sort"><span>Priority</span></li>
				<li class="courses" id="course_sort"><span>Courses</span></li>
				<li class="trash" id="done_sort"><span>Trash</span></li>
			</ul>
		</div>
</body>
</html>
