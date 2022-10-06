<?php
//Об’єкт “Аукціон” (Код, назва лота, дата початку торгів, дата завершення торгів,
//стартова ціна, кінцева ціна). Запит торгів за вказану дату із початковою ціною що не перевищує Х.
session_start();
$_SESSION["accounting"] = null;
if (isset($_SESSION["accounting"])){
    $accounting = $_SESSION["accounting"];
}else{
    $accounting = [
        [
            "code" => 1,
            "name" => "Glasses",
            "startl" => "12.10.2022",
            "endl" => "15.10.2022",
            "fprice" => 6000,
            "lprice" => 9000,

        ],
        [
            "code" => 2,
            "name" => "Iphone",
            "startl" => "16.10.2022",
            "endl" => "22.10.2022",
            "fprice" => 10000,
            "lprice" => 15000,
        ],
    ];
}
function getId($accounting){
    for($i = 0; $i < count($accounting); $i++){
        if($_GET["id"] == $accounting[$i]["code"]){
            $max = $accounting[0]["code"];
            for($j = 0; $j < count($accounting); $j++){
                if($accounting[$j]["code"] > $max){
                    $max = $accounting[$j]["code"];
                }
            }
            $max++;
            return $max;
        }
    }
    return $_GET["code"];
}
if($_GET["edit"] != null){
    for($i = 0; $i < count($accounting); $i++){
        if($_GET["edit"] == $accounting[$i]["code"]){
            $accounting[$i] = ["code" => getId($accounting),
                "name" => $_GET["name"],
                "startl" => $_GET["startl"],
                "endl" => $_GET["endl"],
                "fprice" => $_GET["fprice"],
                'lprice' => $_GET['lprice']];
            $_SESSION["accounting"] = $accounting;
            break;
        }
    }

}
else{
    if($_GET["code"] == null){
        $_GET["code"] = 1;
    }
    if($_GET["name"] == null){
        $_GET["name"] = "None name";
    }
    if($_GET["startl"] == null){
        $_GET["startl"] = "No date";
    }
    if($_GET["endl"] == null){
        $_GET["endl"] = "No date";
    }
    if($_GET["fprice"] == null){
        $_GET["fprice"] = "0";
    }
    if($_GET["lprice"] == null){
        $_GET["lprice"] = "0";
    }

    $accounting[] = ["code" => getId($accounting),
        "name" => $_GET["name"],
        "startl" => $_GET["startl"],
        "endl" => $_GET["endl"],
        "fprice" => $_GET["fprice"],
        "lprice" => $_GET["lprice"]];
    $_SESSION["factory"] = $accounting;
}
function sortBySmth($arr, $fprice,$startl){
    $newArr = [];
    for($i = 0; $i < count($arr); $i++){
        if($startl == $arr[$i]["startl"] && $arr[$i]["fprice"] < $fprice){
            array_push($newArr, $arr[$i]);

        }
    }
    return $newArr;
}

echo "<h2>Таблиця всіх значень</h2>";
echo "<table>";
echo "<tr> <th>Code</th> <th>Name</th> <th>StartLot</th> <th>Endlot</th> <th>FirstPrice</th> <th>Lastprice</th> </tr>";
for($i = 0; $i < count($accounting); $i++){
    echo "<tr>";
    foreach ($accounting[$i] as $key=>$value){
        if($value != null){
            echo "<td>$value</td>";
        }

    }

    echo "</tr>";
}
echo "</table>";

$arr = sortBySmth($accounting,15000,"16.10.2022");
echo "<h2>Таблиця запиту</h2>";
echo "<table>";
echo "<tr> <th>Code</th> <th>Name</th> <th>StartLot</th> <th>Endlot</th> <th>FirstPrice</th> <th>Lastprice</th> </tr>";
for ($i = 0; $i < count($arr); $i++) {
    echo "<tr>";
    foreach ($arr[$i] as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";


?>
<style>
    table{
        background: rgb(131,58,180);
        background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);
        border: 5px solid palevioletred;
        border-radius: 10%;
    }
    th,tr,td{
        border: 5px solid palevioletred;
        border-radius: 10%;
    }
</style>

<form method="get" action="">
    <p>Form</p>
    <label>
        <input type="number" name="edit" placeholder="Напишіть ід лота."> <br>
        <input type="number"  name="code" placeholder="Код"> <br>
        <input type="text"  name="name" placeholder="Імя лота"> <br>
        <input type="text" name="startl" placeholder="Початкова дата"> <br>
        <input type="number" name="endl"  placeholder="Кінцева Ціна"> <br>
        <input type="number" name="fprice" placeholder="Початкова ціна"><br>
        <input type="text" name="lprice" placeholder="Кінцева ціна"><br>
        <input type="submit" name="btn-ok" value="ok">


        <input type="hidden" name="z-startl" value="">
        <input type="hidden" name="z-fprice" value="">
    </label>
</form>