<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_dashboard extends CI_Controller {

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
		$data['skp'] = $this->Skp_model->getById($id);
		$data['penilai'] = $this->User_model->getById($data['skp']['penilai_id']);
		$data['pegawai'] = $this->User_model->getById($data['skp']['pegawai_id']);

		// $this->db->like('status_skp', 0);
        //             $this->db->where('penilai_id', $id);
        //             $this->db->from('skp');
        //             echo $this->db->count_all_results(); die();
        
		// $query=mysqli_query("Select Count(*) From Kota");
		// $hasil=mysqli_fetch_array($query);

		// echo "Jumlahkota : $hasil";

		// $this->db->like('penilai_id', $id);
		// $this->db->where('status_skp', 0);
		// $this->db->from('skp');
        // $data['skp_harusdiperiksa'] =  $this->db->count_all_results();

		$data['title'] 	=	"Dashboard";
        $data['user']	= 	$this->User_model->getById($id);
		$data['user2'] 	=	$this->User_model->getAll();

		$this->load->view('template/topbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('user/v_home_', $data);
		$this->load->view('template/footer', $data);
	}

	public function ganti_pasword(){
		$id = $this->session->userdata('id');
		$user = $this->db->get_where('user', ['id' => $id])->row_array();

		$this->form_validation->set_rules('pas_lama', 'Curent Password', 'required|trim');
		$this->form_validation->set_rules('pas_baru', 'New Password', 'required|trim|min_length[4]', [
			'min_length' => 'Password Baru Minimal 4 Karakter!'
		]);
		$this->form_validation->set_rules('pas_baru2', 'Confirm New Password', 'required|trim|matches[pas_baru]', [
			'matches' => 'Warning, Reapat Password Harus Sama!!'
		]);

		// echo $user['password'];
		// 	die();

		if ($this->form_validation->run() == false){
			$this->load->view('template/topbar', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('user/v_home_', $data);
			$this->load->view('template/footer', $data);
		}
		else{
			$pas_lama = $this->input->post('pas_lama');
			$pas_baru = $this->input->post('pas_baru');
			// echo $user['password'];
			// die();
			if(!password_verify($pas_lama, $user['password'])){
				$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Password lama salah!</div>');
				redirect('User_dashboard');
			} else {
				if ($pas_lama == $pas_baru) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">Password baru tidak boleh sama dengan password lama!</div>');
					redirect('User_dashboard');
				} else {
					$this->db->set('password', password_hash($pas_baru, PASSWORD_DEFAULT));
					$this->db->where('id', $id);
					$this->db->update('user');
					$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Pasword telah diubah!</div>');
					redirect('User_dashboard');

				}
			}
		}
		
	}

	public function updatedatauser()
	{
		$id = $this->session->userdata('id');
		$data = $this->db->get_where('user', ['id' => $id])->row_array();
		// die();

		$this->form_validation->set_rules('nama', 'User Name', 'required|trim');
		$this->form_validation->set_rules('nip', 'User Full Name', 'required|trim');
		$this->form_validation->set_rules('jabatan', 'User Jabatan', 'required|trim|is_unique[user.nip]', [
			'is_unique' => 'Nomor Induk Pegawai sudah terpakai !'
		]);
		$this->form_validation->set_rules('unit_kerja', 'User Unit Kerja', 'required|trim');
		$this->form_validation->set_rules('pangkat_golongan', 'User Pangkat Golongan', 'required|trim');
		$this->form_validation->set_rules('pendidikan', 'User Pendidikan', 'required|trim');
		$this->form_validation->set_rules('alamat', 'User Alamat', 'required|trim');
		$this->form_validation->set_rules('skill', 'User Skill', 'required|trim');
		$this->form_validation->set_rules('moto', 'User Moto', 'required|trim');

		if ($this->form_validation->run() == false){
			$this->load->view('template/topbar', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('user/v_home_', $data);
			$this->load->view('template/footer', $data);
		}
		else{
			$foto_lama_db = $data['image']; 
			// echo $upload_foto_frm  = $this->input->post('img2');
			// die();
			if(!empty($_FILES['img']['name'])){
				// echo "terbaca gan!";
				// echo $img_old = $data['image'];
				//  die();
				$upload_foto 	= $_FILES['img']['name'];

				if ($upload_foto){
					$config['upload_path']		=	'./assets/dist/img';
					$config['allowed_types']	=	'gif|jpg|jpeg|png';
					$congif['file_name']		=	$id;
					$config['max_size']			=	1260;
					$config['max_width']        = 	700;
	                $config['max_height']       =  	700;
					$this->load->library('upload', $config);

					if ($this->upload->do_upload('img')){
						// echo $img_new = $this->upload->data('file_name');
						// die();

						$img_old = $data['image'];
						if ($img_old != 'user2-160x160.jpg') {
							unlink(FCPATH . '/assets/dist/img/' . $img_old);
						}
						$img_new = $this->upload->data('file_name');
						// die();
					} else {
						echo $this->upload->dispay_errors();
					}
				}
			}else {
				$img_new = $foto_lama_db;
			}

			date_default_timezone_set('Asia/Makassar');
			$tgl_update = date('Y-m-d H:i:s');			

			$data = [
				'nama' => $this->input->post('nama', true),
				'nip' => $this->input->post('nip'),
				'jabatan' => $this->input->post('jabatan', true),
				'unit_kerja' => $this->input->post('unit_kerja', true),
				'pangkat_golongan' => $this->input->post('pangkat_golongan', true),
				'pendidikan' => $this->input->post('pendidikan', true),
				'alamat' => $this->input->post('alamat', true),
				'skill' => $this->input->post('skill', true),
				'moto' => $this->input->post('moto', true),
				'tgl_update' => date('Y-m-d H:i:s'),
				'image' => $img_new
			];
			$this->db->where('id', $id);
			$this->db->update('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Berhasil Update Profil !</div>');
			redirect('User_dashboard');
		}
	}

}
