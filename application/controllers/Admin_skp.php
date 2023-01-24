<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_skp extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		is_logged_in();
        $this->load->model("Skp_model"); 
        $this->load->model("User_model"); 
    }

	public function index()
	{
		$data['title'] = "Dashboard ADMIN";
        $nip = $this->session->userdata('nip');
        $data['user'] = $this->User_model->getByNip($nip);
		$data['user2'] =  $this->User_model->getAll();

		$this->load->view('template/topbar', $data);
		$this->load->view('template/sidebar_admin', $data);
		$this->load->view('admin/v_skp', $data);
		$this->load->view('template/footer_', $data);
	}

}
