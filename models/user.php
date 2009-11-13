<?php

class User extends Model
{
    protected $database = 'naturesa_finna';


    public function getAssignments($uid)
    {
        return $this->query("SELECT c.number course_number, a.*, IF(ua.priority, ua.priority, 2) priority, ua.complete FROM courses c, user_courses uc, assignments a LEFT JOIN user_assignments ua ON ua.assignment_id=a.id WHERE c.id=uc.course_id AND a.course_id=c.id AND uc.user_id=:uid ORDER BY due_date", array(':uid' => $uid));
    }
    
    public function getCourses($uid)
    {
        return $this->query("SELECT u.username, c.* FROM users u, user_courses uc, courses c WHERE u.id=:uid AND uc.user_id=u.id AND uc.course_id=c.id ORDER BY number", array(':uid' => $uid));
    }

    public function addCourse($uid, $cid)
    {
        return $this->query("INSERT INTO user_courses VALUES(:uid, :cid)", array(':uid' => $uid, ':cid' => $cid));
    }

    public function dropCourse($uid, $cid)
    {
        return $this->query("DELETE FROM user_courses WHERE user_id=:uid AND course_id=:cid", array(':uid' => $uid, ':cid' => $cid));
    }
    
}

?>