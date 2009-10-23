<?php

class Course extends Model
{
    protected $database = 'naturesa_finna';


    public function getCourses()
    {
        return $this->query("SELECT * FROM courses");
    }

    
    public function addCourse($number, $title)
    {
        return $this->query("INSERT INTO courses (number, title) VALUES(:number, :title)", array(':number' => $number,':title' => $title));
    }
    
}

?>