<?php

include 'DBConnect.php';

function myAutoloader($class_name)
{
    if (!class_exists($class_name)) {
        include $class_name . '.php';
    }
}

spl_autoload_register('myAutoloader');

$studentsRepository = new Repository($dbh);

if (!isset($_SESSION)) {
    session_start();
}

//if (empty($_SESSION['Student'])) {
//    $_SESSION['Student'] = new StudentCollection();
//    $_SESSION['Student']->defaultStudents();
//}

$actionToDo = $_POST['action'];

if ($actionToDo == 'add') {
    if (Student::validationDataStudents($_POST)) {
        $_SESSION['Student']->addStudent(
            new Student(5, $_POST)
        );
    }
} elseif ($actionToDo == 'edit') {
    if (Student::validationDataStudents($_POST)) {
        $_SESSION['Student']->editStudent(
            $_POST
        );
    }
} elseif ($actionToDo == 'filter') {
    echo $_SESSION['Student']->filterStudent($_POST['id'], $_POST['name']);
} elseif ($actionToDo == 'save') {
    $_SESSION['Student']->saveStudent();
} elseif ($actionToDo == 'load') {
    $_SESSION['Auction']->loadStudent();
}

echo (new Display)->displayStudent($_SESSION['Student']->students)
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
    <label> course:
        <input type='number' name='course'>
    </label><br>
    <label> speciality:
        <input type='text' name='speciality'>
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
    <label> course:
        <input type='number' name='course'>
    </label><br>
    <label> speciality:
        <input type='text' name='speciality'>
    </label><br>
    <input type='hidden' name='action' value='edit'>
    <input type='submit' value='edit'>
</form>

<br>

<form action='<?= $_SERVER['PHP_SELF'] ?>' method='post' id='filterForm'>
    Filter <br>
    <label> id:
        <input type='number' name='id'>
    </label><br>
    <label> name:
        <input type='text' name='name'>
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
        border: 1px solid;
        text-align: center;
        background-color: darkorange;
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
