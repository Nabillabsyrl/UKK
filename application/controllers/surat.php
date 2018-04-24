<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('surat_model');
	}

	public function index()
	{

		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				$data['main_view'] = 'admin/dashboard_view';
				$data['data_dashboard'] = $this->surat_model->get_data_dashboard();

				$this->load->view('template_view', $data);
			}else{
				$data['main_view'] = 'pegawai/disposisi_masuk';
				$data['data_disposisi'] = $this->surat_model->get_all_disposisi_masuk($this->session->userdata('id_pegawai'));
				$this->load->view('template_view', $data);
			}
		}else{
			redirect('login');
		}
	}

	public function surat_masuk()
	{
		if($this->session->userdata('logged_in') == TRUE){

			if($this->session->userdata('jabatan') == 'Sekretaris'){

				$data['main_view'] = 'admin/surat_masuk';
				$data['data_surat_masuk'] = $this->surat_model->get_surat_masuk();

				$this->load->view('template_view', $data);
			} else {
				$data['main_view'] = 'admin/surat_masuk';
				$data['data_surat_masuk'] = $this->surat_model->get_surat_masuk();

				$this->load->view('template_view', $data);
				
			}
		} else {
			redirect('login');
		}
	}

	public function surat_keluar()
	{
		if($this->session->userdata('logged_in') == TRUE){

			if($this->session->userdata('jabatan') == 'Sekretaris'){

				$data['main_view'] = 'admin/surat_keluar';
				$data['data_surat_keluar'] = $this->surat_model->get_surat_keluar();

				$this->load->view('template_view', $data);
			} else {
				$data['main_view'] = 'admin/surat_keluar';
				$data['data_surat_keluar'] = $this->surat_model->get_surat_keluar();

				$this->load->view('template_view', $data);
				
			}
		} else {
			redirect('login');
		}
	}

	public function tambah_surat_masuk()
	{
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				$this->form_validation->set_rules('no_surat', 'NO Surat', 'trim|required');
				$this->form_validation->set_rules('tgl_kirim', 'Tgl Kirim', 'trim|required|date');
				$this->form_validation->set_rules('tgl_terima', 'Tgl Terima', 'trim|required|date');
				$this->form_validation->set_rules('pengirim', 'Pengirim', 'trim|required');
				$this->form_validation->set_rules('penerima', 'Penerima', 'trim|required');
				$this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');

				if($this->form_validation->run() == TRUE){

					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'pdf';
					$config['max_size']  = 2000;
					
					$this->load->library('upload', $config);
					
					if ($this->upload->do_upload('file_surat')){
						if($this->surat_model->tambah_surat_masuk($this->upload->data()) == TRUE){
							$this->session->set_flashdata('notif', 'Tambah Surat Berhasil');
							redirect('surat/surat_masuk');
						}else{
							$this->session->set_flashdata('notif', 'Tambah Surat Gagal');
							redirect('surat/surat_masuk');
						}
					}else{
						$this->session->set_flashdata('notif', $this->upload->display_errors());
						redirect('surat/surat_masuk');
					}
				}else{
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/surat_masuk');
				}

				}
			}else{
				redirect('login');
			}
		}

	public function tambah_surat_keluar()
	{
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				$this->form_validation->set_rules('no_surat', 'NO Surat', 'trim|required');
				$this->form_validation->set_rules('tgl_kirim', 'Tgl Kirim', 'trim|required|date');
				$this->form_validation->set_rules('tujuan', 'Tujuan', 'trim|required');
				$this->form_validation->set_rules('perihal', 'Perihal', 'trim|required');

				if($this->form_validation->run() == TRUE){

					$config['upload_path'] = './uploads/';
					$config['allowed_types'] = 'pdf';
					$config['max_size']  = 2000;
					
					$this->load->library('upload', $config);
					
					if ($this->upload->do_upload('file_surat')){
						if($this->surat_model->tambah_surat_keluar($this->upload->data()) == TRUE){
							$this->session->set_flashdata('notif', 'Tambah Surat Berhasil');
							redirect('surat/surat_keluar');
						}else{
							$this->session->set_flashdata('notif', 'Tambah Surat Gagal');
							redirect('surat/surat_keluar');
						}
					}else{
						$this->session->set_flashdata('notif', $this->upload->display_errors());
						redirect('surat/surat_keluar');
					}
				}else{
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/surat_keluar');
				}

				}
			}else{
				redirect('login');
			}
		}

	public function get_surat_masuk_by_id($id_surat)
	{
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				$data_surat_masuk_by_id = $this->surat_model->get_surat_masuk_by_id($id_surat);
				echo json_encode($data_surat_masuk_by_id);
			} 
		} else{
			redirect('login');
		}
	}

	public function ubah_surat_masuk()
	{
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				$this->form_validation->set_rules('edit_no_surat', 'NO Surat', 'trim|required');
				$this->form_validation->set_rules('edit_tgl_kirim', 'Tgl Kirim', 'trim|required|date');
				$this->form_validation->set_rules('edit_tgl_terima', 'Tgl Terima', 'trim|required|date');
				$this->form_validation->set_rules('edit_pengirim', 'Pengirim', 'trim|required');
				$this->form_validation->set_rules('edit_penerima', 'Penerima', 'trim|required');
				$this->form_validation->set_rules('edit_perihal', 'Perihal', 'trim|required');
				if($this->form_validation->run() == TRUE){
					if($this->surat_model->ubah_surat_masuk() == TRUE){
						$this->session->set_flashdata('notif', 'Ubah Surat Berhasil');
						redirect('surat/surat_masuk');
					}else{
						$this->session->set_flashdata('notif', 'Ubah Surat Gagal!');
						redirect('surat/surat_masuk');

					}
				}else{
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/surat_masuk');
				}
			}
		}else{
			redirect('login');
		}
	}


	public function ubah_surat_keluar()
	{
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				$this->form_validation->set_rules('edit_no_surat', 'NO Surat', 'trim|required');
				$this->form_validation->set_rules('edit_tgl_kirim', 'Tgl Kirim', 'trim|required|date');
				$this->form_validation->set_rules('edit_tujuan', 'Tujuan', 'trim|required');
				$this->form_validation->set_rules('edit_perihal', 'Perihal', 'trim|required');
				if($this->form_validation->run() == TRUE){
					if($this->surat_model->ubah_surat_keluar() == TRUE){
						$this->session->set_flashdata('notif', 'Ubah Surat Berhasil');
						redirect('surat/surat_keluar');
					}else{
						$this->session->set_flashdata('notif', 'Ubah Surat Gagal!');
						redirect('surat/surat_keluar');

					}
				}else{
					$this->session->set_flashdata('notif', validation_errors());
					redirect('surat/surat_keluar');
				}
			}
		}else{
			redirect('login');
		}
	}


	public function ubah_file_surat_masuk(){
		if($this->session->userdata('logged_in') == TRUE){

			if($this->session->userdata('jabatan') == 'Sekretaris'){
					//konfigurasi upload file
				$config['upload_path'] 		= './uploads/';
				$config['allowed_types']	= 'pdf';
				$config['max_size']			= 2000;
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('edit_file_surat')){
					
					if($this->surat_model->ubah_file_surat_masuk($this->upload->data()) == TRUE ){
						$this->session->set_flashdata('notif', 'Ubah file surat berhasil!');
						redirect('surat/surat_masuk');			
					} else {
						$this->session->set_flashdata('notif', 'Ubah file surat gagal!');
						redirect('surat/surat_masuk');		
						/*$this->output->enable_profiler(TRUE);*/	
					}

				} else {
					$this->session->set_flashdata('notif', $this->upload->display_errors());
					redirect('surat/surat_masuk');	
				}
			}
		} else {
			redirect('login');
		}
	}

	public function ubah_file_surat_keluar(){
		if($this->session->userdata('logged_in') == TRUE){

			if($this->session->userdata('jabatan') == 'Sekretaris'){
					//konfigurasi upload file
				$config['upload_path'] 		= './uploads/';
				$config['allowed_types']	= 'pdf';
				$config['max_size']			= 2000;
				$this->load->library('upload', $config);
				
				if ($this->upload->do_upload('edit_file_surat')){
					
					if($this->surat_model->ubah_file_surat_keluar($this->upload->data()) == TRUE ){
						$this->session->set_flashdata('notif', 'Ubah file surat berhasil!');
						redirect('surat/surat_keluar');			
					} else {
						$this->session->set_flashdata('notif', 'Ubah file surat gagal!');
						redirect('surat/surat_keluar');		
						/*$this->output->enable_profiler(TRUE);*/	
					}

				} else {
					$this->session->set_flashdata('notif', $this->upload->display_errors());
					redirect('surat/surat_keluar');	
				}
			}
		} else {
			redirect('login');
		}
	}

	public function hapus_surat_masuk($id_surat)
	{
		if($this->session->userdata('logged_in')== TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				if($this->surat_model->hapus_surat_masuk($id_surat) == TRUE){
					$this->session->set_flashdata('notif', 'berhasil');
					redirect('surat/surat_masuk');
				}else{
					$this->session->set_flashdata('notif', 'gagal');
					redirect('surat/surat_masuk');
				}
			}else{

			}
		}else{
			redirect('login');
		}
	}

	public function hapus_surat_keluar($id_surat)
	{
		if($this->session->userdata('logged_in')== TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				if($this->surat_model->hapus_surat_keluar($id_surat) == TRUE){
					$this->session->set_flashdata('notif', 'berhasil');
					redirect('surat/surat_keluar');
				}else{
					$this->session->set_flashdata('notif', 'gagal');
					redirect('surat/surat_keluar');
				}
			}else{

			}
		}else{
			redirect('login');
		}
	}

	public function disposisi($id_surat)
	{
		if($this->session->userdata('logged_in') == TRUE){
			if($this->session->userdata('jabatan') == 'Sekretaris'){
				$data['main_view'] = 'admin/disposisi_sekretaris';
				$data['data_surat'] = $this->surat_model->get_surat_masuk_by_id($this->uri->segment(3));
				$data['drop_down_jabatan'] = $this->surat_model->get_jabatan();
				$data['data_disposisi'] = $this->surat_model->get_all_disposisi($id_surat);

				$this->load->view('template_view', $data);
			}else{
				$data['main_view'] = 'pegawai/disposisi_masuk';
				$this->load->view('template_view', $data);
			}
		} else{
			redirect('login');
		}
	}

	public function get_pegawai_by_jabatan($id_jabatan)
	{
		if($this->session->userdata('logged_in') == TRUE){
			$data_pegawai = $this->surat_model->get_pegawai_by_jabatan($id_jabatan);

			echo json_encode($data_pegawai);
		}else{
			redirect('login');
		}
	}

	public function tambah_disposisi()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			$this->form_validation->set_rules('tujuan_pegawai', 'Tujuan pegawai', 'trim|required');
			$this->form_validation->set_rules('keterangan','keterangan', 'trim|required');

			if($this->form_validation->run() == TRUE){
				if($this->surat_model->tambah_disposisi($this->uri->segment(3)) == TRUE){
					$this->session->set_flashdata('notif', 'berhasil');
					if($this->session->userdata('jabatan') == 'Sekretaris'){
						redirect('surat/disposisi/'.$this->uri->segment(3));
					}else{
						redirect('surat/disposisi_keluar/'.$this->uri->segment(3));
					}
				}else{
					$this->session->set_flashdata('notif', 'gagal');
					if($this->session->userdata('jabatan') == 'Sekretaris'){
						redirect('surat/disposisi/'.$this->uri->segment(3));
					}else{
						redirect('surat/disposisi_keluar/'.$this->uri->segment(3));
					}
				}
			}else{
				$this->session->set_flashdata('notif', validation_errors());
				if($this->session->userdata('jabatan') == 'Sekretaris'){
					redirect('surat/disposisi/'.$this->uri->segment(3));
				}else{
					redirect('surat/disposisi_keluar/'.$this->uri->segment(3));
				}
			}
		}else{
			redirect('login');
		}
	} 

	public function disposisi_keluar($id_surat)
	{
		if($this->session->userdata('logged_in') == TRUE){
				$data['main_view'] = 'pegawai/disposisi_keluar';
				$data['data_surat'] = $this->surat_model->get_surat_masuk_by_id($id_surat);
				$data['drop_down_jabatan'] = $this->surat_model->get_jabatan();
				$data['data_disposisi'] = $this->surat_model->get_all_disposisi_keluar($this->session->userdata('id_pegawai'));

				$this->load->view('template_view', $data);
				
		} else{
			redirect('login');
		}
	}

	
	public function hapus_disposisi_keluar($id_surat,$id_disposisi)
	{
		if($this->session->userdata('logged_in') == TRUE){
			if($this->surat_model->hapus_disposisi_keluar($id_disposisi) == TRUE){
				$this->session->set_flashdata('notif', 'Hapus disposisi Berhasil!');
				redirect('surat/disposisi_keluar/'. $id_surat);
			} else {
				$this->session->set_flashdata('notif', 'Hapus disposisi Gagal!');
				redirect('surat/disposisi_keluar/'. $id_surat);
			}

		} else {
			redirect('login');
		}
	}

}

/* End of file surat.php */
/* Location: ./application/controllers/surat.php */