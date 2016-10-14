<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Konten extends CI_Controller{
	private $limit=5;
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in_admin') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
		$this->load->library('template');
		$this->load->model('dashboard/dashboard_cara_model');
	}
	
	function pemesanan()
	{
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
		$data['cara']=$this->dashboard_cara_model->get();
		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
		$data['judul']='Pemesanan';
		$data['jt']='<span class="glyphicon glyphicon-th"></span> Cara Pemesanan';
		$data['jd']='';
		$this->template->display('dashboard/pemesanan',$data);
	}
	
	function update_pesan()
	{
		$this->_set_rules();
		//run validation
		if($this->form_validation->run()===FALSE)
		{
			$data['message']='';
			redirect('konten/pemesanan/update_gagal');
		}
		else
		{
			//save data
			$id=$this->input->post('id');
			$pesan=array(
				'cara_pesan'=>$this->input->post('cara_pesan')
				);
			$this->dashboard_cara_model->update($id,$pesan);
			redirect('konten/pemesanan/update_success');
		}
	}
	function _set_rules(){
		//$this->form_validation->set_rules('kota','Kategori','required|trim');
		$this->form_validation->set_rules('cara_pesan','cara_pesan','required|trim');
	}
	
	function pembayaran()
	{
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
		$data['cara']=$this->dashboard_cara_model->get();
		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
		$data['judul']='Pembayaran';
		$data['jt']='<span class="glyphicon glyphicon-usd"></span> Cara Pembayaran';
		$data['jd']='';
		$this->template->display('dashboard/pembayaran',$data);
	}
	
	function update_bayar()
	{
		$this->_set_rules2();
		//run validation
		if($this->form_validation->run()===FALSE)
		{
			$data['message']='';
			redirect('konten/pembayaran/update_gagal');
		}
		else
		{
			//save data
			$id=$this->input->post('id');
			$bayar=array(
				'cara_bayar'=>$this->input->post('cara_bayar')
				);
			$this->dashboard_cara_model->update($id,$bayar);
			redirect('konten/pembayaran/update_success');
		}
	}
	function _set_rules2(){
		//$this->form_validation->set_rules('kota','Kategori','required|trim');
		$this->form_validation->set_rules('cara_bayar','cara_bayar','required|trim');
	}
	function pesan($offset=0)
	{
		if (empty($offset)) $offset=0;

		//generate pagination
		$this->load->library('pagination');
		$config['base_url']=site_url('konten/pesan');
		$config['total_rows']=$this->Pesan_model->count_all();
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
		$data['cara']=$this->dashboard_cara_model->get();
		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
		$data['pesan'] = $this->Pesan_model->get();
		$data['offset']=$offset;
		$data['judul']='Pesan';
		$data['jt']='<span class="glyphicon glyphicon-envelope"></span> Daftar Pesan';
		$data['jd']='';
		$data['pesans']=$this->Pesan_model->get_last_ten($this->limit,$offset);
		$this->template->display('dashboard/pesan',$data);
	}
	function delete($id)
	{
		$this->Pesan_model->delete($id);
		redirect('konten/pesan/delete_success','refresh');
	}
}