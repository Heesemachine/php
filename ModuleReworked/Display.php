<?php
//
//include "hyperlink.php";
//
//class Display
//
//
//{
//
//
//    public function displayStudent($array)
//    {
//        $table = '<table>';
//        $table .= "<caption> Student </caption>";
//        $table .= '<tr> <th>id</th> <th>name</th> <th>course</th> <th>speciality</th>  </tr>';
//
//        foreach ($array as $item) {
//            $table .= "<tr>" .
//                "<td>$item[id]</td> <td><a href='hyperlink.php?id=$item->id; $item->name;$item->course;$item->speciality'>$item[name]</a></td> " .
//                "<td>$item[course]</td><td>$item[speciality]</td>" .
//                "</tr>";
//        }
//
//        $table .= '</table>';
//        echo $table;
//    }
//}


class Display
{
    public static function displayStudent($array)
    {
        $table = '<table>';
        $table .= "<caption> Student </caption>";
        $table .= '<tr> <th>id</th> <th>name</th> <th>course</th> <th>speciality</th> </tr>';

        foreach ($array as $item) {
            $table .= "<tr><td> <a href='hyperlink.php?id=$item->id; $item->name;$item->course;$item->speciality'</a> " . $item->id . " </td><td>" . $item->name . "</td><td>" . $item->course . "</td><td>" . $item->speciality . "</td></tr>";
        }

        $table .= '</table>';

        return $table;
    }
}