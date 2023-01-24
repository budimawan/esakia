<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation'); 
        $this->load->model("User_model");
	}

	public function index()
	{
		$nip = $this->session->userdata('id');
		$user = $this->User_model->getById($nip);

		$this->form_validation->set_rules('nip', 'NIP', 'trim|required');
		$this->form_validation->set_rules('password', 'PASSWORD', 'trim|required');
		// $user = $this->db->get_where('user', ['nip' => $nip])->row_array();
		if ($this->session->userdata('id')){
			if ($user['role_id'] == 1){
				redirect('User_dashboard');
			}
			else if ($user['role_id'] == 2){
				redirect('Admin_dashboard');
			} else {
				$this->load->view('auth/login', $data);
			}
		}		
		else if ($this->form_validation->run() == false){
			$data['title'] = 'Login Page';
			$this->load->view('auth/login', $data);	
		}
		else{
			$this->_login();
		}
	}

	private function _login()
	{
		$nip = $this->input->post('nip');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['nip' => $nip])->row_array();
		// var_dump ($user['is_active']);die();

		//cek usernya ada or not
		if ($user){
			//cek user aktif
			if ($user['is_active'] == 1){
				if (password_verify($password, $user['password'])){
					$data = [
						'id' => $user['id'],
						'nip' => $user['nip'],
						'role_id' => $user['role_id'],
					];
					// var_dump($user);
					// die;
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1){
						redirect('User_dashboard');
					}
					else if ($user['role_id'] == 2){
						redirect('Admin_dashboard');
					}
					
				}
				else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
					redirect('auth');
				}
			}
			else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIP belum aktifasi</div>');
				redirect('auth');
			}
		}
		else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NIP belum terdaftar!</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('nip');
		$this->session->unset_userdata('role');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah keluar dari sistem!</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('blocked');
	}


}
