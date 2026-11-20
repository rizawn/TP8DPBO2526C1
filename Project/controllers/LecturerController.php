<?php

include_once("config.php");
include_once("models/Lecturer.php");
include_once("models/Department.php");
include_once("views/LecturerView.php");

class LecturerController
{
    private $lecturer;
    private $department;

    public function __construct()
    {
        $this->lecturer = new Lecturer(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        $this->department = new Department(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index()
    {
        $this->lecturer->open();
        $this->department->open();

        $this->lecturer->getLecturer();
        $this->department->getDepartment();

        $data = array(
            'lecturer' => array(),
            'department' => array()
        );

        while ($row = $this->lecturer->getResult()) {
            array_push($data['lecturer'], $row);
        }
        while ($row = $this->department->getResult()) {
            array_push($data['department'], $row);
        }

        $this->lecturer->close();
        $this->department->close();

        $view = new LecturerView();
        $view->render($data);
    }

    public function add($data)
    {
        $this->lecturer->open();
        $this->lecturer->add($data);
        $this->lecturer->close();

        header("location:index.php");
        exit;
    }

    public function edit($id)
    {
        $this->lecturer->open();
        $this->department->open();

        $this->lecturer->getLecturer();
        $this->department->getDepartment();

        $data = array(
            'lecturer' => array(),
            'department' => array()
        );

        while ($row = $this->lecturer->getResult()) {
            array_push($data['lecturer'], $row);
        }
        while ($row = $this->department->getResult()) {
            array_push($data['department'], $row);
        }

        $this->lecturer->getLecturerById($id);
        $dataDetail = $this->lecturer->getResult();

        $this->lecturer->close();
        $this->department->close();

        $view = new LecturerView();
        $view->render($data, $dataDetail);
    }

    public function update($id, $data)
    {
        $this->lecturer->open();
        $this->lecturer->update($id, $data);
        $this->lecturer->close();

        header("location:index.php");
        exit;
    }

    public function delete($id)
    {
        $this->lecturer->open();
        $this->lecturer->delete($id);
        $this->lecturer->close();

        header("location:index.php");
        exit;
    }
}
?>
