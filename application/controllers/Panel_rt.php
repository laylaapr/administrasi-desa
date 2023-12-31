<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Panel_rt extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		akses_terbatas();
		no_akses();
	}

	function index()
	{
		$ktp 		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();
		redirect('Panel_rt/rt/'.$get_rt['rt']);
	}

	function rt($id)
	{
		//rt_sekretaris();
		$profil 	= $this->db->get('profil')->row_array();
		$ktp		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();

		if($id == $get_rt['rt'])
		{
			$data = array(
				'profil'	=> $get_rt,
				'content'	=> 'panel/dashboard.php',
				'rt'		=> $this->db->query("SELECT * from rt where id_rt='$id'")->row_array()
			);

			$this->load->view('template', $data);
		} else {
			$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
		}
	}

	function warga_rt($id)
	{
		rt_sekretaris();
		$profil 	= $this->db->get('profil')->row_array();
		$ktp		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();


		if($id == $get_rt['rt'])
		{
			$data = array(
				'profil'	=> $get_rt,
				'content'	=> 'warga/daftar_warga.php',
				'rt'		=> $this->db->query("SELECT * from rt where id_rt='$id'")->row_array(),
				'w'			=> $this->db->query("SELECT * from profil p, user u where p.no_ktp=u.no_ktp and p.rt='$id'")->result(),
				'id'		=> $id,
				'jml'		=> $this->db->query("SELECT * from profil where rt='$id'")->num_rows()
			);

			$this->load->view('temp_data', $data);
		} else {
			$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
		}
	}

	function tambah_warga()
	{
		$v 			= $this->input;
		$username	= strip_tags($v->post('username'));
		$id 		= $v->post('rt');
		$ktp 		= strip_tags($v->post('no_ktp'));
		$cek_user	= $this->db->query("SELECT username from user where no_ktp='$ktp'")->num_rows();

		if($cek_user > 0)
		{
			$this->session->set_flashdata('error', 'Nomor KTP sudah ada yang pakai, ganti dengan user lain!');
			redirect('Panel_rt/warga_rt/'.$id);
		}elseif (strlen($ktp) != 16)
		{
			$this->session->set_flashdata('error', 'Nomor KTP harus 16 Angka!');
			redirect('Panel_rt/warga_rt/'.$id);
		}else
		{
			$config['upload_path']		= './assets/upload'.$ktp.'/';
			$config['allowed_types']	= 'jpg|jpeg|png|bmp';
			$config['max_size']			= '5000';
			$config['file_name']		= $ktp.'_foto';
			$this->load->library('upload',$config);

			$this->upload->do_upload('foto');
			$upload_data 				= array('uploads' => $this->upload->data());
			$config['image_library']	= 'gd2';
			$config['source_image']		= './assets/upload/'.$ktp.'/'.$upload_data['uploads']['file_name'];
			$this->load->library('image_lib', $config);
			$data = array(
			'rt'			=> strip_tags($v->post('rt')),
			'no_ktp'		=> strip_tags($v->post('no_ktp')),
			'sex'			=> strip_tags($v->post('sex')),
			'no_kontak'		=> strip_tags($v->post('no_kontak')),
			'nama_lengkap'	=> strip_tags($v->post('nama_lengkap')),
			'tgl_lahir'		=> date('Y-m-d', strtotime($v->post('tgl_lahir'))),
			'pendidikan'	=> $v->post('pendidikan'),
			'agama'			=> $v->post('agama'),
			'pekerjaan'		=> $v->post('pekerjaan'),
			'email_warga'	=> $v->post('email_warga'),
			'no_rumah'		=> strip_tags($v->post('no_rumah')),
			'hubungan'		=>'Kepala Keluarga',
			'foto'			=> $upload_data['uploads']['file_name']
		);

		$user = array(
			'no_ktp'		=> strip_tags($v->post('no_ktp')),
			'username'		=> strip_tags($v->post('no_ktp')),
			'password'		=> md5($v->post('no_ktp')),
			'role'			=> 'warga',
			'status'		=> 1
		);
		//foto ktp
			$config['upload_path']		= './assets/upload';
			$config['allowed_types']	= 'jpg|jpeg|png|bmp';
			$config['max_size']			= '5000';
			$config['file_name']		= 'foto_ktp';
			$this->load->library('upload',$config);

			$this->upload->do_upload('foto_ktp');
			$upload_data 				= array('uploads' => $this->upload->data());
			$config['image_library']	= 'gd2';
			$config['source_image']		= './assets/upload/'.$upload_data['uploads']['file_name'];
			$this->load->library('image_lib', $config);

		//foto kk
			$config2['upload_path']		= './assets/upload';
			$config2['allowed_types']	= 'jpg|jpeg|png|bmp';
			$config2['max_size']		= '5000';
			$config2['file_name']		= 'foto_kk';
			$this->load->library('upload',$config2);

			$this->upload->do_upload('foto');
			$upload_data2 				= array('uploads' => $this->upload->data());
			$config2['image_library']	= 'gd2';
			$config2['source_image']	= './assets/upload/'.$upload_data2['uploads']['file_name'];
			$this->load->library('image_lib', $config2);

			$dokumen = array(
			'no_ktp'    => $ktp,
			'foto_ktp'	=> $upload_data['uploads']['file_name'],
			'foto_kk'	=> $upload_data2['uploads']['file_name']
		);
		
		
		$this->db->insert('profil', $data);
		$this->db->insert('user', $user);
		$this->db->insert('dokumen', $dokumen);
		$this->session->set_flashdata('sukses', 'Data Berhasil disimpan!');
			redirect('Panel_rt/warga_rt/'.$id);

		}
		
	}

	

	function email_rt($id)
	{
		$profil 	= $this->db->get('profil')->row_array();
		$ktp		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();


		if($id == $get_rt['rt'])
		{
			//$iuran = $this->db->query("SELECT * from buat_iuran group by tahun");

			$data = array(
				'content'	=> 'panel/email.php',
				'id_rt'		=> $id
			);

			$this->load->view('template', $data);
		} else {
			$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
		}
	}

	function simpan_email()
	{
		$id = $this->input->post('id_rt');

		$data = array(
			'email'			=> $this->input->post('email'),
			'pass_email'	=> $this->input->post('pass_email')
		);

		$this->db->where('id_rt', $id);
		$this->db->update('rt', $data);

		$this->session->set_flashdata('suksess','Data Email berhasil disimpan');
		redirect('Panel_rt/email_rt/'.$id);
	}

	function statistik($id)
	{
		rt_sekretaris();
		$profil 	= $this->db->get('profil')->row_array();
		$ktp		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();
		$agama 		= $this->db->query("SELECT agama from profil where rt='$id' group by agama");


		if($id == $get_rt['rt'])
		{
			$data = array(
				'profil'	=> $get_rt,
				'content'	=> 'panel/statistik.php',
				'rt'		=> $this->db->query("SELECT * from rt where id_rt='$id'")->row_array(),
				'w'			=> jml_warga_by_sex($get_rt['rt'],'Wanita'),
				'p'			=> jml_warga_by_sex($get_rt['rt'],'Pria'),
				'id'		=> $id,
				'jml'		=> $this->db->query("SELECT * from profil where rt='$id'")->num_rows(),
				'jmlp'		=> $this->db->query("SELECT pendidikan from profil where rt='$id' group by pendidikan")->num_rows(),
				'pn'		=> $this->db->query("SELECT pendidikan from profil where rt='$id' group by pendidikan")->result(),
				'ag'		=> $agama->result(),
				'pk'		=> $this->db->query("SELECT pekerjaan from profil where rt='$id' group by pekerjaan")->result(),
			);

			$this->load->view('template', $data);
		} else {
			$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
		}
	}

	function surat($id)
	{
		akses_ketua_rt();
		$profil 	= $this->db->get('profil')->row_array();
		$ktp		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();


		if($id == $get_rt['rt'])
		{
			$data = array(
				'profil'	=> $get_rt,
				'content'	=> 'panel/surat.php',
				'rt'		=> $this->db->query("SELECT * from rt where id_rt='$id'")->row_array(),
				'w'			=> $this->db->query("SELECT * from surat s, profil p where s.dari=p.no_ktp and s.rt='$id' and s.status=0")->result(),
				'k'			=> $this->db->query("SELECT * from surat s, profil p where s.dari=p.no_ktp and s.rt='$id' and s.status=1")->result(),
				'id'		=> $id,
				'jml'		=> $this->db->query("SELECT * from profil where rt='$id'")->num_rows()
			);

			$this->load->view('template', $data);
		} else {
			$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
		}
	}

	function penerbitan_surat($id)
	{
		akses_ketua_rt();
		$profil 	= $this->db->get('profil')->row_array();
		$ktp		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();
		$rtnya 		= $this->db->query("SELECT rt from surat")->row_array();
		$rt 		= $get_rt['rt'];
		$no 		= $this->db->query("SELECT no_urut from surat where rt='$rt' ORDER BY no_urut DESC LIMIT 1")->row_array();


		if($rtnya['rt'] == $get_rt['rt'])
		{
			$data = array(
				'rt'		=> $get_rt['rt'],
				'content'	=> 'panel/penerbitan_surat.php',
				'k'			=> $this->db->query("SELECT * from surat s, profil p where s.dari=p.no_ktp and s.id_surat='$id'")->row_array(),
				'ketua'		=> $this->db->query("SELECT * from user u, profil p where u.no_ktp=p.no_ktp and p.rt='$rt' and u.role='Ketua'")->row_array(),
				'no_surat'	=> $no['no_urut']+1,
				'id'		=> $id

			);

			$this->load->view('template', $data);
		} else {
			$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
		}
	}

	function terbitkan_surat()
	{
		$get_rt = get_rt_by_ktp($this->session->userdata('no_ktp'));
		$id 	= $this->input->post('id_surat');
		$ktp 	= $this->input->post('ktp_warga');
		$data = array(
			'no_urut' 			=> $this->input->post('no_urut'),
			'nomor_surat'			=> $this->input->post('no_surat'),
			'status'			=> 1,
			'tgl_penerbitan'	=> date('Y-m-d H:i:s')
		);	

		$this->db->where('id_surat', $id);
		$this->db->update('surat', $data);

		$ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.googlemail.com";
        $config['smtp_port'] = 465;
        $config['smtp_user'] = email_set('email',$get_rt);
        $config['smtp_pass'] = email_set('pass_email',$get_rt);
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
		   //  //memanggil library email dan set konfigurasi untuk pengiriman email
		   
		    $this->email->initialize($config);
		    //konfigurasi pengiriman
		    $list = array(email_warga($ktp),email_set('email',$get_rt));
		    $this->email->from(email_set('email',$get_rt),'Sistem Pengajuan Surat RT'.$get_rt);
		    $this->email->to($list);
		    $this->email->subject("Penerbitan Surat ".get_name($ktp,'nama_lengkap'));
		    $this->email->message(
		     "<center>Penerbitan Surat Baru atas nama<br>
		     
		     Nama : ".get_name($ktp,'nama_lengkap')."<br>
		    </center>"
		    );
		       if($this->email->send())
		    {
		$this->session->set_flashdata('sukses','Surat Berhasil diterbitkan !');
		redirect('Panel_rt/cetak_surat/'.$id);
	} else {
		redirect('Panel_rt/cetak_surat/'.$id);
	}
	}

	function cetak_surat($id)
	{
		akses_ketua_rt();
		$cetak = $this->db->query("SELECT * from surat where id_surat='$id'")->row_array();
		$ktp		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();
		$rtnya 		= $this->db->query("SELECT rt from surat")->row_array();
		$rt 		= $get_rt['rt'];

		if($cetak['status'] != 1 and $rtnya['rt'] != $get_rt['rt'])
		{
			$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
		} else {
			$data = array(
				'rt'		=> $get_rt['rt'],
				'content'	=> 'panel/surat_terbit.php',
				'k'			=> $this->db->query("SELECT * from surat s, profil p where s.dari=p.no_ktp and s.id_surat='$id'")->row_array(),
				'ketua'		=> $this->db->query("SELECT * from user u, profil p where u.no_ktp=p.no_ktp and p.rt='$rt' and u.role='Ketua'")->row_array(),
				
				'id'		=> $id

			);

			$this->load->view('template', $data);
		}
	}
	function simpan_surat($id)
	{
		akses_ketua_rt();
		$cetak = $this->db->query("SELECT * from surat where id_surat='$id'")->row_array();
		$ktp		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();
		$rtnya 		= $this->db->query("SELECT rt from surat")->row_array();
		$rt 		= $get_rt['rt'];

		if($cetak['status'] != 1 and $rtnya['rt'] != $get_rt['rt'])
		{
			$data = array(
				'content'	=> 'false.php'
			);
			$this->load->view('template', $data);
		} else {
			    
			$data = array(
				'rt'		=> $get_rt['rt'],
				'content'	=> 'panel/cetak.php',
				'k'			=> $this->db->query("SELECT * from surat s, profil p where s.dari=p.no_ktp and s.id_surat='$id'")->row_array(),
				'ketua'		=> $this->db->query("SELECT * from user u, profil p where u.no_ktp=p.no_ktp and p.rt='$rt' and u.role='Ketua'")->row_array(),
				
				'id'		=> $id

			);

			//$this->load->view('print', $data);

			$this->load->library('Pdf');
			$this->pdf->load_view('panel/cetak', $data);
			$this->pdf->set_paper('A4', 'portrait');
			$this->pdf->render();

			$this->pdf->stream($cetak['nomor_surat'].'.pdf');
			
		}
	}

	function cari()
	{
		$ktp		= $this->session->userdata('no_ktp');
		$get_rt 	= $this->db->query("SELECT * from profil where no_ktp='$ktp'")->row_array();
		$rt 		= $get_rt['rt'];

		$keyword 	= $this->input->get('cari');
		$this->db->like('nama_lengkap', $keyword);
		$this->db->or_like('no_ktp', $keyword);
		$this->db->select('*');
		$this->db->from('profil');
		//$this->db->where('rt', $rt);
		$q 			= $this->db->get();
		$s			= $this->db->count_all_results();
		
		$data 		= array(
			'content'	=> 'panel/hasil-cari.php',
			'hasil'		=> $q->result(),
			'kata'		=> $keyword
		);	

		$this->load->view('template', $data);
	}

	
}