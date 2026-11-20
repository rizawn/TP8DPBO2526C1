<?php

include_once("config.php");
include_once("models/Department.php");
include_once("views/DepartmentView.php");

class DepartmentController
{
    private $department;

    public function __construct()
    {
        $this->department = new Department(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index()
    {
        $this->department->open();
        $this->department->getDepartment();

        $data = array(
            'department' => array()
        );

        while ($row = $this->department->getResult()) {
            array_push($data['department'], $row);
        }

        $this->department->close();

        $view = new DepartmentView();
        $view->render($data);
    }

    public function add($data)
    {
        $this->department->open();
        $this->department->add($data);
        $this->department->close();

        header("location:department.php");
        exit;
    }

    public function edit($id)
    {
        $this->department->open();
        $this->department->getDepartment();

        $data = array(
            'department' => array()
        );

        while ($row = $this->department->getResult()) {
            array_push($data['department'], $row);
        }

        $this->department->getDepartmentById($id);
        $dataDetail = $this->department->getResult();

        $this->department->close();

        $view = new DepartmentView();
        $view->render($data, $dataDetail);
    }

    public function update($id, $data)
    {
        $this->department->open();
        $this->department->update($id, $data);
        $this->department->close();

        header("location:department.php");
        exit;
    }

    public function delete($id)
    {
        $this->department->open();
        $this->department->delete($id);
        $this->department->close();

        header("location:department.php");
        exit;
    }
}
?>
