<?php

function defaultDataAuction()
{
    return [
        [
            "id" => 1,
            "name" => "Glasses",
            "startl" => "12.10.2022",
            "endl" => "15.10.2022",
            "fprice" => 6000,
            "lprice" => 9000,

        ],
        [
            "id" => 2,
            "name" => "Iphone",
            "startl" => "16.10.2022",
            "endl" => "22.10.2022",
            "fprice" => 10000,
            "lprice" => 15000,
        ],
        [
            "id" => 3,
            "name" => "Ipad",
            "startl" => "18.10.2022",
            "endl" => "25.10.2022",
            "fprice" => 11000,
            "lprice" => 16000,
        ],
        [
            "id" => 4,
            "name" => "IMac",
            "startl" => "23.10.2022",
            "endl" => "29.10.2022",
            "fprice" => 8000,
            "lprice" => 14400,
        ],

    ];
}

function CreateNewLot($array, $id)
{
    return [
        'id' => $id,
        'name' => $array['name'],
        'startl' => $array['startl'],
        'endl' => $array['endl'],
        'fprice' => $array['fprice'],
        'lprice' => $array['lprice'],
    ];
}

function validationDataAuction($array)
{
    return !(
        empty($array['name']) ||
        empty($array['startl']) ||
        empty($array['endl']) ||
        empty($array['fprice']) ||
        empty($array['lprice']) ||
        $array['fprice'] < 0 ||
        !isset($array)
    );
}

function sortBySmth($arr, $fprice, $startl)
{
    return array_filter(
        $arr,
        function ($value) use ($fprice, $startl) {
            return ($value["fprice"] == $fprice and $value["startl"] > $startl);
        }
    );
}

function DisplayTableAuction($array, $caption)
{
    $table = '<table>';
    $table .= "<caption> $caption </caption>";
    $table .= '<tr> <th>id</th> <th>name</th> <th>startl</th> <th>endl</th> <th>fprice</th> <th>lprice</th> </tr>';

    foreach ($array as $item) {
        $table .= "<tr>" .
            "<td>$item[id]</td><td>$item[name]</td><td>$item[startl]</td>" .
            "<td>$item[endl]</td><td>$item[fprice]</td><td>$item[lprice]</td>" .
            "</tr>";
    }

    $table .= '</table>';
    echo $table;
}

if (!isset($_SESSION)) {
    session_start();
}

// setting default values
if (empty($_SESSION)) {
    $_SESSION['Auction'] = defaultDataAuction();
}

$actionToDo = $_POST['action'];

// adding client
if ($actionToDo == 'add') {
    if (validationDataAuction($_POST)) {
        $nextLotIdE = count($_SESSION['Auction']) + 1;
        $_SESSION['Auction'][] = CreateNewLot($_POST, $nextLotIdE);
    }
} // editing client
elseif ($actionToDo == 'edit') {
    if (validationDataAuction($_POST)) {
        $idToEdit = $_POST['id'];
        foreach ($_SESSION['Auction'] as $key => $value) {
            if ($value['id'] == $idToEdit) {
                $_SESSION['Auction'][$key] = CreateNewLot($_POST, $idToEdit);
                break;
            }
        }
    }
} // filtering Auction
elseif ($actionToDo == 'filter') {
    DisplayTableAuction(
        sortBySmth($_SESSION['Auction'], $_POST['startl'], $_POST['fprice']),
        'Specified Auction'
    );
} // saving data to Auction.txt
elseif ($actionToDo == 'save') {
    $file = fopen("Auction.txt", "w");
    fwrite($file, serialize($_SESSION['Auction']));
    fclose($file);
} // loading data from Auction.txt
elseif ($actionToDo == 'load') {
    $_SESSION['Auction'] = unserialize(file_get_contents("Auction.txt"));
}

// display all Auction
DisplayTableAuction($_SESSION['Auction'], 'Auction');

unset($_POST);
?>
<br>

<button onclick="ShowAddForm()"> ADD</button>
<button onclick="ShowEditForm()"> EDIT</button>
<button onclick="ShowFilterForm()"> FILTER</button>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='addForm'>
    ADD <br>
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> startl:
        <input type='text' name='startl'>
    </label><br>
    <label> endl:
        <input type='text' name='endl'>
    </label><br>
    <label> fprice:
        <input type='number' name='fprice'>
    </label><br>
    <label> lprice:
        <input type='number' name='lprice'>
    </label><br>
    <input type='hidden' name='action' value='add'>
    <input type='submit' value='add'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='editForm'>
    EDIT <br>
    <label> id:
        <input type='number' name='id'>
    </label><br>
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> startl:
        <input type='text' name='startl'>
    </label><br>
    <label> startl:
        <input type='text' name='startl'>
    </label><br>
    <label> fprice:
        <input type='number' name='fprice'>
    </label><br>
    <label> lprice:
        <input type='number' name='lprice'>
    </label><br>
    <input type='hidden' name='action' value='edit'>
    <input type='submit' value='edit'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='filterForm'>
    Filter <br>
    <label> startl:
        <input type='text' name='startl'>
    </label><br>
    <label> fprice:
        <input type='number' name='fprice'>
    </label><br>
    <input type='hidden' name='action' value='filter'>
    <input type='submit' value='filter'>
</form>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='save'>
    <input type='hidden' name='action' value='save'>
    <input type='submit' value='Save to file'>
</form>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='load'>
    <input type='hidden' name='action' value='load'>
    <input type='submit' value='Upload from file'>
</form>

<style>
    #addForm {
        display: none;
    }

    #editForm {
        display: none;
    }

    #filterForm {
        display: none;
    }

    table, th, td {
        border: 5px solid;
        text-align: center;
    }

    th {
        width: 100px;
    }

    td {
        height: 50px;
    }
</style>

<script>
    function ShowAddForm() {
        document.querySelector('#addForm').style.display = 'inline';
    }

    function ShowEditForm() {
        document.querySelector('#editForm').style.display = 'inline';
    }

    function ShowFilterForm() {
        document.querySelector('#filterForm').style.display = 'inline';
    }
</script>
