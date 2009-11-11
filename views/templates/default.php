<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?= $page_title ?></title>

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="user-scalable=false,initial-scale=1.0" />
<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

<link rel = "stylesheet" href = "css/EdgeToEdge.css" />

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript"> google.load("jquery", "1.3.2"); </script>
<script src="js/fixed.js" type="text/javascript" charset="utf-8"></script>

<style type="text/css">

#container {
	width: 320px;
	position: relative;
}

div.parent-page, #header, #footer {
	-webkit-transition: left 0.5s ease;
	position: absolute;
	display: block;
	left: 0px;
	width: 100%;
}

div.parent-page.hidden, #header.hidden, #footer.hidden {
	left: -330px;
}

div.child-page {
	-webkit-transition: left 0.5s ease;
	position: absolute;
	display: block;
	left: 0px;
	width: 100%;
}

#task-info.hidden, #course-info.hidden, div.child-page.hidden {
	left: 330px;
}


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


.assignDetail_template {
    position: relative;
    list-style-type: none;
    height: 47px;
    overflow: hidden;
    margin: 0px;
    padding: 0px;
    border-bottom-width: 1px;
    border-bottom-style: solid;
    border-bottom-color: rgb(224, 224, 224);
}

.label_template {
    position: absolute;
    top: 12px;
    height: 22px;
    color: black;
    font-family: Helvetica;
    font-weight: bold;
    font-size: 20px;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
    width: auto;
    right: 30px;
    left: 10px;
}

.arrow_template {
    position: absolute;
    width: 8px;
    height: 13px;
    right: 11px;
    top: 17px;
    background-image: url(img/chevron.png);
    background-repeat: no-repeat;
}


.assignDetail_template .row-selection-BG {
    background-image: url(img/selectedRowiPhone.png);
    background-repeat: initial;
    background-attachment: initial;
    -webkit-background-clip: initial;
    -webkit-background-origin: initial;
    background-color: rgb(38, 127, 239);
    -webkit-background-size: 100% 100%;
}

.assignDetail_template.selected .label_template {
    color: white;
}

.assignDetail_template.selected .arrow_template {
    background-image: url(img/chevron_white.png);
}
</style>

<script type="text/javascript">

    var currentPage;
    var prevPage;
        
</script>



<script>
function switchToAssignmentsView (){
    $('#assignments').removeClass('hidden');
    $('#courses').addClass('hidden');
    $('#add-course-button').addClass('hidden');
    $('#assignment-sort-buttons').removeClass('hidden');
    $('#coursesNavTab').css('opacity','0.5');
    $('#assignmentsNavTab').css('opacity','1');
    prevPage = currentPage;
    currentPage = $('#due-content');
}

function switchToCoursesView (){
    $('#assignments').addClass('hidden');
    $('#courses').removeClass('hidden');
    $('#add-course-button').removeClass('hidden');
    $('#assignment-sort-buttons').addClass('hidden');
    $('#coursesNavTab').css('opacity','1');
    $('#assignmentsNavTab').css('opacity','0.5');
    prevPage = currentPage;
    currentPage = $('#course-list');
}



</script>


<link rel="stylesheet" type="text/css" href="css/iphone.css">
</head>


