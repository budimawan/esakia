<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_periksa extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		is_logged_in();
        $this->load->model("Skp_model"); 
        $this->load->model("User_model"); 
    }

	public function index()
	{
		$id = $this->session->userdata('id');
		// $skp = $user = $this->db->get_where('pengajuan_a', ['id' => $id])->row_array();
		$data2['title'] = "Periksa SKP";
        $data['skp'] = $this->Skp_model->getAllByIdPenilai($id);
		$data['user'] = $this->User_model->getById($id);
		
		$this->load->view('template/topbar_', $data2);
		$this->load->view('template/sidebar');
		$this->load->view('user/v_periksaskp_', $data);
		$this->load->view('template/footer_', $data);
	}

	public function lihat_skp($id_skp)
	{		
		$data['skp'] = $this->Skp_model->getById($id_skp);

		$data['penilai'] = $this->User_model->getById($data['skp']['penilai_id']);
		$data['pegawai'] = $this->User_model->getById($data['skp']['pegawai_id']);
		$data['atasan'] = $this->User_model->getById($data['skp']['atasan_id']);

		$data2['title'] = "Lihat SKP";

		$this->db->where('rinci_skp_id', $id_skp);
		$data['rincian'] = $this->db->get('rincian')->result_array(); 

		$this->load->view('template/topbar_', $data2);
		$this->load->view('template/sidebar', $data2);
		$this->load->view('user/v_lihatskp_', $data);
	}

	public function periksa_skp($id_skp)
	{		
		$data['skp'] = $this->Skp_model->getById($id_skp);

		$data['penilai'] = $this->User_model->getById($data['skp']['penilai_id']);
		$data['pegawai'] = $this->User_model->getById($data['skp']['pegawai_id']);
        // $data['skp'] = $this->Skp_model->getAllByIdPenilai($id);

		$data2['title'] = "Periksa SKP";

		$this->db->where('rinci_skp_id', $id_skp);
		$data['rincian'] = $this->db->get('rincian')->result_array();

		// $this->db->where('id', $id_skp);
		// $data['nilai'] =  $this->db->get('skp')->row_array();
		// var_dump ($data['skp']); die();

		$this->load->view('template/topbar_',$data2);
		$this->load->view('template/sidebar', $data2);
		$this->load->view('user/v_skpproses3_', $data);
	}
	
	public function simpan_koreksi_skp()
	{
		$input = $this->input->post();
		$jml = count($input['rinci_id']);

		for ($i=0; $i < $jml ; $i++) { 
			$data = [
				'rinci_koreksi' => $input['rinci_koreksi'][$i],
			];
			$this->db->where('rinci_id', $input['rinci_id'][$i]);
			$this->db->update('rincian', $data);
		}
		// echo $input['pegawai_id']; die();

		if($input['radio1'] == "valid"){
			$status=1;

			$nilai_total_prilaku = ($input['orientasi'] + $input['orientasi'] + $input['komitmen'] + $input['disiplin'] + $input['kerjasama'] + $input['kepemimpinan'])/6;
			$nilai_total = ($nilai_total_prilaku*0.4) + ($input['nilai_total']*0.6);
			
			$data_user =[
				'nilai_kinerja' => $input['nilai_total'],
				'nilai_prilaku' => $nilai_total_prilaku,
				'nilai_prestasi' => $nilai_total
			];
			// var_dump($data_user); die();
			$this->db->where('id', $input['pegawai_id']);
			$this->db->update('user', $data_user);

			$data_skp = [
				'orientasi' => $input['orientasi'],
				'integritas' => $input['orientasi'],
				'komitmen' => $input['komitmen'],
				'disiplin' => $input['disiplin'],
				'kerjasama' => $input['kerjasama'],
				'kepemimpinan' => $input['kepemimpinan'],
				'status_skp' => $status,
				'nilai_total' => $nilai_total,
				];
				
			$this->db->where('id', $input['skp_id']);
			$this->db->update('skp', $data_skp);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">SKP berhasil diperiksa! </div>');
				redirect('User_periksa');
		}else{
			$status=2;

			$nilai_total_prilaku = ($input['orientasi'] + $input['orientasi'] + $input['komitmen'] + $input['disiplin'] + $input['kerjasama'] + $input['kepemimpinan'])/6;
			$nilai_total = ($nilai_total_prilaku*0.4) + ($input['nilai_total']*0.6);
			
			$data_skp = [
				'orientasi' => $input['orientasi'],
				'integritas' => $input['orientasi'],
				'komitmen' => $input['komitmen'],
				'disiplin' => $input['disiplin'],
				'kerjasama' => $input['kerjasama'],
				'kepemimpinan' => $input['kepemimpinan'],
				'status_skp' => $status,
				'nilai_total' => $nilai_total,
				];
				
			$this->db->where('id', $input['skp_id']);
			$this->db->update('skp', $data_skp);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">SKP berhasil diperiksa! </div>');
				redirect('User_periksa');
		}
		
		
	}
}
