<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller{
	private $limit=5;
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in_admin') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
		$this->load->library('template');
		$this->load->model('dashboard/dashboard_produk_model');
		$this->load->helper('currency_format_helper');
		$this->load->helper('text');
	}
	function index($offset=0)
	{
		if (empty($offset)) $offset=0;

		//generate pagination
		$this->load->library('pagination');
		$config['base_url']=site_url('produk/index/');
		$config['total_rows']=$this->dashboard_produk_model->count_all();
		$config['per_page']=$this->limit;
		$config['uri_segmen']=3;
		//set tag html pagination
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><span>';
		$config['cur_tag_close'] = ' </span></li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();

		if($this->uri->segment(3)=='delete_success')
			$data['message']='<p class="alert alert-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Data Berhasil Dihapus</p>';
		else if($this->uri->segment(3)=='add_success')
			$data['message']='<p class="alert alert-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Data Berhasil Disimpan</p>';
		else if($this->uri->segment(3)=='update_success')
			$data['message']='<p class="alert alert-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Data Berhasil Diubah</p>';
		else if($this->uri->segment(3)=='add_gagal')
			$data['message']='<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Data Gagal Disimpan</p>';
		else if($this->uri->segment(3)=='update_gagal')
			$data['message']='<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Data Gagal Diubah</p>';
		else
			$data['message']='';

		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();		
		$data['offset']=$offset;
		$data['judul']='Produk';
		$data['jt']='<span class="glyphicon glyphicon-barcode"></span> Daftar Produk';
		$data['jd']='';
		$data['produks']=$this->dashboard_produk_model->get_last_ten_produk($this->limit,$offset);
		$this->template->display('dashboard/produk/produk',$data);
	}
	
	function delete($id)
	{
		$photo = $this->dashboard_produk_model->delete_poto($id);
		if($photo->num_rows()>0){
			$row = $photo->row();
			$file_photo = $row->gambar;
			$path_file = './assets/images/produks/';
			unlink($path_file.$file_photo);
		}
		$this->dashboard_produk_model->delete($id);
		redirect('produk/index/delete_success','refresh');
	}
	function view($id){
		//set common propertis
		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();	
		$data['judul']='View';
		$data['jt']='<span class="glyphicon glyphicon-eye-open"></span> View';
		$data['jd']='';
		$data['link_back']=anchor('produk','Lihat Daftar Produk',array('class'=>'back'));
		
		$temp_rec = $this->dashboard_produk_model->get_by_id($id);
		$num_rows = $temp_rec->num_rows();
		if($num_rows > 0) // jika data ada di database
		{
		//get siswa details
		$data['produk']=$this->dashboard_produk_model->get_by_id($id)->row();
		// load view
		$this->template->display('dashboard/produk/view',$data);
		}
		else // jika data kosong
		{
		  redirect('produk');
		}
	}
	function tambah()
	{
		$this->_set_rules();

		//run validation
		if($this->form_validation->run()===FALSE){
			redirect('produk/index/add_gagal');
		}else{
			$config['upload_path'] = './assets/images/produks';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '300';
			$config['max_width']  = '2000';
			$config['max_height']  = '2000';

			$this->load->library('upload', $config);
			//$this->do_upload();
			if ( ! $this->upload->do_upload())
				{
					redirect('produk/index/add_gagal');
				}else {
			
					$upload_data = $this->upload->data();
					//save data
					$produk=array(
						'id_kategori'=>$this->input->post('id_kategori'),
						'nama_produk'=>$this->input->post('nama_produk'),
						'deskripsi'=>$this->input->post('deskripsi'),
						'gambar'=>$upload_data['file_name'],
						'harga'=>$this->input->post('harga'),
						);
					$id=$this->dashboard_produk_model->save($produk);
					//set form input nama
					$this->validation->id=$id;
					redirect('produk/index/add_success');
				}
		}
	}
	function update()
	{
		$this->_set_rules();
		//run validation
		if($this->form_validation->run()===FALSE){
			redirect('produk/index/update_gagal');
		}else{
			if($_FILES['userfile']['nama_produk'] != ''){
				//form submit dengan gambar diisi
				//load uploading file library
				$config['upload_path'] = './assets/images/produks';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '300'; //MB
				$config['max_width']  = '2000'; //pixels
				$config['max_height']  = '2000'; //pixels

				$this->load->library('upload', $config);
			
				if ( ! $this->upload->do_upload())
				{
					redirect('produk/index/update_gagal');
				} else {
					//$this->do_upload();
					$upload_data = $this->upload->data();
					//save data
					$id_produk=$this->input->post('id_produk');
					$produk=array(
						'id_kategori'=>$this->input->post('id_kategori'),
						'nama_produk'=>$this->input->post('nama_produk'),
						'deskripsi'=>$this->input->post('deskripsi'),
						'gambar'=>$upload_data['file_name'],
						'harga'=>$this->input->post('harga'),
						);
					$this->dashboard_produk_model->update($id_produk,$produk);
					redirect('produk/index/update_success');
				}
			} else {
				//form submit dengan gambar dikosongkan
				$id_produk=$this->input->post('id_produk');
				$produk=array(
					'id_kategori'=>$this->input->post('id_kategori'),
					'nama_produk'=>$this->input->post('nama_produk'),
					'deskripsi'=>$this->input->post('deskripsi'),
					'harga'=>$this->input->post('harga'),
					);
				$this->dashboard_produk_model->update($id_produk,$produk);
				redirect('produk/index/update_success');
			}
		}
	}
	function _set_rules(){
		$this->form_validation->set_rules('id_kategori','Kategori','required|trim');
		$this->form_validation->set_rules('nama_produk','nama','required|trim');
		$this->form_validation->set_rules('deskripsi','Deskripsi','required|trim');
		//$this->form_validation->set_rules('gambar','Gambar','required');
		$this->form_validation->set_rules('harga','Harga','required');
	}
	
}