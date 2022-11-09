<?php
$id = "none";
$name = "no name";
$course = "no info";
$speciality = "no info";


if(isset($_GET["id"])){

    $id = $_GET["id"];
}
if(isset($_GET["name"])){

    $name = $_GET["name"];
}
if(isset($_GET["course"])){

    $teacher = $_GET["course"];
}
if(isset($_GET["speciality"])){

    $mark = $_GET["speciality"];
}

echo "Full information: $id <br>";
?>

<style>

</style>
