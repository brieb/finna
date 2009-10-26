<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?= $page_title ?></title>

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="user-scalable=false,initial-scale=1.0" />
<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript"> google.load("jquery", "1.3.2"); </script>



<script src="js/fixed.js" type="text/javascript" charset="utf-8"></script>

<style>

#container {
	min-height: 600px;
	width: 320px;
	overflow: hidden;
}


#due-content {
	-webkit-transition: left 0.5s ease;
	position: absolute;
	left: 10px;
	width: 310px;
	height: 500px;
}

#priority-content {
	position: absolute;
	left: 10px;
	-webkit-transition: left 0.5s ease;
}

#due-content.hidden {
	left: -330px;
}

#priority-content.hidden {
	left: 330px;
	width: 320px;
}
</style>

<script>
    function setupTouchEvents() {
        var listEntries = document.getElementsByTagName('li');
        var currentPage = 1;
        
        var onTouchEnd = function(){
            this.className = "";                
            if (currentPage == 1) {
                document.getElementById('due-content').className = "hidden";
                document.getElementById('priority-content').className = "";
                currentPage = 2;
            } else {
                document.getElementById('due-content').className = "";
                document.getElementById('priority-content').className = "hidden";
                currentPage = 1;
            }
        }
        for(var i = 0; i < listEntries.length; i++){
            listEntries[i].addEventListener("touchend", onTouchEnd, true); 
        }
    }
</script>


<link rel="stylesheet" type="text/css" href="css/iphone.css">


</head>


<body onload='setupTouchEvents()' style="margin:0px; width:320px;" onorientationchange="updateOrientation()">

<div id="debug" style="position:absolute; z-index:999; top:0; left:0;
  background:black; color:white; display:none;"></div>
  

<div id="header">
	<ul>
		<li id="assignments_tab" class="active">Assignments</li>
		<li id="courses_tab">Courses</li>
	</ul>
</div> 

		<div id="container">
			<div id="content">
			       <!-- <?php require_once $view ?>-->
				<div id="due-content">
					<ul>
						<li class="sep">Overdue</li>
						<li>A1</li>
						<li>A2</li>
						<li class="sep">Today</li>
						<li>A3</li>
						<li>A4</li>
					</ul>
				</div>
				<div id="priority-content" class="hidden">
					<ul>
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
				<div id="course_content" class="hidden">
					<ul class="edgetoedge slideback">
						<li class="sep">CS147</li>
						<li>A1</li>
						<li>A2</li>
						<li class="sep">MATH51</li>
						<li>A3</li>
						<li>A4</li>
					</ul>
				</div>
				<div id="done_content" class="hidden">
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
