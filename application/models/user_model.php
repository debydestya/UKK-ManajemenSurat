<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_user()
	{
		return $this->db->join('jabatan', 'jabatan.id_jabatan = pengguna.id_jabatan', 'left')
						->join('bagian','bagian.id_bagian = pengguna.id_bagian', 'left')
						->get('pengguna')
						->result();
	}

	public function get_jabatan()
	{
		return $this->db->get('jabatan')
						->result();
	}

	public function get_bagian()
	{
		return $this->db->get('bagian')
						->result();
	}

	public function add_user()
	{
		$data = array(
			'nik' 			=> $this->input->post('nik'), 
			'nama_depan'	=> $this->input->post('nama_awal'),
			'nama_belakang'	=> $this->input->post('nama_akhir'),
			'password'		=> md5($this->input->post('nik')),
			'id_jabatan'	=> $this->input->post('jabatan'),
			'id_bagian'		=> $this->input->post('bagian')
		);

		$this->db->insert('pengguna', $data);

		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function edit_user()
	{

	}

	public function delete_user()
	{
		
	}
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */