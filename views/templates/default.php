<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
    $priorityImages = array("", "low-priority.png", "normal-priority.png", "high-priority.png");
    $priorityPositions = array("", "top:12px; left:6px; height:23px;", "top: 15px; left: 8px;", "top:8px; left:12px; height:33px;")
?>


<head>
<style type="text/css">

#task-info li {
	display: inline;
	list-style-type: none;
}

.title {
  /* use absolute positioning and transforms as these will be subject to hardware transitions */
  position: absolute;
  -webkit-transform: translate(80px, 0px);
  /* base metrics */
  height: 31px;
  margin-top: 3px;
  /* the titles should be displayed below the button so that they don't receive touches */
  z-index: 0;
  /* set up the font appearance */
  font-size: 16pt;
  font-weight: bold;
  color: white;
  text-shadow: rgba(0, 0, 0, .6) 0px -1px 0px;
  /* enfore trimming if the label is too long */
  white-space : nowrap;
  overflow : hidden;
  text-overflow: ellipsis;
}

.navbutton {
  /* use absolute positioning and transforms as these will be subject to hardware transitions */
  position: absolute;
  -webkit-transform: translate(250px, 6px);
  /* the buttons should be displayed on top of the titles so that they can always receive touches */
  z-index: 1;
  /* set up the font appearance */
  font-size: 12px;
  font-weight: bold;
  text-align: center;
  color: white;
  text-shadow: rgba(0, 0, 0, .6) 0px -1px 0px;
  /* set up the chrome background */
  -webkit-border-image : url(/finna/img/navbutton.png) 0 4 0 13;
  border-width : 0 4px 0 13px;
  padding-top: 7px;
  padding-right: 4px;
  /* base metrics used to ensure a minumum size and specify a max size that can be used to trim the contents */
  min-width: 40px;
  max-width: 60px;
  height: 23px; 
  /* enfore trimming if the label is too long */
  white-space : nowrap;
  overflow : hidden;
  text-overflow: ellipsis;
}

/* touched state for the buttons */
.navbutton:active {
  -webkit-border-image : url(/finna/img/navbutton_clicked.png) 0 4 0 13;
}

</style>
<title><?= $page_title ?></title>

<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="user-scalable=false,initial-scale=1.0" />
<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript"> google.load("jquery", "1.3.2"); </script>
<script src="js/fixed.js" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" type="text/css" href="css/iphone.css">
</head>


