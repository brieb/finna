<?php

class Assignment extends Model
{
    protected $database = 'naturesa_finna';


    public function addAssignment($courseId, $title, $dueDate, $description)
    {
        return $this->query("INSERT INTO assignments (title, due_date, course_id, description) VALUES(:title, :due_date, :course_id, :desc)", 
                        array(':title' => $title, ':due_date'=>$dueDate, 'course_id'=>$courseId, ':desc' => $description));
    }
    
    public function setPriority($aid, $uid, $priority)
    {   
        $result = $this->query("SELECT * FROM user_assignments WHERE user_id=:uid AND assignment_id=:aid",
                            array(':uid' => $uid, ':aid'=> $aid));
        if (empty($result)){
            $this->query("INSERT INTO user_assignments VALUES(:uid,:aid,:priority,0)",
                            array(':uid' => $uid, ':aid'=> $aid, ':priority'=>$priority));
        } else {
            $this->query("UPDATE user_assignments SET priority=:priority WHERE user_id=:uid AND assignment_id=:aid",
                            array(':uid' => $uid, ':aid'=> $aid, ':priority'=>$priority));
        }
    }
}

?>