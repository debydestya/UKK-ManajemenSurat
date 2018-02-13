<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('surat_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('jabatan') == "Admin") {
				$data['view'] = 'admin/dashboard_view';
				$data['isi_dashboard'] = $this->surat_model->get_data_dashboard();

				$this->load->view('template_view', $data);
			} else {
				redirect('disposisi');
			}
		} else {
			redirect('login');
		}
	}

	public function surat_masuk()
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == "Admin") {
				$data['view'] = 'admin/surat_masuk_view';
				$data['list_surat'] = $this->surat_model->get_surat_masuk();
				$data['jenis_surat'] = $this->surat_model->get_jenis_surat();

				$this->load->view('template_view', $data);
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

	public function add_surat()
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == "Admin") {
				$this->form_validation->set_rules('nomorsurat', 'nomorsurat', 'trim|required');
				$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
				$this->form_validation->set_rules('pengirim', 'fieldlabel', 'trim|required');
				$this->form_validation->set_rules('tanggalkirim', 'tanggalkirim', 'trim|required');
				$this->form_validation->set_rules('tanggalterima', 'tanggalterima', 'trim|required');
				$this->form_validation->set_rules('perihal', 'perihal', 'trim|required');

				if ($this->form_validation->run() == TRUE) {
					//konfig upload file
					$config['upload_path']		= './uploads/';
					$config['allowed_types']	= 'pdf';
					$this->load->library('upload', $config);

					if ($this->upload->do_upload('file_surat')) {
						if ($this->surat_model->add_surat($this->upload->data())) {
							$this->session->set_flashdata('notif', 'Tambah Surat Berhasil');
							redirect('surat/surat_masuk');
						} else {
							$this->session->set_flashdata('notif', 'Tambah Surat Gagal');
						}
					} else {
						$this->session->set_flashdata('notif', $this->upload->display_errors());
						redirect('surat/surat_masuk');
					}
				} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/surat_masuk');
				}
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

	public function delete_surat($id_surat_masuk)
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == "Admin") {
				if ($this->surat_model->delete_surat($id_surat_masuk)) {
					$this->session->set_flashdata('notif', 'Hapus Data Berhasil');
					redirect('surat/surat_masuk');
				} else {
					$this->session->set_flashdata('notif', 'Hapus Surat Gagal!');
					redirect('surat/surat_masuk');
				}
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

	public function edit_surat($id_surat_masuk)
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == "Admin") {
				$this->form_validation->set_rules('nomorsurat', 'nomorsurat', 'trim|required');
				$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
				$this->form_validation->set_rules('pengirim', 'fieldlabel', 'trim|required');
				$this->form_validation->set_rules('tanggalkirim', 'tanggalkirim', 'trim|required');
				$this->form_validation->set_rules('tanggalterima', 'tanggalterima', 'trim|required');
				$this->form_validation->set_rules('perihal', 'perihal', 'trim|required');

				if ($this->surat_model->edit_surat($id_surat_masuk)) {
					$this->session->set_flashdata('notif', 'Edit Surat Berhasil');
					redirect('surat/surat_masuk');
				} else {
					$this->session->set_flashdata('notif', 'Edit Surat Gagal!');
					redirect('surat/surat_masuk');
				}
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}

	public function edit_file_surat($id_surat_masuk)
	{
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('jabatan') == "Admin") {
				$config['upload_path'] = './uploads';
				$config['allowed_types'] = 'pdf';
				
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('file_surat')){
					if ($this->surat_model->edit_file($this->upload->data(),$id_surat_masuk)) {
						$this->session->set_flashdata('notif', 'Edit File Berhasil');
						redirect('surat/surat_masuk');
					} else {
						$this->session->set_flashdata('notif', 'Edit File Gagal');
						redirect('surat/surat_masuk');
					}
				} else {
					$this->session->set_flashdata('notif', $this->upload->display_errors());
					redirect('surat/surat_masuk');
				}
			} else {
				redirect('surat');
			}
		} else {
			redirect('login');
		}
	}
}
