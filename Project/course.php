<?php

include_once("models/DB.php");
include_once("controllers/CourseController.php");

$course = new CourseController();

if (isset($_POST['add'])) {
    $course->add($_POST);
} elseif (isset($_POST['edit'])) {
    $course->update($_POST['id'], $_POST);
} elseif (!empty($_GET['id_hapus'])) {
    $course->delete($_GET['id_hapus']);
} elseif (!empty($_GET['id_edit'])) {
    $course->edit($_GET['id_edit']);
} else {
    $course->index();
}
?>
