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
        
</script>

<style>

body {
    margin: 0px;
    font-family: Helvetica;
    opacity: 1;
    background-repeat: no-repeat;
    //background-image: url(img/wallpaper.jpg);
    background-position: 0% 0%;
}

#assignmentsNavTab, #coursesNavTab {
    border-left-width: 12px;
    border-right-width: 12px;
    border-top-width: 0px;
    border-bottom-width: 0px;
    -webkit-margin-top-collapse: separate;
    -webkit-margin-bottom-collapse: separate;
    position: relative;
    height: 35px;
    margin-top: 5px;
    width: 133px;
    margin-right: 1px;
    margin-left: 2px;
    -webkit-border-image: url(img/navTab.png) 0 12 0 12 stretch stretch;
}

#coursesNavTab {
    opacity: 0.5;
}

#columnLayout {
    display: table;
    overflow: hidden;
    -webkit-margin-top-collapse: separate;
    -webkit-margin-bottom-collapse: separate;
    margin-top: 0px;
    position: absolute;
    bottom: 420px;
    height: 40px;
    top: 0px;
    left: 0px;
    right: 0px;
    width: 100%;
}

#text8, #text7 {
    color: black;
    font-family: Helvetica;
    text-overflow: ellipsis;
    overflow: hidden;
    position: relative;
    margin-left: 0px;
    -webkit-margin-top-collapse: separate;
    -webkit-margin-bottom-collapse: separate;
    text-align: center;
    font-size: 18px;
    font-weight: bold;
    margin-right: 0px;
    margin-top: 6px;
    width: auto;
    min-height: 21px;
    height: auto;
}

.selected #text8 {
    color: white;
}

.selected #text7 {
    color: white;
}
</style>


<script>
function switchToAssignmentsView (){
    $('#assignments').css('display','block');
    $('#courses').css('display','none');
    $('#coursesNavTab').css('opacity','0.5');
    $('#assignmentsNavTab').css('opacity','1');
}

function switchToCoursesView (){
    $('#assignments').css('display','none');
    $('#courses').css('display','block');
    $('#coursesNavTab').css('opacity','1');
    $('#assignmentsNavTab').css('opacity','0.5');
}
</script>


<link rel="stylesheet" type="text/css" href="css/iphone.css">
</head>


<body style="margin:0px; width:320px;" onorientationchange="updateOrientation()">

	<div id="debug" style="position:absolute; z-index:999; top:0; left:0;
	  background:black; color:white; display:none;"></div>

	  <div id="wallpaper">
	
	<div id="header">
	  
	<div id="columnLayout">
        <div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 51%; "><div id="assign_col">
                <div id="assignmentsNavTab" class="navTab" onclick="switchToAssignmentsView()">
                    <div id="text7">Assignments</div>
                </div>
            </div>
	</div>
	<div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 49%; "><div id="courses_col">
                <div id="coursesNavTab" class="navTab" onclick="switchToCoursesView()">
                    <div id="text8">Courses</div>
                </div>
            </div>
	</div>
	</div>
	</div> 

	<div id="container" style="border:0px solid red; overflow:hidden;">
		<div id="content" style="margin:0px;">
		       <!-- <?php require_once $view ?>-->
		    <div id="assignments">
		       
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
	            <div id="courses">
			<div id="course-list" class="parent-page" style="background-color:#dff;">
				<a loc="course-info">course list</a>
			</div>
			
			<div id="course-info" class="hidden" style="background-color:#ddf;">
				<a loc="BACK">Course information</a>
			</div>
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

	</div>
	
</body>
</html>
