<?php

class Assignment extends Model
{
    protected $database = 'naturesa_finna';

    public function getAssignments ($uid)
    {
        return $this->query("SELECT c.number course_number, a.*, ua.priority, ua.complete FROM courses c, user_courses uc, assignments a LEFT JOIN user_assignments ua ON ua.assignment_id=a.id WHERE c.id=uc.course_id AND a.course_id=c.id AND uc.user_id=:uid ORDER BY due_date", array(':uid' => $uid));
    }
    
}

?>