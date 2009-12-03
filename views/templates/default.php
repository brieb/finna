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
	document.getElementById('add-assignment-date').innerHTML = curDateDef.getDay()+' '+months[curDateDef.getMonth()+1] +' '+curDateDef.getDate();
*/
}


window.addEventListener('load', function(){ setTimeout(function(){ window.scrollTo(0,0); }, 100); }, true);

</script>

</head>


<body style="margin:0px; width:320px;" onorientationchange="updateOrientation()" onload="load();">
	
	<div id="header" style="background-color:#ccc">
	
		<div id="main-header" class="parent-page">
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
<!--
	
		<script type="text/javascript">
			$("#due-content").css("display", "none");
			$("#course-list").css("display", "block");
		</script>

-->
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
			
    		<div id="course-list" class="parent-page" style="display:none;">
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
    	        <span>Enter the course: (ex CS147)</span>
    	        <form name="addCourseForm">
    	        <input name="addCourseText" type=text id="course-number" class="textInput" onKeyUp="getCoursesByNumber()" style="width:180px;"/>
    	        <input type=button value="add course" onClick="getCoursesByNumber(true)" style="float:right; width: 120px; height:40px; margin-right: 5px; font: bold 17px Helvetica;"/>
    	        </form>
    	        <br/>
    	        <ul id="add-course-results" class="inlineButtonList"></ul>
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

    function toggleAssignmentDescription(header, aid){
    	$(header).parent().children().removeClass('active');
    	$(header).addClass('active');
        if ($(header).attr('id')!="descriptionButton"){
        	$("#assignment-description-"+aid).css("display","none");
        	$("#assignment-announcements-"+aid).css("display","block");
        } else {
        	$("#assignment-description-"+aid).css("display","block");
        	$("#assignment-announcements-"+aid).css("display","none");
        }
            
    }


    function updatePriority(elem, assignId){
    	$(elem).parent().children().removeClass('active');
    	$(elem).addClass('active');
    	$.get("setUserAssignPriority", { uid: 1, aid: assignId, priority: $(elem).attr('priority') }, function(data){ 
			refreshAssignments();
			$('#saveFlash-'+assignId).css('display','block');
			setTimeout("$('#saveFlash-"+assignId+"').css('display','none');",2000);
    	});
    }

    function updateComplete(assignId){
        var qelem = $("#statusCheckbox-"+assignId);
        qelem.attr('checked', !qelem.attr('checked'));
    	$.get("setUserAssignComplete", { uid: 1, aid: assignId, complete: qelem.attr('checked')?1:0 }, function(data){ 
			refreshAssignments();
			$('#saveFlash-'+assignId).css('display','block');
			setTimeout("$('#saveFlash-"+assignId+"').css('display','none');",2000);
    	});
    }

	function addAssignment(){
		var date = $('#add-assignment-date').html();

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
        	    
        		$('#assignCourseSelection').val("");
        		$('#assignTitleField').val("");
                $('#assignDescriptionTextArea').val("");
        	} else {
        	    $("#add-course-results").html("failed to add course");
        	}
        });
	}
    
    function dropUserCourse(){
        if (!confirm("Are you sure you want to drop this course from Finna?")) return;
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
		<?php    
			//$i = 0;
           // $myCourses = count($userCourses)-1;
            foreach ($userCourses as $myCourse):
        ?>
    	<?php if (json.result == $myCourse):
    	?>
    		alert("YAY");
    	<?php endif; ?>
    	<?php endforeach; ?>
    	
    	
        	if (json.result == "success"){
                $("#add-course-results").html("course added");
            	refreshAssignments();
            	refreshAssignInfo();
            	refreshCourses();
            	document.addCourseForm.addCourseText.value='';
            	$("#course-number").css('background-color','white');
        	    gotoPage("BACK");
        	    $("#add-course-results").html("");
        	} else {
        	    $("#add-course-results").html("failed to add course");
        	}
        });
    }

    function getCoursesByNumber(add){
        var onCourseChoiceEnd = function(){
        	$("#course-number").val($(this).html());
        }
        
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
        	for (var i=0; i<3; i++){
        		var elem = $("<li id='courseOption"+i+"'>"+json.results[i].number+"</li>");
        		elem.appendTo("#add-course-results");
        		elem.click(onCourseChoiceEnd);
        	}
        }); 
        
     }
     
     function showAssignSortButtons(){
     	$("#main-header div.title").html("Assignments");
		var addBtn = $("#addObjectButton");
		addBtn.attr('loc',"add-assignment");
		addBtn.attr('header',"add-assignment-header");
     	$("#course-list").css("display", "none");
	    currentPage = $("#due-content");
		currentPage.css("display", "block");
		$("#duedate-sort").addClass('active');
		$("#course-sort").removeClass('active');
     	
     	$("#assignment-sort-buttons").css("display", "block");
		$("#view-assignments-button").css("display", "none");
     }
     </script>

	<div id="footer" class="parent-page">
	    <div id="assignment-sort-buttons">
    		<ul>
    			<li class="due active" id="duedate-sort"><span>Sort by Due</span></li>
    			<li class="priority" id="priority-sort"><span>Priority Sort</span></li>
    			<li class="trash" id="done-sort"><span>Completed</span></li>
    			<li class="courses" id="course-sort"><span>My Courses</span></li>
    		</ul>
        </div>

        <div id="view-assignments-button" style="text-align:center; display:none;">
	        <a ontouchend="showAssignSortButtons()" style="color:white; font-size:24px; font-weight:bold; text-align:center; display:block; margin:auto; margin-top:14px;">View/Add Assignments</a>

		</div>
     <div>

	
	      
	    </div>
	</div>	
	
			<?php if (empty($userCourses)):	?>
    			<script type="text/javascript">
					$("#main-header div.title").html("My Courses");
					var addBtn = $("#addObjectButton");
					addBtn.attr('loc',"add-course");
					addBtn.attr('header',"add-course-header");
					
					$("#due-content").css("display", "none");
					$("#course-list").css("display", "block");
					
					$("#assignment-sort-buttons").css("display", "none");
					$("#view-assignments-button").css("display", "block");
				</script>
			<?php endif; ?>
	
</body>

</html>
