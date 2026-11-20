<?php

include_once("config.php");
include_once("models/Course.php");
include_once("models/Lecturer.php");
include_once("models/Department.php");
include_once("views/CourseView.php");

class CourseController
{
    private $course;
    private $lecturer;
    private $department;

    public function __construct()
    {
        $this->course = new Course(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        $this->lecturer = new Lecturer(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        $this->department = new Department(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index()
    {
        $this->course->open();
        $this->lecturer->open();
        $this->department->open();

        $this->course->getCourse();
        $this->lecturer->getLecturer();
        $this->department->getDepartment();

        $data = array(
            'course' => array(),
            'lecturer' => array(),
            'department' => array()
        );

        while ($row = $this->course->getResult()) {
            array_push($data['course'], $row);
        }
        while ($row = $this->lecturer->getResult()) {
            array_push($data['lecturer'], $row);
        }
        while ($row = $this->department->getResult()) {
            array_push($data['department'], $row);
        }

        $this->course->close();
        $this->lecturer->close();
        $this->department->close();

        $view = new CourseView();
        $view->render($data);
    }

    public function add($data)
    {
        $this->course->open();
        $this->course->add($data);
        $this->course->close();

        header("location:course.php");
        exit;
    }

    public function edit($id)
    {
        $this->course->open();
        $this->lecturer->open();
        $this->department->open();

        $this->course->getCourse();
        $this->lecturer->getLecturer();
        $this->department->getDepartment();

        $data = array(
            'course' => array(),
            'lecturer' => array(),
            'department' => array()
        );

        while ($row = $this->course->getResult()) {
            array_push($data['course'], $row);
        }
        while ($row = $this->lecturer->getResult()) {
            array_push($data['lecturer'], $row);
        }
        while ($row = $this->department->getResult()) {
            array_push($data['department'], $row);
        }

        $this->course->getCourseById($id);
        $dataDetail = $this->course->getResult();

        $this->course->close();
        $this->lecturer->close();
        $this->department->close();

        $view = new CourseView();
        $view->render($data, $dataDetail);
    }

    public function update($id, $data)
    {
        $this->course->open();
        $this->course->update($id, $data);
        $this->course->close();

        header("location:course.php");
        exit;
    }

    public function delete($id)
    {
        $this->course->open();
        $this->course->delete($id);
        $this->course->close();

        header("location:course.php");
        exit;
    }
}
?>
