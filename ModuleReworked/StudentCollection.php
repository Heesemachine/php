<?php

class StudentCollection
{
    public $students;

    public function defaultStudents()
    {

        $this->students = [

            new Student(1, [
                'id' => 1,
                'name' => 'VVT',
                'course' => '2',
                'speciality' => 'Sys.Analysis',]),

            new Student(2, [
                'id' => 2,
                'name' => 'YNI',
                'course' => '2',
                'speciality' => 'Sys.Analysis',]),

            new Student(3, [
                'id' => 3,
                'name' => 'IOD',
                'course' => '2',
                'speciality' => 'Sys.Analysis',]),

            new Student(4, [
                'id' => 4,
                'name' => 'OAM',
                'course' => '2',
                'speciality' => 'Sys.Analysis',]),


        ];

        return $this;
    }

    public function getStudentById($id)
    {
        foreach ($this->students as $student) {
            if ($student->id == $id) {
                return $student;
            }
        }
        return null;
    }

    public function filterStudent($id, $name)
    {
        return array_filter(
            $this->students,
            function ($value) use ($id, $name) {
                return ($value->id == $id and $value->name > $name);
            }
        );
    }

    public function addStudent($student)
    {
        $this->students[] = $student;
    }

    public function editStudent($array)
    {
        $client = $this->getStudentById($array['id']);
        if (!(empty($student))) {
            $client->name = $array['id'];
            $client->course = $array['course'];
            $client->speciality = $array['speciality'];
        }
    }
}