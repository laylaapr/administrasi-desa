<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Warga extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		no_akses();
	}

	function index()
	{
		$data = array(
			'content' 		=> 'warga/index.php'
		);

		$this->load->view('template', $data);
	}

	function tambah()
	{

	}

	

	function rt($id)
	{
		akses_ketua_rt();
		$profil 	= $this->db->get('profil')->row_array();
		$ktp		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();

		if($id == $get_rt['rt'])
		{
			$data = array(
				'profil'	=> $get_rt,
				'content'	=> 'warga/daftar_warga.php',
				'rt'		=> $this->db->query("SELECT * from rt where id_rt='$id'")->row_array()
			);

			$this->load->view('temp_data', $data);
		} else {
			$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
		}
	}

	function profil($id)
	{
		$get_ktp		= $this->db->query("SELECT no_ktp from profil")->row_array();
		$no_rumah 		= $this->db->query("SELECT no_rumah from profil where no_ktp='$id'")->row_array();
		$get_no			= $no_rumah['no_rumah'];
		$hubungan 		= $this->db->query("SELECT no_parent from hubungan where no_child='$id'")->row_array();
		$parent 		= $this->session->userdata('no_ktp');

		if($this->session->userdata('no_ktp') === $id)
		{
			$data = array(
			'content' 	=> 'warga/profil.php',
			'p'			=> $this->db->query("SELECT * from profil where no_ktp='$id'")->row_array(),
			'hub'		=> $this->db->query("SELECT * from profil where no_rumah='$get_no' and not (no_ktp='$id')")->result(),
			'dok'		=> $this->db->query("SELECT * from dokumen where no_ktp='$id'")->row_array()
		);

		$this->load->view('temp_data', $data);
	} else if($this->session->userdata('role')==='Ketua' or $this->session->userdata('role')==='Sekretaris' or $hubungan['no_parent'] == $parent or $this->session->userdata('role')==='rw' or $this->session->userdata('role')==='admin')
	{
		$data = array(
			'content' 	=> 'warga/profil.php',
			'p'			=> $this->db->query("SELECT * from profil where no_ktp='$id'")->row_array(),
			'hub'		=> $this->db->query("SELECT * from profil where no_rumah='$get_no' and not (no_ktp='$id')")->result(),
			'dok'		=> $this->db->query("SELECT * from dokumen where no_ktp='$id'")->row_array()
		);

		$this->load->view('temp_data', $data);
	} 
	else
	{
		$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('temp_data', $data);
	}
		
	}

	function upload_ktp()
	{
		$ktp = $this->input->post('no_ktp');
			$config['upload_path']		= './assets/upload/'.$ktp.'/';
			$config['allowed_types']	= 'jpg|jpeg|png|bmp';
			$config['max_size']			= '5000';
			$config['file_name']		= $ktp.'_ktp';
			$this->load->library('upload',$config);

			$this->upload->do_upload('ktp');
			$upload_data 				= array('uploads' => $this->upload->data());
			$config['image_library']	= 'gd2';
			$config['source_image']		= './assets/upload/'.$ktp.'/'.$upload_data['uploads']['file_name'];
			$this->load->library('image_lib', $config);

			$data = array(
				'foto_ktp'	=> $upload_data['uploads']['file_name']
			);

			$this->db->where('no_ktp', $ktp);
			$this->db->update('dokumen', $data);
			$this->session->set_flashdata('sukses','Upload KTP Berhasil');

			redirect('Warga/profil/'.$ktp);
	}

	function upload_kk()
	{
		$ktp = $this->input->post('no_ktp');
			$config['upload_path']		= './assets/upload/'.$ktp.'/';
			$config['allowed_types']	= 'jpg|jpeg|png|bmp';
			$config['max_size']			= '5000';
			$config['file_name']		= $ktp.'_kk';
			$this->load->library('upload',$config);

			$this->upload->do_upload('kk');
			$upload_data 				= array('uploads' => $this->upload->data());
			$config['image_library']	= 'gd2';
			$config['source_image']		= './assets/upload/'.$ktp.'/'.$upload_data['uploads']['file_name'];
			$this->load->library('image_lib', $config);

			$data = array(
				'foto_kk'	=> $upload_data['uploads']['file_name']
			);

			$this->db->where('no_ktp', $ktp);
			$this->db->update('dokumen', $data);
			$this->session->set_flashdata('sukses','Upload KK Berhasil');

			redirect('Warga/profil/'.$ktp);
	}

	function tambah_keluarga()
	{
		$v 		= $this->input;
		$ktp 	= $v->post('no_parent');
		$child 	= $v->post('no_ktp');
		$ck_ktp = $this->db->query("SELECT no_ktp from profil where no_ktp='$child'")->num_rows();
		if($ck_ktp > 0)
		{
			$this->session->set_flashdata('error','Nomor KTP sudah terdaftar');
			redirect('Warga/profil/'.$ktp);
		} 
		else {
		$profil = array(
			'rt'			=> strip_tags($v->post('rt')),
			'no_ktp'		=> strip_tags($v->post('no_ktp')),
			'sex'			=> $v->post('sex'),
			'no_kontak'		=> strip_tags($v->post('no_kontak')),
			'nama_lengkap'	=> strip_tags($v->post('nama_lengkap')),
			'tgl_lahir'		=> date('Y-m-d', strtotime($v->post('tgl_lahir'))),
			'pendidikan'	=> $v->post('pendidikan'),
			'agama'			=> $v->post('agama'),
			'pekerjaan'		=> $v->post('pekerjaan'),
			'email_warga'		=> $v->post('email_warga'),
			'no_rumah'		=> strip_tags($v->post('no_rumah')),
			'hubungan'	=> $v->post('hubungan')
		);

		$user = array(
			'username'			=> strip_tags($v->post('no_ktp')),
			'password'		=> md5(strip_tags($v->post('no_ktp'))),
			'no_ktp'		=> strip_tags($v->post('no_ktp')),
			'role'			=> 'warga',
			'status'		=> 1
		);

		$hubungan = array(
			'no_parent'	=> $v->post('no_parent'),
			'no_child'	=> strip_tags($v->post('no_ktp'))
			
		);

		$dokumen = array(
			'no_ktp'	=> $child
		);

		$this->db->insert('profil', $profil);
		$this->db->insert('hubungan', $hubungan);
		$this->db->insert('dokumen', $dokumen);
		$this->db->insert('user', $user);
		
			mkdir('./assets/upload/'.$child, 0755, true);
		
		$this->session->set_flashdata('sukses','Data Berhasil Disimpan');
		redirect('Warga/profil/'.$ktp);
	}
	}

	function edit($id)
	{
		$get_ktp		= $this->db->query("SELECT no_ktp from profil")->row_array();
		$no_rumah 		= $this->db->query("SELECT no_rumah from profil where no_ktp='$id'")->row_array();
		$get_no			= $no_rumah['no_rumah'];
		$hubungan 		= $this->db->query("SELECT no_parent from hubungan where no_child='$id'")->row_array();
		$parent 		= $this->session->userdata('no_ktp');

		if($parent === $id or $this->session->userdata('role')==='Ketua' or $this->session->userdata('role')==='Sekretaris' or $hubungan['no_parent'] === $parent or $this->session->userdata('role')=='admin')
		{
			$data = array(
			'content' 	=> 'warga/edit_data.php',
			'p'			=> $this->db->query("SELECT * from profil where no_ktp='$id'")->row_array(),
			'hub'		=> $this->db->query("SELECT * from profil where no_rumah='$get_no' and not (no_ktp='$id')")->result(),
			'rt'		=> $this->db->get('rt')->result()
		);

		$this->load->view('temp_data', $data);
	} else
	{
		$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
	}
	}

	function ganti_rt($id)
	{
		$get_ktp		= $this->db->query("SELECT no_ktp from profil")->row_array();
		$no_rumah 		= $this->db->query("SELECT no_rumah from profil where no_ktp='$id'")->row_array();
		$get_no			= $no_rumah['no_rumah'];
		$hubungan 		= $this->db->query("SELECT no_parent from hubungan where no_child='$id'")->row_array();
		$parent 		= $this->session->userdata('no_ktp');

		if($this->session->userdata('role')=='admin' or $this->session->userdata('role')=='rw')
		{
			$data = array(
			'content' 	=> 'warga/ganti_rt.php',
			'p'			=> $this->db->query("SELECT * from profil where no_ktp='$id'")->row_array(),
			'hub'		=> $this->db->query("SELECT * from profil where no_rumah='$get_no' and not (no_ktp='$id')")->result(),
			'rt'		=> $this->db->get('rt')->result()
		);

		$this->load->view('temp_data', $data);
	} else
	{
		$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
	}
	}

	function update_rt()
	{
		$no_ktp = $this->input->post('no_ktp');
		$data['rt'] = $this->input->post('rtnya');

		$this->db->where('no_ktp', $no_ktp);
		$this->db->update('profil', $data);

		$this->session->set_flashdata('sukses', 'Ganti RT Berhasil');
		redirect('Warga/profil/'.$no_ktp);
	}

	function update()
	{
		$v 		= $this->input;
		$ktp 	= $v->post('no_parent');
		$profil = array(
			
			'no_ktp'		=> strip_tags($v->post('no_ktp')),
			'sex'			=> $v->post('sex'),
			'no_kontak'		=> strip_tags($v->post('no_kontak')),
			'nama_lengkap'	=> strip_tags($v->post('nama_lengkap')),
			'tgl_lahir'		=> date('Y-m-d', strtotime($v->post('tgl_lahir'))),
			'pendidikan'	=> $v->post('pendidikan'),
			'agama'			=> $v->post('agama'),
			'pekerjaan'		=> $v->post('pekerjaan'),
			'email_warga'	=> $v->post('email_warga'),
			'no_rumah'		=> strip_tags($v->post('no_rumah'))
		);

		$this->db->where('no_ktp', $ktp);
		$this->db->update('profil', $profil);
		$this->session->set_flashdata('sukses', 'Data Berhasil di Update');
		redirect('Warga/edit/'.$ktp);		
	}
}