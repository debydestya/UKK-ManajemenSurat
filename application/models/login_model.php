<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
			
	}

	function cek_user()
	{
		$query = $this->db->join('jabatan', 'jabatan.id_jabatan = pengguna.id_jabatan', 'left')
						  ->join('bagian', 'bagian.id_bagian = pengguna.id_bagian', 'left')
						  ->where('nik', $this->input->post('nik'))
						  ->where('password', md5($this->input->post('password')))
						  ->get('pengguna');

		if ($query->num_rows() == 1) 
		{
			$userdata = $query->row();
			$session = array(
							'logged_in' 	=> TRUE,
							'nik'			=> $userdata->nik,
							'id_pengguna'	=> $userdata->id_pengguna,
							'nama'			=> $userdata->nama_depan,
							'jabatan'		=> $userdata->nama_jabatan,
							'bagian'		=> $userdata->nama_bagian,
							'level'			=> $userdata->level 
							);

			$this->session->set_userdata( $session );

			return TRUE;
		} else {
			return FALSE;
		}
	}


}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */