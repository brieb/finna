<?php

class AppController
{
    public $uses = array('Course','User','Assignment');
    public $config = null;
    /*
     *   Load the models
     */
    public function __construct()
    {
        $this->config = Config::getInstance();
        
        if (isset($this->uses)){
            foreach ($this->uses as $use){
                $model = '../models/'.strtolower($use).'.php';
                if (!file_exists($model)) {
                    throw new Exception('Missing model: '.$model,1);
                }
                require_once($model);
		        $this->$use = new $use();
            }
        }
        
        if (!$this->config->isAjax){
        }
    }


    public function index()
    {
        set('page_title','Finna - Get it done.');
    	set('userCourses', $this->User->getCourses(1));
    	
    	$assignments = $this->User->getAssignments(1);
    	set('allAssignments', $assignments);
    	
    	
    	$assignmentsByDue = $this->User->getAssignmentsByDue(1);
    	set('assignmentsByDue', $assignmentsByDue);
    	
//    	$byPriority = Array( Array(), Array(), Array(), Array() );
//    	$completed = Array();
//    	foreach ($assignments as $assign){
//            if ($assign['complete']==1){
//                $completed[] = $assign;
//            }
//            $byPriority[$assign['priority']][] = $assign;
//    	}
//    	$byPriority = array_merge($byPriority[3], $byPriority[2], $byPriority[1]);

        $byPriority = $this->User->getAssignmentsByPriority(1);
    	set('assignmentsByPriority', $byPriority);
    	
        $completed = $this->User->getCompletedAssignments(1);
    	set('completedAssignments', $completed);
	}

	public function priorityAssignments()
	{
    	$assignmentsByPriority = $this->User->getAssignmentsByPriority($_REQUEST['uid']);
    	require_once "../views/elements/prioritySort.php";
	}

	public function dueAssignments()
	{
    	$assignmentsByDue = $this->User->getAssignmentsByDue($_REQUEST['uid']);
    	require "../views/elements/dueSort.php";
	}

	public function completedAssignments()
	{
    	$completedAssignments = $this->User->getCompletedAssignments($_REQUEST['uid']);
    	require_once "../views/elements/completedSort.php";
	}

	public function assignmentInfo()
	{
    	$allAssignments = $this->User->getAssignments($_REQUEST['uid']);
    	require_once "../views/elements/assignmentInfo.php";
	}
	
	public function setUserAssignPriority()
	{
	    // no feedback for this function
	    $this->Assignment->setPriority($_REQUEST['aid'], $_REQUEST['uid'], $_REQUEST['priority']);
	}

    public function userCourseList()
    {
    	$userCourses = $this->User->getCourses($_REQUEST['uid']);
    	require_once "../views/elements/courseList.php";
    }

    public function userCourseInfo()
    {
    	$userCourses = $this->User->getCourses($_REQUEST['uid']);
    	require_once "../views/elements/courseInfo.php";
    }
    

    public function getCourses()
    {
        $results = $this->Course->findCoursesByNumber($_REQUEST['search'].'%');
        $match = $this->Course->findCoursesByNumber($_REQUEST['search']);
        $match = count($match)==1;
        echo json_encode( Array("match"=>$match, "results"=>$results) );
    }
    
    
    
    public function addAssignment()
    {
        $result = "success";
        $months = Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec' );
        list($month, $day, $year) = explode(' ', $_REQUEST['dueDate']);
        $month = array_keys($months, $month);
        $month = $month[0]+1;
        $dueDate = $year."-".$month."-".$day." 23:59:59";
        //$dueDate = "2009-11-21 23:59:59";
        $this->Assignment->addAssignment($_REQUEST['cid'], $_REQUEST['title'], $dueDate, $_REQUEST['desc']);
        echo json_encode( array("result"=>$result ) );
    }

    public function addUserCourse()
    {
        $result = "success";
        $this->User->addCourse(1, $_REQUEST['cid']);
        echo json_encode( array("result"=>$result, "course"=>$this->Course->getCourse($_REQUEST['cid']) ) );
    }

    public function dropUserCourse()
    {
        $result = "success";
        $this->User->dropCourse(1, $_REQUEST['cid']);
        echo json_encode( array("result"=>$result, "courseId"=>$_REQUEST['cid'] ) );
    }

    public function login()
    {
        
    }
    
}

?>
