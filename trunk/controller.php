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
        set('page_title','First Finna page');
    	set('userCourses', $this->User->getCourses(1));
    	$assignments = $this->User->getAssignments(1);
    	set('assignmentsByDue', $assignments);
    	$byPriority = Array( Array(), Array(), Array(), Array() );
    	foreach ($assignments as $assign){
            if ($assign['complete']==1) continue;
            $byPriority[$assign['priority']][] = $assign;
    	}
    	set('assignmentsByPriority', array_merge($byPriority[2],$byPriority[1],$byPriority[0]));
	
    }

    public function getCourses()
    {
        echo json_encode( $this->Course->findCoursesByNumber($_REQUEST['search'].'%') );
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
