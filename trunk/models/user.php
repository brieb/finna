<?php

class User extends Model
{
    protected $database = 'naturesa_finna';

    public function getCourses ($uid)
    {
        return $this->query("SELECT u.username, c.* FROM users u, user_courses uc, courses c WHERE u.id=:uid AND uc.user_id=u.id AND uc.course_id=c.id ORDER BY number", array(':uid' => $uid));
    }

    public function addCourse ($uid, $cid)
    {
        return $this->query("INSERT INTO user_courses VALUES(:uid, :cid)", array(':uid' => $uid, ':cid' => $cid));
    }

    public function dropCourse ($uid, $cid)
    {
        return $this->query("DELETE FROM user_courses WHERE user_id=:uid AND course_id=:cid", array(':uid' => $uid, ':cid' => $cid));
    }
    
}

?>