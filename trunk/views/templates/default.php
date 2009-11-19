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

<link rel="stylesheet" href="css/spinningwheel.css" type="text/css" media="all" />
<script type="text/javascript" src="js/spinningwheel-min.js?v=1.4"></script>

<link rel="stylesheet" type="text/css" href="css/iphone.css">

<script type="text/javascript">

function openDatePicker() {
	var now = new Date();
	var days = { };
	var years = { };
	var months = { 1: 'Jan', 2: 'Feb', 3: 'Mar', 4: 'Apr', 5: 'May', 6: 'Jun', 7: 'Jul', 8: 'Aug', 9: 'Sep', 10: 'Oct', 11: 'Nov', 12: 'Dec' };
	
	for( var i = 1; i < 32; i += 1 ) {
		days[i] = i;
	}

	for( i = now.getFullYear()-5; i <= now.getFullYear()+5; i += 1 ) {
		years[i] = i;
	}

	SpinningWheel.addSlot(months, '', now.getMonth()+1);
	SpinningWheel.addSlot(days, 'right', now.getDate());
	SpinningWheel.addSlot(years, 'right', now.getFullYear());
	
	SpinningWheel.setCancelAction(cancel);
	SpinningWheel.setDoneAction(done);
	
	SpinningWheel.open();
}

function done() {
	var results = SpinningWheel.getSelectedValues();
	document.getElementById('add-assignment-date').innerHTML = results.values.join(' ');
}

function cancel() {
	/*
var curDateDef = new Date();
	var months = { 1: 'Jan', 2: 'Feb', 3: 'Mar', 4: 'Apr', 5: 'May', 6: 'Jun', 7: 'Jul', 8: 'Aug', 9: 'Sep', 10: 'Oct', 11: 'Nov', 12: 'Dec' };
	document.getElementById('result').innerHTML = months[curDateDef.getMonth()+1] +' '+curDateDef.getDate()+' '+curDateDef.getFullYear();
*/
	document.getElementById('add-assignment-date').innerHTML = 'Choose date...';
}


window.addEventListener('load', function(){ setTimeout(function(){ window.scrollTo(0,0); }, 100); }, true);

</script>

</head>


