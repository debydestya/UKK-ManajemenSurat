<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi_admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('disposisi_model');
		$this->load->model('surat_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == "Admin") {
				redirect('disposisi_admin/disposisi');
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

	public function disposisi($id_surat_masuk)
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == "Admin") {
				 $data['view'] = 'admin/disposisi_surat_view';
				 $data['data_surat'] = $this->surat_model->get_surat_masuk_by_id($this->uri->segment(3));
				 $data['data_tujuan'] = $this->disposisi_model->get_data_user();
				 $data['data_disposisi'] = $this->disposisi_model->get_disposisi($id_surat_masuk);
				 $this->load->view('template_view', $data);
			}
		} else {
			redirect('login');
		}
	}

	public function add_disposisi()
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == "Admin") {
				$this->form_validation->set_rules('tujuan', 'tujuan', 'trim|required');
				$this->form_validation->set_rules('catatan', 'catatan', 'trim|required');

				if ($this->form_validation->run() == TRUE) {
					if ($this->disposisi_model->add_disposisi($this->uri->segment(3))) {
						$this->session->set_flashdata('notif', 'Tambah disposisi berhasil');
						redirect('disposisi_admin/disposisi/'.$this->uri->segment(3));
					} else {
						$this->session->set_flashdata('notif', 'Tambah disposisi gagal');
						redirect('disposisi_admin/disposisi/'.$this->uri->segment(3));
					}
				} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('disposisi_admin/disposisi/'.$this->uri->segment(3));
				}
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

	public function delete_disposisi($id_surat_masuk,$id_disposisi)
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == "Admin") {
				if ($this->disposisi_model->delete_disposisi($id_disposisi)) {
					$this->session->set_flashdata('notif', 'Hapus Data Berhasil');
					redirect('disposisi_admin/disposisi/'.$id_surat_masuk);
				} else {
					$this->session->set_flashdata('notif', 'Hapus Disposisi Berhasil');
					redirect('disposisi_admin/disposisi/'.$id_surat_masuk);
				}
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

}

/* End of file disposisi_admin.php */
/* Location: ./application/controllers/disposisi_admin.php */