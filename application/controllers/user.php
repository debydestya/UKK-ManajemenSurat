<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('user_model');
		//Do your magic here
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') ==  "Admin") {
				$data['view'] = 'user/user_view';
				$data['data_user'] = $this->user_model->get_user();
				$data['jabatan'] = $this->user_model->get_jabatan();
				$data['bagian'] = $this->user_model->get_bagian();

				$this->load->view('template_view',$data);
			} else {
				redirect('disposisi');
			}
		} else {
			redirect('login');
		}
	}

	public function add_user(){
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == "Admin") {
				$this->form_validation->set_rules('nik', 'nik', 'trim|required');
				$this->form_validation->set_rules('nama_awal', 'nama_awal', 'trim|required');
				$this->form_validation->set_rules('nama_akhir', 'nama_akhir', 'trim|required');
				$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
				$this->form_validation->set_rules('bagian', 'bagian', 'trim|required');

				if ($this->form_validation->run() == TRUE) {
					if ($this->user_model->add_user()) {
						$this->session->set_flashdata('notif', 'Tambah User Berhasil');
						redirect('user');
					} else {
						$this->session->set_flashdata('notif', 'Tambah User Gagal');
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('user');
				}
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

	public function delete_user()
	{

	}

	public function edit_user(){
		
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */