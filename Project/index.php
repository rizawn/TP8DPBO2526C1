<?php

include_once("models/DB.php");
include_once("controllers/LecturerController.php");

$lecturer = new LecturerController();

if (isset($_POST['add'])) {
    $lecturer->add($_POST);
} elseif (isset($_POST['edit'])) {
    $lecturer->update($_POST['id'], $_POST);
} elseif (!empty($_GET['id_hapus'])) {
    $lecturer->delete($_GET['id_hapus']);
} elseif (!empty($_GET['id_edit'])) {
    $lecturer->edit($_GET['id_edit']);
} else {
    $lecturer->index();
}
?>
