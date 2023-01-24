<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_pengajuan extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		is_logged_in();
        $this->load->model("Skp_model"); 
        $this->load->model("User_model"); 
    }

	public function index()
	{
		$nip = $this->session->userdata('nip');
		$data['title'] = "Pengajuan SKP";
        $data['user'] = $this->User_model->getByNip($nip);
		$data['user2'] =  $this->User_model->getAll();

		$this->load->view('template/topbar_', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('user/v_pengajuanskp_', $data);
		// $this->load->view('staf/coba2', $data);
	}
	
	public function get_skp(){
		$id = $this->input->post('id',TRUE);
        $data = $this->User_model->getById($id);
		echo json_encode($data);
	}

	public function ajukan_skp()
	{
		 
		$pegawai_id	= $this->session->userdata('id'); 
		$penilai_id	= $this->input->post('penilai_id', true);
		$atasan_id	= $this->input->post('atasan_id', true);		

		$data = [
			'pegawai_id' => $pegawai_id,
			'penilai_id' => $penilai_id,
			'atasan_id' => $atasan_id
			];

		$this->db->insert('skp', $data);
		$id_baru = $this->db->insert_id();
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Create SKP berhasil. Silahkan Lengkapi data SKP!</div>');
			redirect('User_pengajuan/rincian_skp/'. $id_baru);
		
	}

	public function rincian_skp($id_skp)
	{
		$data['skp'] = $this->Skp_model->getById($id_skp);

		$data['penilai'] = $this->User_model->getById($data['skp']['penilai_id']);
		$data['pegawai'] = $this->User_model->getById($data['skp']['pegawai_id']);
		$data['atasan'] = $this->User_model->getById($data['skp']['atasan_id']);

		$data2['title'] = "Isi Rincian Tugas";

		$this->load->view('template/topbar_', $data2);
		$this->load->view('template/sidebar', $data2);
		$this->load->view('user/v_skpproses1_', $data);
			
	}

	// var $rata_jumlah = 0 ;
	public function simpan_skp()
	{
		$input = $this->input->post();
		$id_skp = $input['rinci_skp_id'];

		$jml = count($input['rinci_kegiatan']);
		$rata_jumlah = 0;

		for ($i=0; $i < $jml ; $i++) { 
			$kuantitas[$i] =  ($input['rinci_realisasi'][$i] / $input['rinci_target'][$i]) * 100;
			$kualitas[$i] =  ($input['rinci_mutu'][$i] / 100) * 100;
			$waktu[$i] = 76;
			$jumlah[$i] = $kuantitas[$i] + $kualitas[$i] + $waktu[$i];
			$rinci_jumlah[$i] =  ($kuantitas[$i] + $kualitas[$i] + $waktu[$i])/3;
			$rata_jumlah = $rata_jumlah + $rinci_jumlah[$i];

			$data = [
				'rinci_skp_id' => $input['rinci_skp_id'],
				'rinci_kegiatan' => $input['rinci_kegiatan'][$i],
				'rinci_target' => $input['rinci_target'][$i],
				'rinci_realisasi' => $input['rinci_realisasi'][$i],
				'rinci_satuan' => $input['rinci_satuan'][$i],
				'rinci_mutu' => $input['rinci_mutu'][$i],
				'rinci_jumlah' => $rinci_jumlah[$i],
			];
			$this->db->insert('rincian', $data);
		}
		$rata_jumlah = $rata_jumlah / $jml;
		$this->db->where('id', $id_skp);
		$this->db->update('skp', ['nilai_total' => $rata_jumlah]);

		// $data['skp'] = $this->Skp_model->getById($id_skp);
		// $data['penilai'] = $this->User_model->getById($data['skp']['penilai_id']);
		// $data['pegawai'] = $this->User_model->getById($data['skp']['pegawai_id']);

		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">SKP berhasil diajukan </div>');
			redirect('User_riwayat');
	}

	public function edit_skp($id_skp)
	{
		$data['skp'] = $this->Skp_model->getById($id_skp);

		$data['penilai'] = $this->User_model->getById($data['skp']['penilai_id']);
		$data['pegawai'] = $this->User_model->getById($data['skp']['pegawai_id']);

		$data2['title'] = "Edit Rincian Tugas";

		$this->db->where('rinci_skp_id', $id_skp);
		$data['rincian'] = $this->db->get('rincian')->result_array(); 

		$this->load->view('template/topbar_', $data2);
		$this->load->view('template/sidebar', $data2);
		$this->load->view('user/v_skpproses2_', $data);
			
	}

	public function update_skp()
	{
		$input = $this->input->post();

		$this->db->where('rinci_skp_id', $input['rinci_skp_id']);
		$this->db->delete('rincian');

		$jml = count($input['rinci_kegiatan']);
		$rata_jumlah = 0;

		for ($i=0; $i < $jml ; $i++) {

			$kuantitas[$i] =  ($input['rinci_realisasi'][$i] / $input['rinci_target'][$i]) * 100;
			$kualitas[$i] =  ($input['rinci_mutu'][$i] / 100) * 100;
			$waktu[$i] = 76;
			$rinci_jumlah[$i] =  ($kuantitas[$i] + $kualitas[$i] + $waktu[$i])/3;
			$rata_jumlah = $rata_jumlah + $rinci_jumlah[$i];

			$data = [
				'rinci_skp_id' => $input['rinci_skp_id'],
				'rinci_kegiatan' => $input['rinci_kegiatan'][$i],
				'rinci_target' => $input['rinci_target'][$i],
				'rinci_realisasi' => $input['rinci_realisasi'][$i],
				'rinci_satuan' => $input['rinci_satuan'][$i],
				'rinci_mutu' => $input['rinci_mutu'][$i],
				'rinci_jumlah' => $rinci_jumlah[$i],
			];
			$this->db->insert('rincian', $data);
		}

		$rata_jumlah = $rata_jumlah / $jml;
		$data = [ 
			'status_skp' => 0,
			'nilai_total' => $rata_jumlah
		];

		$this->db->select_avg('age');
		$this->db->where('id', $input['rinci_skp_id']);
		$this->db->update('skp', $data);

		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">SKP berhasil direvisi! </div>');
			redirect('User_riwayat');

	}
	public function hapus_skp($id)
	{
		// $input =$this->uri->segment(3);

		$this->db->where('id', $id);
		$this->db->delete('skp');
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">SKP berhasil dihapus! </div>');
			redirect('User_riwayat');

	}
}
