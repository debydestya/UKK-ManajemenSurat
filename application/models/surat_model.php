<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_model extends CI_Model {

public function __construct()
	{
		parent::__construct();
	
	}	

	public function get_data_dashboard(){
		$surat_masuk = $this->db->select('count(*) as total')
								->get('surat_masuk')
								->row();

		$surat_keluar = $this->db->select('count(*) as totalkeluar')
								 ->get('surat_keluar')
								 ->row();

		$pengguna 		= $this->db->select('count(*) as user')
							   ->get('pengguna')
							   ->row();

		return array(
			'surat_masuk'	=> $surat_masuk->total,
			'surat_keluar'	=> $surat_keluar->totalkeluar,
			'pengguna'		=> $pengguna->user
			);
	}

	public function get_surat_masuk()
	{
		return $this->db->join('jenis_surat', 'jenis_surat.id_jenis_surat = surat_masuk.id_jenis_surat', 'left')
						->get('surat_masuk')
						->result();
	}


	public function get_all_disposisi_masuk()
	{
		return $this->db->get('disposisi')
						->result();
	}

	public function get_jenis_surat()
	{
		return $this->db->get('jenis_surat')
						->result();
	}

	public function add_surat($file_surat)
	{
		$data = array(
				'nomor_surat' 		=> $this->input->post('nomorsurat'),
				'id_jenis_surat' 	=> $this->input->post('jenis'),
				'pengirim' 			=> $this->input->post('pengirim'),
				'tanggal_kirim' 	=> $this->input->post('tanggalkirim'),
				'tanggal_penerima' 	=> $this->input->post('tanggalterima'),
				'perihal' 			=> $this->input->post('perihal'),
				'file_surat' 		=> $file_surat['file_name']
				);

		$this->db->insert('surat_masuk', $data);
		if ($this->db->affected_rows() > 0) 
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete_surat($id_surat_masuk)
	{
		$this->db->where('id_surat_masuk', $id_surat_masuk)
				 ->delete('surat_masuk');

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function edit_surat($id_surat_masuk)
	{
		$data = array(
				'nomor_surat' 		=> $this->input->post('nomorsurat'),
				'id_jenis_surat' 	=> $this->input->post('jenis'),
				'pengirim' 			=> $this->input->post('pengirim'),
				'tanggal_kirim' 	=> $this->input->post('tanggalkirim'),
				'tanggal_penerima' 	=> $this->input->post('tanggalterima'),
				'perihal' 			=> $this->input->post('perihal'),
				);

		$this->db->where('id_surat_masuk', $id_surat_masuk)
				 ->update('surat_masuk', $data);

		if ($this->db->affected_rows() > 0) 
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function edit_file($file_surat, $id_surat_masuk)
	{
		$data = array('file_surat' => $file_surat['file_name'] );

		$this->db->where('id_surat_masuk', $id_surat_masuk)
				 ->update('surat_masuk', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_surat_masuk_by_id($id_surat_masuk)
	{
		return $this->db->where('id_surat_masuk', $id_surat_masuk)
						->get('surat_masuk')
						->row();
	}
}

/* End of file surat_model.php */
/* Location: ./application/models/surat_model.php */