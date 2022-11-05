<?php

class Display


{
    public function displayStudent($array)
    {
        $table = '<table>';
        $table .= "<caption> Student </caption>";
        $table .= '<tr> <th>id</th> <th>name</th> <th>course</th> <th>speciality</th>';

        foreach ($array as $item) {
            $table .=
                "<tr><td>" . $item['id'] .
                "</td><td>" .$item['name'] .
                "</td><td>" . $item['course'] .
                "</td><td>" . $item['speciality'] .
                "</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }
}