<body style="margin:0px; width:320px;" onorientationchange="updateOrientation()" onload="load();">

	<div id="debug" style="position:absolute; z-index:999; top:0; left:0;
	  background:black; color:white; display:none;"></div>

	<div id="wallpaper">
	
	<div id="header" class="parent-page">
	  
	<div id="columnLayout">
        <div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 51%; ">
			<div id="assign_col">
                <div id="assignmentsNavTab" class="navTab">
                    <div id="text7">Assignments</div>
                </div>
            </div>
		</div>
		<div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 49%; ">
			<div id="courses_col">
                <div id="coursesNavTab" class="navTab">
                    <div id="text8">Courses</div>
                </div>
           </div>
		</div>
	</div>
	
	</div> 

	<div id="container">
		<div id="content" style="margin:0px;">
		      <!-- <?php require_once $view ?> -->
		
		    <div id="assignments">
		       
			<div id="due-content" class="parent-page" style="display:block;">
			  <ul>
			        <?php foreach ($assignmentsByDue as $assignment): ?>
			  <li loc="task-info" class="assignDetail_template">
			    <div class="row-selection-BG" style="position: absolute; right: 0pt; left: 0pt; top: 0pt; bottom: 0pt; opacity: 1; display:none;"></div>
                    <div class="label_template"><a><?= $assignment['title'] ?></a></div>
                    <div class="arrow_template"></div>
                </li>
			        <?php endforeach; ?>
			  </ul>
			</div>
			
			<div id="priority-content" class="parent-page" style="display:none;">			  <ul>
			        <?php foreach ($assignmentsByPriority as $assignment): ?>
			  <li loc="task-info" class="assignDetail_template">
			    <div class="row-selection-BG" style="position: absolute; right: 0pt; left: 0pt; top: 0pt; bottom: 0pt; opacity: 1; display:none;"></div>
                    <div class="label_template"><a><?= $assignment['title'] ?></a></div>
                    <div class="arrow_template"></div>
                </li>
			        <?php endforeach; ?>
			  </ul>
			</div>
			
			<div id="course-content" class="parent-page" style="display:none; background-color:#dfd;">
			    <?php print_array($assignmentsByPriority) ?>
			</div>
			
			<div id="done-content" class="parent-page" style="display:none; background-color:#dff;">
			    <?php print_array($assignmentsByPriority) ?>
			</div>
			
			<div id="task-info" class="hidden child-page" style="background-color:#ddf;">
				<a loc="BACK">My task information</a>
			</div>
			</div>
			
			
		    </div>
	            <div id="courses" class="hidden">
			<div id="course-list" class="parent-page">
			  <ul>
			        <?php foreach ($userCourses as $course): ?>
			  <li loc="course-info" class="assignDetail_template">
			    <div class="row-selection-BG" style="position: absolute; right: 0pt; left: 0pt; top: 0pt; bottom: 0pt; opacity: 1; display:none;"></div>
                    <div class="label_template"><?= $course['number'] ?></div>
                    <div class="arrow_template"></div>
                </li>
			        <?php endforeach; ?>
			  </ul>
			</div>
			
			<div id="course-info" class="hidden child-page" style="background-color:#ddf;">
				<a loc="BACK">Back</a>
				<h1>Course Title</h1>
					<h1 id="time">Time:</h1>
						<h2>MWF 11:00am-11:50am</h2>
					<h1 id="location">Location:</h1>
						<h2>Gates 100</h2>
					<h1>Office Hours:</h1>
						<h2>TTh 3:00pm-4:30pm</h2>
			</div>

			<div id="add-course" class="hidden child-page">
				<a loc="BACK">Back</a>
			        <br/><br/>
			        Enter the course number:<br/><input type=text id="course-number" style="font-family: Lucida Grande; font-size:15px;" onKeyUp="getCoursesByNumber()"/>
			        <br/>
			        <input type=button value="add course" onClick="getCoursesByNumber(true)"/>
			        <br/>
			        <div id="add-course-results"></div>
			</div>
			
		    </div>
			
		</div>
	</div>

     <script type="text/javascript">

     function addUserCourse(id){
	$.getJSON("addUserCourse", { cid: id }, function(json){
	  if (json.result == "success"){
	    $("#add-course-results").html("course added");
	    var template = $("#course-list-element-template").clone();
	    template.children(".label_template").html(json.course.number);
	
	    $("#course-list ul").append(template);
	  } else {
	    $("#add-course-results").html("failed to add course");
	  }
        });
     }

     function getCoursesByNumber(add){
	add = add==null ? false:true;
	var text = $("#course-number").val();
	if (text.length < 2) return;
	$.getJSON("getCourses", { search: text }, function(json){
	  $("#add-course-results").html("");
	  if (json.length==1){
	     $("#course-number").css('background-color','green');
	     if (add) addUserCourse(json[0].id);
	  } else if (json.length==0){
	     $("#course-number").css('background-color','red');
	  } else {
	     $("#course-number").css('background-color','white');
	  }
          $.each(json, function(i,item){
            $("<div>"+item.number+"</div>").appendTo("#add-course-results");
          });
        });
      }
      </script>

	<div id="footer"  class="parent-page">
	    <div id="assignment-sort-buttons">
		<ul>
			<li class="due active" id="duedate-sort"><span>Due Date</span></li>
			<li class="priority" id="priority-sort"><span>Priority</span></li>
			<li class="courses" id="course-sort"><span>Courses</span></li>
			<li class="trash" id="done-sort"><span>Trash</span></li>
		</ul>
            </div>
	    <div id="add-course-button" class="hidden">
	      <div style="text-align:center;">
	        <a loc="add-course" style="color:white; font-size:24px; font-weight:bold; text-align:center; display:block; margin:auto; margin-top:14px;">+ Add New Course</a>
	      </div>
	    </div>

	</div>

<ul style="display:none">
	<li id="course-list-element-template" loc="course-info" class="assignDetail_template">
			    <div class="row-selection-BG" style="position: absolute; right: 0pt; left: 0pt; top: 0pt; bottom: 0pt; opacity: 1; display:none;"></div>
                    <div class="label_template"></div>
                    <div class="arrow_template"></div>
                </li>
</ul>
	
</body>
</html>
