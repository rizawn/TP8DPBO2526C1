<?php

include_once("DB.php");

class Course extends DB
{
    public function getCourse()
    {
        $query = "SELECT c.*, l.name AS lecturer_name, d.name AS department_name 
                  FROM courses c 
                  LEFT JOIN lecturers l ON c.lecturer_id = l.id 
                  LEFT JOIN departments d ON c.department_id = d.id 
                  ORDER BY c.id ASC";
        return $this->execute($query);
    }

    public function getCourseById($id)
    {
        $id = (int)$id;
        $query = "SELECT * FROM courses WHERE id = $id";
        return $this->execute($query);
    }

    public function add($data)
    {
        $code = mysqli_real_escape_string($this->db_link, trim($data['code']));
        $name = mysqli_real_escape_string($this->db_link, trim($data['name']));
        $sks = (int)$data['sks'];
        $semester = (int)$data['semester'];
        $lecturer_id = !empty($data['lecturer_id']) ? (int)$data['lecturer_id'] : "NULL";
        $department_id = !empty($data['department_id']) ? (int)$data['department_id'] : "NULL";

        $query = "INSERT INTO courses (code, name, sks, semester, lecturer_id, department_id) 
                  VALUES ('$code', '$name', $sks, $semester, $lecturer_id, $department_id)";
        return $this->execute($query);
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $code = mysqli_real_escape_string($this->db_link, trim($data['code']));
        $name = mysqli_real_escape_string($this->db_link, trim($data['name']));
        $sks = (int)$data['sks'];
        $semester = (int)$data['semester'];
        $lecturer_id = !empty($data['lecturer_id']) ? (int)$data['lecturer_id'] : "NULL";
        $department_id = !empty($data['department_id']) ? (int)$data['department_id'] : "NULL";

        $query = "UPDATE courses 
                  SET code = '$code', name = '$name', sks = $sks, semester = $semester, lecturer_id = $lecturer_id, department_id = $department_id 
                  WHERE id = $id";
        return $this->execute($query);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $query = "DELETE FROM courses WHERE id = $id";
        return $this->execute($query);
    }
}
?>
