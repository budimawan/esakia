
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skp_model extends CI_Model
{
    private $table = 'skp';

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id" => $id])->row_array();
    }

    public function getByUser($nip)
    {
        return $this->db->get_where($this->table, ['nip' => $nip])->row_array();
    }
   
    public function getByPenilaiId($id)
    {
        $this->db->like('penilai_id', $id);
		$this->db->from('skp');
        return  $this->db->count_all_results(); 
    }

    public function getAllById($id_user)
    {
        $this->db->select('skp.*, user.nama');
		$this->db->from('skp');
		$this->db->join('user', 'user.id = skp.penilai_id');
		$this->db->where('skp.pegawai_id', $id_user);

        return $this->db->get()->result_array();
    }

    public function getAllByIdPenilai($id_user)
    {
        $this->db->select('skp.*, user.nama');
		$this->db->from('skp');
		$this->db->join('user', 'user.id = skp.pegawai_id');
		$this->db->where('skp.penilai_id', $id_user);

        return $this->db->get()->result_array();
    }

}