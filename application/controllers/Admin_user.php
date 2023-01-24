<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		is_logged_in();
        $this->load->model("Skp_model"); 
        $this->load->model("User_model"); 
    }

	public function index()
	{
		$data['title'] = "Control User";
        $nip = $this->session->userdata('nip');
        $data['user'] = $this->User_model->getByNip($nip);
		$data['user2'] =  $this->User_model->getAll();

		$this->load->view('template/topbar', $data);
		$this->load->view('template/sidebar_admin', $data);
		$this->load->view('admin/v_user', $data);
		$this->load->view('template/footer', $data);		
	}

	public function reset_pasword($id){
		$user = $this->db->get_where('user', ['id' => $id])->row_array();
		// echo $user['nama']; die();
		$pas_baru = "user1234";
		// echo password_hash($pas_baru, PASSWORD_DEFAULT);
		$this->db->set('password', password_hash($pas_baru, PASSWORD_DEFAULT));
		$this->db->where('id', $id);
		$this->db->update('user');
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Reset Berhasil! pas: user1234</div>');
			redirect('Admin_user');

	}

	public function delete_user($id){
		$user = $this->db->get_where('user', ['id' => $id])->row_array();
		unlink(FCPATH . '/assets/dist/img/' . $user['image']);

		$this->db->where('id', $id);
		$this->db->delete('user');

		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Delete User Berhasil</div>');
		redirect('Admin_user');

	}

	public function insert_user(){
		// $data = $this->db->get_where('user', ['id' => $id])->row_array();

		$this->form_validation->set_rules('nama', 'User Name', 'required|trim');
		$this->form_validation->set_rules('nip', 'User Full Name', 'required|trim');
		$this->form_validation->set_rules('jabatan', 'User Jabatan', 'required|trim|is_unique[user.nip]', [
			'is_unique' => 'Nomor Induk Pegawai sudah terpakai !'
		]);
		$this->form_validation->set_rules('unit_kerja', 'User Unit Kerja', 'required|trim');
		$this->form_validation->set_rules('pangkat_golongan', 'User Pangkat Golongan', 'required|trim');

		if ($this->form_validation->run() == false){
			redirect('Admin_user');
		}
		else{
			if(!empty($_FILES['img']['name'])){
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
						$img_new = $this->upload->data('file_name');
					} else {
						echo $this->upload->dispay_errors();
					}
				}else{
					$img_new = "user2-160x160.jpg";
				}
			}else {
				$img_new = "user2-160x160.jpg";
			}

			date_default_timezone_set('Asia/Makassar');
			$tgl_update = date('Y-m-d H:i:s');	
			$pas_baru = "user1234";
			$pas_baru = password_hash($pas_baru, PASSWORD_DEFAULT);		

			$data = [
				'nama' => $this->input->post('nama', true),
				'nip' => $this->input->post('nip', true),
				'jabatan' => $this->input->post('jabatan', true),
				'unit_kerja' => $this->input->post('unit_kerja', true),
				'pangkat_golongan' => $this->input->post('pangkat_golongan', true),
				'is_active' => 1,
				'role_id' => 1,
				'tgl_update' => date('Y-m-d H:i:s'),
				'password' => $pas_baru,
				'image' => $img_new
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">Berhasil Menambahkan User! password default : user1234</div>');
			redirect('Admin_user');
		}

	}
}
		
		


