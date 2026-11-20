<?php

include_once("DB.php");

class Department extends DB
{
    public function getDepartment()
    {
        $query = "SELECT d.*, 
                         (SELECT COUNT(*) FROM lecturers WHERE department_id = d.id) AS total_lecturers,
                         (SELECT COUNT(*) FROM courses WHERE department_id = d.id) AS total_courses 
                  FROM departments d 
                  ORDER BY d.id ASC";
        return $this->execute($query);
    }

    public function getDepartmentById($id)
    {
        $id = (int)$id;
        $query = "SELECT * FROM departments WHERE id = $id";
        return $this->execute($query);
    }

    public function add($data)
    {
        $code = mysqli_real_escape_string($this->db_link, trim($data['code']));
        $name = mysqli_real_escape_string($this->db_link, trim($data['name']));
        $faculty = mysqli_real_escape_string($this->db_link, trim($data['faculty']));

        $query = "INSERT INTO departments (code, name, faculty) VALUES ('$code', '$name', '$faculty')";
        return $this->execute($query);
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $code = mysqli_real_escape_string($this->db_link, trim($data['code']));
        $name = mysqli_real_escape_string($this->db_link, trim($data['name']));
        $faculty = mysqli_real_escape_string($this->db_link, trim($data['faculty']));

        $query = "UPDATE departments SET code = '$code', name = '$name', faculty = '$faculty' WHERE id = $id";
        return $this->execute($query);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $query = "DELETE FROM departments WHERE id = $id";
        return $this->execute($query);
    }
}
?>
