
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rincian_model extends CI_Model
{
    private $table = 'rincian';

    public function getByRinciSkpId($id)
    {
        return $this->db->get_where($this->table, ["rinci_skp_id" => $id])->result_array();
    }

    // public function getByUser($nip)
    // {
    //     $this->db->get_where($this->table, ['nip' => $nip])->row_array();
    // }

    // public function getAllById($id_user)
    // {
    //     $this->db->select('skp.*, user.nama');
	// 	$this->db->from('skp');
	// 	$this->db->join('user', 'user.id = skp.penilai_id');
	// 	$this->db->where('skp.pegawai_id', $id_user);

    //     return $this->db->get()->result_array();
    // }

    // public function getAllByIdPenilai($id_user)
    // {
    //     $this->db->select('skp.*, user.nama');
	// 	$this->db->from('skp');
	// 	$this->db->join('user', 'user.id = skp.pegawai_id');
	// 	$this->db->where('skp.penilai_id', $id_user);

    //     return $this->db->get()->result_array();
    // }

}