<?php

class Student {
    public $id;
    public $name;
    public $course;
    public $speciality;

    public function  __construct($id, $array){

        $this->id = $id;
        $this->name = $array['name'];
        $this->course = $array['course'];
        $this->speciality = $array['speciality'];
    }

    public static function validationDataStudents($array){

        return !(
            empty($array['name']) ||
            empty($array['course']) ||
            empty($array['speciality']) ||
            !isset($array)
        );
    }
}