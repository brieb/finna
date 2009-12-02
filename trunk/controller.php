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
    	set('userCourses', $this->User->getCourses(2));
    	
    	$assignments = $this->User->getAssignments(2);
    	set('allAssignments', $assignments);
    	
    	$assignmentsByDue = $this->User->getAssignmentsByDue(2);
    	set('assignmentsByDue', $assignmentsByDue);

        $byPriority = $this->User->getAssignmentsByPriority(2);
    	set('assignmentsByPriority', $byPriority);
    	
        $completed = $this->User->getCompletedAssignments(2);
    	set('completedAssignments', $completed);
	}

	public function priorityAssignments()
	{
    	$assignmentsByPriority = $this->User->getAssignmentsByPriority(2);
    	require_once "../views/elements/prioritySort.php";
	}

	public function dueAssignments()
	{
    	$assignmentsByDue = $this->User->getAssignmentsByDue(2);
    	require "../views/elements/dueSort.php";
	}

	public function completedAssignments()
	{
    	$completedAssignments = $this->User->getCompletedAssignments(2);
    	require_once "../views/elements/completedSort.php";
	}

	public function assignmentInfo()
	{
    	$allAssignments = $this->User->getAssignments(2);
    	require_once "../views/elements/assignmentInfo.php";
	}

	public function setUserAssignPriority()
	{
	    // no feedback for this function
	    $this->Assignment->setPriority($_REQUEST['aid'], 2, $_REQUEST['priority']);
	}

	public function setUserAssignComplete()
	{
	    // no feedback for this function
	    $this->Assignment->setComplete($_REQUEST['aid'], 2, $_REQUEST['complete']);
	}

    public function userCourseList()
    {
    	$userCourses = $this->User->getCourses(2);
    	require_once "../views/elements/courseList.php";
    }

    public function userAddAssignment()
    {
    	$userCourses = $this->User->getCourses(2);
    	require_once "../views/elements/addAssignment.php";
    }

    public function userCourseInfo()
    {
    	$userCourses = $this->User->getCourses(2);
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
        $this->User->addCourse(2, $_REQUEST['cid']);
        echo json_encode( array("result"=>$result, "course"=>$this->Course->getCourse($_REQUEST['cid']) ) );
    }

    public function dropUserCourse()
    {
        $result = "success";
        $this->User->dropCourse(2, $_REQUEST['cid']);
        echo json_encode( array("result"=>$result, "courseId"=>$_REQUEST['cid'] ) );
    }

    public function login()
    {
        
    }
    
}

?>
