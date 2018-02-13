<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_data_user()
	{
		return $this->db->join('jabatan', 'jabatan.id_jabatan = pengguna.id_jabatan')
						->join('bagian', 'bagian.id_bagian = pengguna.id_bagian')
						->order_by('jabatan.id_jabatan', 'asc')
						->where('level < '.$this->session->userdata('level'))
						->get('pengguna')
						->result();
	}


	public function get_disposisi($id_surat_masuk)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat_masuk = surat_masuk.id_surat_masuk', 'left')
					   ->join('pengguna','pengguna.id_pengguna = disposisi.id_penerima')
					   ->join('jabatan','pengguna.id_jabatan = jabatan.id_jabatan')
					   ->join('bagian','bagian.id_bagian = pengguna.id_bagian')
					   ->where('disposisi.id_surat_masuk', $id_surat_masuk)
					   ->get('surat_masuk')
					   ->result();
	}

	public function add_disposisi($id_surat_masuk)
	{
		$data = array(
			'id_surat_masuk' 	=> $id_surat_masuk,
			'id_penerima'		=> $this->input->post('tujuan'),
			'id_pengirim'		=> $this->session->userdata('id_pengguna'),
			'catatan'			=> $this->input->post('catatan'),
			'status'			=> "0"
		);

		$this->db->insert('disposisi', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete_disposisi($id_disposisi)
	{
		$this->db->where('id_disposisi', $id_disposisi)
				 ->delete('disposisi');

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function disposisi_masuk($id_penerima)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat_masuk = surat_masuk.id_surat_masuk')
						->join('pengguna','pengguna.id_pengguna = disposisi.id_pengirim')
						->join('jabatan','pengguna.id_jabatan = jabatan.id_jabatan')
						->join('bagian','bagian.id_bagian = pengguna.id_bagian')
						->where('id_penerima',$id_penerima)
						->get('surat_masuk')
						->result();
	}

	public function disposisi_keluar($id_pengirim)
	{
		return $this->db->join('disposisi', 'disposisi.id_surat_masuk = surat_masuk.id_surat_masuk')
						->join('pengguna','pengguna.id_pengguna = disposisi.id_penerima')
						->join('jabatan','jabatan.id_jabatan = pengguna.id_jabatan')
						->join('bagian','bagian.id_bagian = pengguna.id_bagian')
						->where('disposisi.id_pengirim', $this->session->userdata('id_pengguna'))
						->where('disposisi.id_surat_masuk', $this->uri->segment(3))
						->get('surat_masuk')
						->result();
	}

}

/* End of file disposisi_model.php */
/* Location: ./application/models/disposisi_model.php */