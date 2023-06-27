<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		no_akses();
	}

	function index()
	{	
		$get_rt = get_rt_by_ktp($this->session->userdata('no_ktp'));
		$data 			= array(
			'content'	=> 'dashboard/index.php',
			'test'		=> $this->db->query("SELECT no_urut from surat where rt='$get_rt' ORDER BY no_urut DESC LIMIT 1")->row_array()
		);

		$this->load->view('template', $data);
	}

	function ajukan_surat()
	{

		$get_rt 	= get_rt_by_ktp($this->session->userdata('no_ktp'));
		$user 		= $this->session->userdata('no_ktp');
		$no_urut 	= $this->db->query("SELECT no_urut from surat where rt='$get_rt' ORDER BY no_urut DESC LIMIT 0")->row_array();

		
		$data = array(
			'rt'			=> $get_rt,
			'dari'			=> $this->session->userdata('no_ktp'),
			'perihal'		=> $this->input->post('perihal'),
			'tgl_pengajuan'	=> date('Y-m-d'),
			//'no_urut'		=> $this->input->post('no_urut'),
			'keperluan'		=> strip_tags($this->input->post('keperluan'))
			
		);
			$config['upload_path']		= './assets/upload';
			$config['allowed_types']	= 'jpg|jpeg|png|bmp';
			$config['max_size']			= '5000';
			$config['file_name']		= 'dok_pendukung';
			$this->load->library('upload',$config);

			$this->upload->do_upload('dok_pendukung');
			$upload_data 				= array('uploads' => $this->upload->data());
			$config['image_library']	= 'gd2';
			$config['source_image']		= './assets/upload/'.$upload_data['uploads']['file_name'];
			$this->load->library('image_lib', $config);

		$dok_pendukung = array(
			'no_ktp' 	=> $this->session->userdata('no_ktp'),
			'dokumen'	=> $upload_data['uploads']['file_name']
		);
		

		$this->session->set_flashdata('sukses','Pengajuan anda telah kami terima, harap menunggu dan cek selalu status surat anda');
		$this->db->insert('surat', $data);
		$this->db->insert('dok_pendukung', $dok_pendukung);
		redirect('Home');
	
	}
	
	function status_pengajuan()
	{
		$get_rt = get_rt_by_ktp($this->session->userdata('no_ktp'));
		$dari 	= $this->session->userdata('no_ktp');
		$data = array(
			'content'	=> 'dashboard/surat.php',
			's'			=> $this->db->query("SELECT * from surat where rt='$get_rt' and dari='$dari'")->result()
			
		);

		$this->load->view('template', $data);
	}

	

	function update_password()
	{
		$data = array(
			'content'	=> 'dashboard/gantipass.php'
		);

		$this->load->view('template', $data);
	}

	function updatePass()
	{
		$id 				 = $this->session->userdata('id_user');
		$data['password']	 = md5($this->input->post('password'));

		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
		$this->session->set_flashdata('sukses','Password berhasil di update');
		redirect('Home/update_password');
	}
}