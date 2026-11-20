<?php

class DB
{
    public $db_host = "";
    public $db_user = "";
    public $db_pass = "";
    public $db_name = "";
    public $db_link = null;
    public $result = null;

    public function __construct($db_host, $db_user, $db_pass, $db_name)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    public function open()
    {
        $this->db_link = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if (!$this->db_link) {
            die("Koneksi basis data gagal: " . mysqli_connect_error());
        }
    }

    public function execute($query)
    {
        $this->result = mysqli_query($this->db_link, $query);
        return $this->result;
    }

    public function getResult()
    {
        return mysqli_fetch_array($this->result);
    }

    public function close()
    {
        if ($this->db_link) {
            mysqli_close($this->db_link);
        }
    }
}
?>