<body style="margin:0px; width:320px;" onorientationchange="updateOrientation()" onload="load();">
	
	<div id="header" style="background-color:#ccc">
	
		<div id="main-header" class="parent-page">
        	<a class="backButton" onclick="refreshAssignments()">refresh</a>
        	<div id="columnLayout">
                <div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 51%; ">
        			<div id="assign_col">
                        <div class="navTab" style="width:100%">
                            <div class="title">Assignments</div>
                        </div>
                    </div>
        		</div>
        	</div>
        	<div loc="add-assignment" header="add-assignment-header" id="addObjectButton" class="navbutton">
        		Add
	        </div>
    	</div>
    	
    	<div id="assignment-header" class="child-page hidden">
        	<a loc="BACK" class="backButton" >Back</a>
        	<div id="columnLayout">
                <div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 51%; ">
        			<div id="assign_col">
                        <div class="navTab" style="width:100%">
                            <div class="title">My Assignment</div>
                        </div>
                    </div>
        		</div>
        	</div>
    	</div>
    	
    	<div id="course-header" class="child-page hidden">
        	<a loc="BACK" class="backButton" >Back</a>
        	<div id="columnLayout">
                <div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 51%; ">
        			<div id="assign_col">
                        <div class="navTab" style="width:100%">
                            <div class="title">Course Details</div>
                        </div>
                    </div>
        		</div>
        	</div>       	
        	<div id="dropCourseButton" class="navbutton" onclick="dropUserCourse(<?= $course['id'] ?>)">Drop</div>
    	</div>
    	
    	<div id="add-course-header" class="child-page hidden">
        	<a loc="BACK" class="backButton">Cancel</a>
        	<div id="columnLayout">
                <div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 51%; ">
        			<div id="assign_col">
                        <div class="navTab" style="width:100%">
                            <div class="title">Add Course</div>
                        </div>
                    </div>
        		</div>
        	</div>	
    	</div>
    	
    	<div id="add-assignment-header" class="child-page hidden">
        	<a loc="BACK" class="backButton">Cancel</a>
        	<div id="columnLayout">
                <div style="position: relative; display: table-cell; vertical-align: top; height: auto; width: 51%; ">
        			<div id="assign_col">
                        <div class="navTab" style="width:100%">
                            <div class="title">Add Assignment</div>
                        </div>
                    </div>
        		</div>
        	</div>
    	</div>
    	
	</div> 

	<div id="container">
		<div id="content" style="margin:0px;">
		    <!-- <?php require_once $view ?> -->
		       
			<div id="due-content" class="parent-page">
				<?php require_once "../views/elements/dueSort.php" ?>
			</div>
			
			<div id="priority-content" class="parent-page" style="display:none;">
				<?php require_once "../views/elements/prioritySort.php" ?>
			</div>
			
			<div id="done-content" class="parent-page" style="display:none;">
				<?php require_once "../views/elements/completedSort.php" ?>
			</div>
			
    		<div id="course-list" class="parent-page" style="display:none">
    			<?php require_once "../views/elements/courseList.php" ?>
    		</div>
			
			<div id="assignment-info-container">
				<?php require_once "../views/elements/assignmentInfo.php" ?>
	        </div>
	        
			<div id="course-info-container">
				<?php require_once "../views/elements/courseInfo.php" ?>
	        </div>
			
			<div id="add-assignment" class=" child-page hidden detailContent">
				<?php require_once "../views/elements/addAssignment.php" ?>
            </div>
    
    		<div id="add-course" class="hidden child-page">
    	        <br/>
    	        Enter the course number:<br/><input type=text id="course-number" class="detailText textInput" onKeyUp="getCoursesByNumber()"/>
    	        <br/>
    	        <input type=button value="add course" onClick="getCoursesByNumber(true)"/>
    	        <br/>
    	        <div id="add-course-results"></div>
    		</div>
    		
    	</div>
	</div>

    <script type="text/javascript">

    function refreshAssignments(){
    	$.get("dueAssignments", { uid: 1 }, function(data){
        	$('#due-content').html(data);
        	addLITouchListeners('due-content');
        });

    	$.get("priorityAssignments", { uid: 1 }, function(data){
        	$('#priority-content').html(data);
        	addLITouchListeners('priority-content');
        });

    	$.get("completedAssignments", { uid: 1 }, function(data){
        	$('#done-content').html(data);
        	addLITouchListeners('done-content');
        });
    }

    function refreshAssignInfo(){
    	$.get("assignmentInfo", { uid: 1 }, function(data){
        	$('#assignment-info-container').html(data);
        });
    }

    function refreshCourses(){
    	$.get("userCourseList", { uid: 1 }, function(data){
        	$('#course-list').html(data);
        	addLITouchListeners('course-list');
        });
    	$.get("userCourseInfo", { uid: 1 }, function(data){
        	$('#course-info-container').html(data);
        });
    	$.get("userAddAssignment", { uid: 1 }, function(data){
        	$('#add-assignment').html(data);
        });
    }


    function updatePriority(elem, assignId){
    	$(elem).parent().children().removeClass('active');
    	$(elem).addClass('active');
    	$.get("setUserAssignPriority", { uid: 1, aid: assignId, priority: $(elem).attr('priority') }, function(data){ 
			refreshAssignments();
    	});
    }

    function updateComplete(elem, assignId){
    	$.get("setUserAssignComplete", { uid: 1, aid: assignId, complete: elem.checked?1:0 }, function(data){ 
			refreshAssignments();
    	});
    }

	function addAssignment(){
		var date = $('#add-assignment-date').html();
		$('#add-feedback').html(date);

    	$.getJSON("addAssignment", { 
        		cid: $('#assignCourseSelection').val(),
        		title: $('#assignTitleField').val(),
            	dueDate: $('#add-assignment-date').html(),
                desc: $('#assignDescriptionTextArea').val()
        }, function(json){
        	if (json.result == "success"){
            	refreshAssignments();
            	refreshAssignInfo();
        	    gotoPage("BACK");
        	} else {
        	    $("#add-course-results").html("failed to add course");
        	}
        });
	}
    
    function dropUserCourse(){
    	$.getJSON("dropUserCourse", { cid: currentPage.attr('courseId') }, function(json){
        	if (json.result == "success"){
                $("#course-li-"+json.courseId).remove();
                refreshAssignments();
            	refreshAssignInfo();
            	refreshCourses();
        	    gotoPage("BACK");
        	} else {
            	// failed
        	}
        });
    }

    function addUserCourse(id){
    	$.getJSON("addUserCourse", { cid: id }, function(json){
        	if (json.result == "success"){
                $("#add-course-results").html("course added");
            	refreshAssignments();
            	refreshAssignInfo();
            	refreshCourses();
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
    	    if (json.match){
    	        $("#course-number").css('background-color','green');
    	        if (add) addUserCourse(json.results[0].id);
    	    } else if (json.results.length==0){
    	        $("#course-number").css('background-color','red');
    	    } else {
    	        $("#course-number").css('background-color','white');
    	    }
            $.each(json.results, function(i,item){
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

	
</body>
</html>
