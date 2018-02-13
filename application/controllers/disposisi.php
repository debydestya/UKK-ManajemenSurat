<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('disposisi_model');
		$this->load->model('surat_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			$data['view'] = 'pegawai/disposisi_masuk_view';
			$data['data_disposisi'] = $this->disposisi_model->disposisi_masuk($this->session->userdata('id_pengguna'));

			$this->load->view('template_view', $data);
		} else {
			redirect('login');
		}	
	}

	public function disposisi_keluar($id_surat_masuk)
	{
		if ($this->session->userdata('logged_in')) {
			$data['data_disposisi'] = $this->disposisi_model->disposisi_keluar($this->session->userdata('id_pengguna'));
			$data['data_surat'] = $this->surat_model->get_surat_masuk_by_id($id_surat_masuk);
			$data['data_tujuan'] = $this->disposisi_model->get_data_user();
			$data['view'] = 'pegawai/disposisi_keluar_view';

			$this->load->view('template_view',$data);
		} else {
			redirect('login');
		}
	}
}


/* End of file disposisi.php */
/* Location: ./application/controllers/disposisi.php */