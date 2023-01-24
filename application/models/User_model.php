
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'user';

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id" => $id])->row_array();
    }

    public function getByNip($nip)
    {
        return $this->db->get_where($this->table, ['nip' => $nip])->row_array();
        
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }

}