<body style="margin:0px; width:320px;" onorientationchange="updateOrientation()" onload="load();">
	
	<div id="header" style="background-color:#ccc">
	
		<div id="main-header" class="parent-page">
        	<div id="columnLayout">
                <div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 51%; ">
        			<div id="assign_col">
                        <div id="assignmentsNavTab" class="navTab">
                            <div class="title">Assignments</div>
                        </div>
                    </div>
        		</div>
        	</div>
        	<div id="first_button" class="navbutton">Add</div>
    	</div>
    	
    	<div id="assignment-header" class="child-page hidden">
        	<div id="first_button" class="navbutton">Back</div>
        	<div id="columnLayout">
                <div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 51%; ">
        			<div id="assign_col">
                        <div id="assignmentsNavTab" class="navTab">
                            <div class="title">My Assignment</div>
                        </div>
                    </div>
        		</div>
        	</div>
        	<div id="first_button" class="navbutton">Delete</div>
    	</div>
    	
    	<div id="course-header" class="child-page hidden">
        	<div id="columnLayout">
                <div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 51%; ">
        			<div id="assign_col">
                        <div id="assignmentsNavTab" class="navTab">
                            <div class="title">Course Edit</div>
                        </div>
                    </div>
        		</div>
        	</div>
        	<div id="first_button" class="navbutton">Drop</div>
    	</div>
    	
	</div> 

	<div id="container">
		<div id="content" style="margin:0px;">
		    <!-- <?php require_once $view ?> -->
		       
			<div id="due-content" class="parent-page" style="display:block;">
                <ul>
                    <?php foreach ($assignmentsByDue as $assignment): ?>
                        <li loc="assignment-info-<?= $assignment['id'] ?>" header="assignment-header" class="assignDetail_template" style="font-family:Helvetica">
                        	<div class="row-selection-BG">
                        	</div>
                            <img src="/finna/img/<?= $priorityImages[$assignment['priority']] ?>" style="position:absolute; <?= $priorityPositions[$assignment['priority']] ?>"/>
                            <div style="position:absolute; top:6px; left:35px; font-weight:bold; font-size:16px; text-overflow:ellipsis;">
                                <?= $assignment['title'] ?>
                            </div>
            				<div style="position:absolute; top:26px; left:35px; font-size:15px; color:#444">
            					<?= $assignment['course_number'] ?>
            				</div>
            				<div style="position:absolute; top:26px; right:35px; font-size:15px; color:#444">
            					Tue Apr 31
            				</div>
                            <div class="li-arrow-template"></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
			</div>
			
			<div id="priority-content" class="parent-page" style="display:none;">
			    <ul>
			        <?php foreach ($assignmentsByPriority as $assignment): ?>
        			    <li loc="assignment-info-<?= $assignment['id'] ?>" class="assignDetail_template">
        			        <div class="row-selection-BG" style="position: absolute; right: 0pt; left: 0pt; top: 0pt; bottom: 0pt; opacity: 1; display:none;"></div>
                            <div class="label_template">
                                <a>
                                    <?= $assignment['title'] ?>
                                </a>
                            </div>
                            <div class="arrow_template"></div>
                        </li>
			        <?php endforeach; ?>
			    </ul>
			</div>
			
			<div id="done-content" class="parent-page hidden" style="display:none; background-color:#dff;">
			    <?php print_array($assignmentsByPriority) ?>
			</div>
			
	        <?php foreach ($assignmentsByDue as $assignment): ?>
	        	<div id="assignment-info-<?= $assignment['id'] ?>" class="hidden child-page">
	        	     <a loc="BACK" style="display:block; background:#248; color:white;">
	        	     	Return to assignments list
	        	     </a><br/>
                     Title: <?= $assignment['title'] ?><br/><br/>
                     Due: <?= $assignment['due_date'] ?><br/><br/>
                     Course: <?= $assignment['course_number'] ?><br/><br/>
                </div>
	        <?php endforeach; ?>
			
			
			
    		<div id="course-list" class="parent-page" style="display:none">
    		    <ul>
    		        <?php foreach ($userCourses as $course): ?>
        			    <li loc="course-info-<?= $course['id'] ?>" header="course-header" id="course-li-<?= $course['id'] ?>" class="assignDetail_template">
            			    <div class="row-selection-BG" style="position: absolute; right: 0pt; left: 0pt; top: 0pt; bottom: 0pt; opacity: 1; display:none;"></div>
                            <div class="label_template">
                                <?= $course['number'] ?>
                            </div>
                            <div class="arrow_template"></div>
                        </li>
    		        <?php endforeach; ?>
    		    </ul>
    		</div>
    		
	        <?php foreach ($userCourses as $course): ?>
	        	<div id="course-info-<?= $course['id'] ?>" class="hidden child-page">
	        	     <a loc="BACK" style="display:block; background:#248; color:white;">
	        	     	Return to course list
	        	     </a><br/>
                     Number: <?= $course['number'] ?><br/><br/>
                     Title: <?= $course['title'] ?><br/><br/>
                     Description: <?= $course['description'] ?><br/><br/>
                     <a onclick="dropUserCourse(<?= $course['id'] ?>)" style="display:block; background:#842; color:white;">
	        	     	Drop course
	        	     </a><br/>
                </div>
	        <?php endforeach; ?>
    
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

    <script type="text/javascript">
    function dropUserCourse(id){
    	$.getJSON("dropUserCourse", { cid: id }, function(json){
        	if (json.result == "success"){
                $("#course-li-"+json.courseId).remove();
        	    gotoPage("BACK");
        	} else {
            	// failed
        	}
        });
    }

    function addUserCourse(id){
    	$.getJSON("addUserCourse", { cid: id }, function(json){
        	if (json.result == "success"){
                $("#course-info").html("course added");
                var template = $("#course-list-element-template").clone();
                template.children(".label_template").html(json.course.number);
        		
        	    $("#course-list ul").append(template);
        	    gotoPage("BACK");
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
    			<li class="due active" id="duedate-sort"><span>Sort by Due</span></li>
    			<li class="priority" id="priority-sort"><span>Priority Sort</span></li>
    			<li class="trash" id="done-sort"><span>Completed</span></li>
    			<li class="courses" id="course-sort"><span>My Courses</span></li>
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
