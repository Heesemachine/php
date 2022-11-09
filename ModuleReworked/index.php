<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['Student'])) {
    $_SESSION['Student'] = new StudentCollection();
    $_SESSION['Student']->defaultStudents();
}

$actionToDo = $_POST['action'];

if ($actionToDo == 'add') {
    if (Student::validationDataStudent($_POST)) {
        $_SESSION['Student']->addStudent(
            new Student(5, $_POST)
        );
    }
} elseif ($actionToDo == 'edit') {
    if (Student::validationDataStudent($_POST)) {
        $_SESSION['Student']->editStudent(
            $_POST
        );
    }
} elseif ($actionToDo == 'filter') {
    echo (new Display)->displayStudent($_SESSION['Student']->filterStudent($_POST['id'], $_POST['name']));
}

echo (new Display)->displayStudent($_SESSION['Student']->students);
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
    <label> name:
        <input type='text' name='name'>
    </label><br>
    <label> id:
        <input type='number' name='id'>
    </label><br>
    <input type='hidden' name='action' value='filter'>
    <input type='submit' value='filter'>
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