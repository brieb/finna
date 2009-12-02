<?php

class Course extends Model
{
    protected $database = 'naturesa_finna';

    public function findCoursesByNumber($search, $limit=10)
    {
        // add a space to the search string if not already exists
//        for ($i=0; i<strlen($search); $i++){
//            $char = substr($search, $i, 1);
//            if ($char == " ") break;
//            if (intval($char)!=0){
//                $search = substr($search, 0, $i)+" "+substr($search, $i);
//                break;
//            }
//        }
        
        return $this->query("SELECT * FROM courses WHERE number LIKE :search LIMIT $limit", array(':search'=>$search));
    }

    public function getCourse($id)
    {
        $results = $this->query("SELECT * FROM courses WHERE id=:id", array(':id'=>$id));
	if (empty($results)) return null;
        return $results[0];
    }
    
    public function addCourse($number, $title, $description)
    {
        return $this->query("INSERT INTO courses (number, title, description) VALUES(:number, :title, :desc)", array(':number' => $number,':title' => $title, ':desc' => $description));
    }
    
}

?>