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

<style type="text/css">

#container {
	width: 320px;
	overflow: hidden;
	position: relative;
}

#due-content, #priority-content, #course-content, #done-content, #header, #footer {
	-webkit-transition: left 0.5s ease;
	position: absolute;
	display: block;
	left: 0px;
	width: 100%;
}

#due-content.hidden, #priority-content.hidden, #course-content.hidden, #done-content.hidden, #header.hidden, #footer.hidden {
	left: -330px;
}

#task-info {
	-webkit-transition: left 0.5s ease;
	position: absolute;
	display: block;
	left: 0px;
	width: 100%;
}

#task-info.hidden {
	left: 330px;
}
</style>

<script type="text/javascript">

    var currentPage;
    var prevPage;
        
    function setupTouchEvents() {
    	currentPage = $('#due-content');
        
        var onTouchEnd = function(){
            var loc = this.getAttribute('loc');
            if (loc=="BACK"){
            	loc = prevPage;
            } else {
            	loc = $('#'+loc);
            }
            
            loc.removeClass("hidden");
            currentPage.addClass("hidden");
            if (currentPage.hasClass("parent-page")){
            	$('#header').addClass("hidden");
            	$('#footer').addClass("hidden");
            	
				$("#container").css('top', "-"+$('#header').height()+"px");
				$("#container").css('height', (window.innerHeight)+"px");
				$("#content").css('min-height', (window.innerHeight)+"px");
            }
            prevPage = currentPage;
            currentPage = loc;
            
            if (currentPage.hasClass("parent-page")){
            	$('#header').removeClass("hidden");
            	$('#footer').removeClass("hidden");
				$("#container").css('top', "0px");
				$("#container").css('height', (window.innerHeight-102)+"px");
				$("#content").css('min-height', (window.innerHeight-102)+"px");
            }
        }
        var listEntries = $('a[loc]');
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

	<div id="container" style="border:0px solid red; overflow:hidden;">
		<div id="content" style="margin:0px;">
		       <!-- <?php require_once $view ?>-->
		       
			<div id="due-content" class="parent-page" style="background-color:#ffd; display:block;">
				<a class="link" loc="task-info">Sort by due</a>
			</div>
			
			<div id="priority-content" class="parent-page" style="display:none;  background-color:#fdd;">
				<a loc="task-info">testing 123</a>
			</div>
			
			<div id="course-content" class="parent-page" style="display:none; background-color:#dfd;">
				<a loc="task-info">Course content</a>
			</div>
			
			<div id="done-content" class="parent-page" style="display:none; background-color:#dff;">
				<a loc="task-info">Done content</a>
			</div>
			
			<div id="task-info" class="hidden" style="background-color:#ddf;">
				<a loc="BACK">My task information</a>
			</div>
			
			
		</div>
	</div>

	<div id="footer">
		<ul>
			<li class="due active" id="duedate-sort"><span>Due Date</span></li>
			<li class="priority" id="priority-sort"><span>Priority</span></li>
			<li class="courses" id="course-sort"><span>Courses</span></li>
			<li class="trash" id="done-sort"><span>Trash</span></li>
		</ul>
	</div>
	
</body>
</html>
