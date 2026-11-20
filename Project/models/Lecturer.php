<?php

include_once("DB.php");

class Lecturer extends DB
{
    public function getLecturer()
    {
        $query = "SELECT l.*, d.name AS department_name, d.code AS department_code 
                  FROM lecturers l 
                  LEFT JOIN departments d ON l.department_id = d.id 
                  ORDER BY l.id ASC";
        return $this->execute($query);
    }

    public function getLecturerById($id)
    {
        $id = (int)$id;
        $query = "SELECT * FROM lecturers WHERE id = $id";
        return $this->execute($query);
    }

    public function add($data)
    {
        $name = mysqli_real_escape_string($this->db_link, trim($data['name']));
        $nidn = mysqli_real_escape_string($this->db_link, trim($data['nidn']));
        $phone = mysqli_real_escape_string($this->db_link, trim($data['phone']));
        $join_date = mysqli_real_escape_string($this->db_link, trim($data['join_date']));
        $department_id = !empty($data['department_id']) ? (int)$data['department_id'] : "NULL";

        $query = "INSERT INTO lecturers (name, nidn, phone, join_date, department_id) 
                  VALUES ('$name', '$nidn', '$phone', '$join_date', $department_id)";
        return $this->execute($query);
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $name = mysqli_real_escape_string($this->db_link, trim($data['name']));
        $nidn = mysqli_real_escape_string($this->db_link, trim($data['nidn']));
        $phone = mysqli_real_escape_string($this->db_link, trim($data['phone']));
        $join_date = mysqli_real_escape_string($this->db_link, trim($data['join_date']));
        $department_id = !empty($data['department_id']) ? (int)$data['department_id'] : "NULL";

        $query = "UPDATE lecturers 
                  SET name = '$name', nidn = '$nidn', phone = '$phone', join_date = '$join_date', department_id = $department_id 
                  WHERE id = $id";
        return $this->execute($query);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $query = "DELETE FROM lecturers WHERE id = $id";
        return $this->execute($query);
    }
}
?>
