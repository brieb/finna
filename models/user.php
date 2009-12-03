<?php

class User extends Model
{
    protected $database = 'naturesa_finna';



    private function formatDates($aList)
    {
        for ($i=0; $i<count($aList); $i++){
            $aList[$i]['due_date'] = date("D M j",strtotime($aList[$i]['due_date']));
        }
        return $aList;
    }

    private function formatLongDates($aList)
    {
        for ($i=0; $i<count($aList); $i++){
            $aList[$i]['due_date'] = date("l M j, Y",strtotime($aList[$i]['due_date']));
        }
        return $aList;
    }

    public function getAssignments($uid)
    {
        return $this->formatLongDates($this->query("SELECT DISTINCT c.number course_number, a.*, IF(ua.priority, ua.priority, 2) priority, IF(ua.complete, 1, 0) complete FROM courses c, user_courses uc, assignments a LEFT JOIN user_assignments ua ON ua.assignment_id=a.id AND ua.user_id=:uid WHERE c.id=uc.course_id AND a.course_id=c.id AND uc.user_id=:uid ORDER BY due_date, priority DESC", array(':uid' => $uid)));
    }

    public function getCompletedAssignments($uid)
    {
        return $this->formatDates($this->query("SELECT DISTINCT c.number course_number, a.*, IF(ua.priority, ua.priority, 2) priority, IF(ua.complete, 1, 0) complete FROM courses c, user_courses uc, assignments a LEFT JOIN user_assignments ua ON ua.assignment_id=a.id AND ua.user_id=:uid WHERE c.id=uc.course_id AND a.course_id=c.id AND complete=1 AND uc.user_id=:uid ORDER BY due_date, priority DESC", array(':uid' => $uid)));
    }

    public function getAssignmentsByPriority($uid)
    {
        return $this->formatDates($this->query("SELECT DISTINCT c.number course_number, a.*, IF(ua.priority, ua.priority, 2) priority, IF(ua.complete, 1, 0) complete FROM courses c, user_courses uc, assignments a LEFT JOIN user_assignments ua ON ua.assignment_id=a.id AND ua.user_id=:uid WHERE c.id=uc.course_id AND a.course_id=c.id AND uc.user_id=:uid AND !(a.id IN (SELECT assignment_id FROM user_assignments WHERE user_id=:uid AND complete=1)) ORDER BY priority DESC, due_date", array(':uid' => $uid)));
    }

    public function getAssignmentsByDue($uid)
    {
        return $this->formatDates($this->query("SELECT DISTINCT c.number course_number, a.*, IF(ua.priority, ua.priority, 2) priority, IF(ua.complete, 1, 0) complete FROM courses c, user_courses uc, assignments a LEFT JOIN user_assignments ua ON ua.assignment_id=a.id AND ua.user_id=:uid WHERE c.id=uc.course_id AND a.course_id=c.id AND uc.user_id=:uid AND !(a.id IN (SELECT assignment_id FROM user_assignments WHERE user_id=:uid AND complete=1)) ORDER BY due_date, priority DESC;", array(':uid' => $uid)));
    }

    
    public function getCourses($uid)
    {
        return $this->query("SELECT DISTINCT u.username, c.* FROM users u, user_courses uc, courses c WHERE u.id=:uid AND uc.user_id=u.id AND uc.course_id=c.id ORDER BY number", array(':uid' => $uid));
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