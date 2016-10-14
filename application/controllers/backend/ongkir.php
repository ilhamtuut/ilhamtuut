<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Ongkir extends CI_Controller{
	private $limit=5;
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in_admin') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
		$this->load->library('template');
		$this->load->model('dashboard/dashboard_ongkir_model');
		$this->load->helper('currency_format_helper');
	}
	function index($offset=0)
	{
		if (empty($offset)) $offset=0;

		//generate pagination
		$this->load->library('pagination');
		$config['base_url']=site_url('ongkir/index');
		$config['total_rows']=$this->dashboard_ongkir_model->count_all();
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
			$data['message']='<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Data Gagal Disimpan</p>';
		else if($this->uri->segment(3)=='update_gagal')
			$data['message']='<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> Data Gagal Diubah</p>';
		else
			$data['message']='';

		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
		$data['offset']=$offset;
		$data['judul']='Ongkos Kirim';
		$data['jt']='<span class="glyphicon glyphicon-usd"></span>Daftar Ongkos Kirim';
		$data['jd']='';
		$data['ongkirs']=$this->dashboard_ongkir_model->get_last_ten_ongkir($this->limit,$offset);
		$this->template->display('dashboard/ongkir/ongkir',$data);

		
	}
	function delete($id)
	{
		$this->dashboard_ongkir_model->delete($id);
		redirect('ongkir/index/delete_success','refresh');
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
		$data['link_back']=anchor('ongkir','Lihat Daftar Ongkos Kirim',array('class'=>'back'));
		
		$temp_rec = $this->dashboard_ongkir_model->get_by_id($id);
		$num_rows = $temp_rec->num_rows();
		if($num_rows > 0) // jika data ada di database
		{
		//get siswa details
		$data['ongkir']=$this->dashboard_ongkir_model->get_by_id($id)->row();
		// load view
		$this->template->display('dashboard/ongkir/view',$data);
		}
		else // jika data kosong
		{
		  redirect('ongkir');
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
			$data['ongkir']['kota']='';
			$data['ongkir']['biaya']='';
			
			//$this->template->display('dashboard/sidebar/produk',$data);
			redirect('ongkir/index/add_gagal');
		}
		else
		{
			//save data
			$ongkir=array(
				'kota'=>$this->input->post('kota'),
				'biaya'=>$this->input->post('biaya')
				);
			$id=$this->dashboard_ongkir_model->save($ongkir);
			
			//set form input nama
			$this->validation->id=$id;

			redirect('ongkir/index/add_success');
		}
	}
	function update()
	{
		$this->_set_rules();
		//run validation
		if($this->form_validation->run()===FALSE)
		{
			$data['message']='';
			redirect('ongkir/index/update_gagal');
		}
		else
		{
			//save data
			$id_ongkir=$this->input->post('id_ongkir');
			$ongkir=array(
				'kota'=>$this->input->post('kota'),
				'biaya'=>$this->input->post('biaya')
				);
			$this->dashboard_ongkir_model->update($id_ongkir,$ongkir);
			redirect('ongkir/index/update_success');
		}
	}
	function _set_rules(){
		$this->form_validation->set_rules('kota','Kategori','required|trim');
		$this->form_validation->set_rules('biaya','nama','required|trim');
	}

}