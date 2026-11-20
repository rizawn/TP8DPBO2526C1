<?php

include_once("models/DB.php");
include_once("controllers/DepartmentController.php");

$department = new DepartmentController();

if (isset($_POST['add'])) {
    $department->add($_POST);
} elseif (isset($_POST['edit'])) {
    $department->update($_POST['id'], $_POST);
} elseif (!empty($_GET['id_hapus'])) {
    $department->delete($_GET['id_hapus']);
} elseif (!empty($_GET['id_edit'])) {
    $department->edit($_GET['id_edit']);
} else {
    $department->index();
}
?>
