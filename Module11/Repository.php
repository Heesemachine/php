<?php

class Repository
{

    public $dbh;

    public function __construct($dbh)
    {

        $this->dbh = $dbh;
    }
//    public function saveStudent($array)
//    {
//        $file = fopen("students.txt", "w");
//        fwrite($file, serialize($array));
//        fclose($file);
//    }

//    public function loadAuction()
//    {
//        $this->students = unserialize(file_get_contents("students.txt"));
//    }
    public function createStudent($array)
    {
        $this->dbh->query('INSERT INTO Student(name, course, speciality) VALUES (' .
            "'" . $array['name'] . "', " .
            "'" . $array['course'] . "', " .
            "'" . $array['speciality'] . "')"
        );
    }

    public function readStudent()
    {
        return $this->dbh->query('SELECT * FROM Student')->fetchAll();
    }

    public function updateStudent($array)
    {
        $this->dbh->query('UPDATE Student SET ' .
            'name = ' . $array['name'] . ', ' .
            'course = ' . $array['address'] . ', ' .
            'speciality = ' . $array['phone'] . ', ' .
            'WHERE id = ' . $array['id']);
    }

    public function deleteStudent($array)
    {
        return $this->dbh->query('DELETE FROM Clients WHERE id = ' . $array['id']);
    }

}