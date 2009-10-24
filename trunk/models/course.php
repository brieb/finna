<?php

class Course extends Model
{
    protected $database = 'naturesa_finna';

    public function findCoursesByNumber($search)
    {
        return $this->query("SELECT * FROM courses WHERE number LIKE '$search'");
    }
    
    public function addCourse($number, $title, $description)
    {
        return $this->query("INSERT INTO courses (number, title, description) VALUES(:number, :title, :desc)", array(':number' => $number,':title' => $title, ':desc' => $description));
    }
    
}

?>