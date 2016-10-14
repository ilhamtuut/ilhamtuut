<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller{
	private $limit=5;
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in_admin') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
		$this->load->library('template');
		$this->load->model('dashboard/dashboard_kategori_model');
	}
	function index($offset=0)
	{
		if (empty($offset)) $offset=0;

		//generate pagination
		$this->load->library('pagination');
		$config['base_url']=site_url('kategori/index');
		$config['total_rows']=$this->dashboard_kategori_model->count_all();
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
		$data['judul']='Kategori';
		$data['jt']='<span class="glyphicon glyphicon-tag"></span> Daftar Kategori';
		$data['jd']='';
		$data['kategoris']=$this->dashboard_kategori_model->get_last_ten_kategori($this->limit,$offset);
		$this->template->display('dashboard/kategori/kategori',$data);
		
	}
	function delete($id)
	{
		$this->dashboard_kategori_model->delete($id);
		redirect('kategori/index/delete_success','refresh');
	}
	function view($id)
	{
		//set common propertis
		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();	
		$data['judul']='View';
		$data['jt']='<span class="glyphicon glyphicon-eye-open"></span> View';
		$data['jd']='';
		$data['link_back']=anchor('kategori','Lihat Daftar Kategori',array('class'=>'back'));
		
		$temp_rec = $this->dashboard_kategori_model->get_by_id($id);
		$num_rows = $temp_rec->num_rows();
		if($num_rows > 0) // jika data ada di database
		{
			//get siswa details
			$data['kategori']=$this->dashboard_kategori_model->get_by_id($id)->row();
			// load view
			$this->template->display('dashboard/kategori/view',$data);
		}
		else // jika data kosong
		{
			redirect('kategori');
		}
	}
	function tambah()
	{
		$this->_set_rules();

		//run validation
		if($this->form_validation->run()===FALSE)
		{
			//set common propertis
			$data['message']='';
			$data['kategori']['nama']='';

			redirect('kategori/index/add_gagal');
		}
		else
		{
			//save data
			$kategori=array(
				'nama'=>$this->input->post('nama')
				);
			$id=$this->dashboard_kategori_model->save($kategori);
			
			//set form input nama
			$this->validation->id=$id;

			redirect('kategori/index/add_success');
		}
	}
	function update()
	{
		$this->_set_rules();
		//run validation
		if($this->form_validation->run()===FALSE)
		{
			$data['message']='';
			redirect('kategori/index/update_gagal');
		}
		else
		{
			//save data
			$id_kategori=$this->input->post('id_kategori');
			$kategori=array(
				'nama'=>$this->input->post('nama')
				);
			$this->dashboard_kategori_model->update($id_kategori,$kategori);
			redirect('kategori/index/update_success');
		}
	}
	function _set_rules(){
		//$this->form_validation->set_rules('kota','Kategori','required|trim');
		$this->form_validation->set_rules('nama','nama','required|trim');
	}


}