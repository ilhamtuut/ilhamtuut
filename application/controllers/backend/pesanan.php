<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Pesanan extends CI_Controller{
	private $limit=5;
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in_admin') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
		$this->load->library('template');
		$this->load->model('dashboard/dashboard_user_model');
		$this->load->model('dashboard/dashboard_pesanan_model');
		$this->load->model('Admin_model');
	}
	function index($offset=0)
	{
		if (empty($offset)) $offset=0;
			//$data['belanja'] = $this->User_model->belanja();
			
			//mendapatkan banyak row denga parameter
			$gb=$this->Admin_model->gb($this->limit,$offset)->num_rows();
			
			//total row
			$lm=$this->Admin_model->countl()->num_rows();
			$lms=$this->Admin_model->countls()->num_rows();
			//pagination
			$this->load->library('pagination');

			$config['base_url'] = site_url('pesanan/index');;
			$config['uri_segment'] = 3;
			$config['total_rows'] = $lm;
			$config['per_page'] = $this->limit;
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
			//loop tabel sebnyak row
			$this->load->library('table');
			$tmpl = array ( 'table_open'  => '<table class="table">' );
			$this->table->set_template($tmpl);
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('');
			//no tabel
			$off=0+$offset;
			for ($i=0; $i < $gb; $i++) {
				$total=0;
				$no=0;
				//mendapatkan id_transaksi
				$it=$this->Admin_model->gb($this->limit,$offset)->row($i)->id_transaksi;
				$asua = $this->Admin_model->asua($it);
				$asua1 = $this->Admin_model->asua1($it)->row();
				//set tabel class
				$nomer = array('data' => 'No', 'class' => 'bg-primary');
				$not = array('data' => 'No Trasaksi', 'class' => 'bg-primary');
				$nama_produk = array('data' => 'Nama Barang', 'class' => 'bg-primary');
				$tanggal = array('data' => 'Tanggal', 'class' => 'bg-info');
				$harga = array('data' => 'Harga', 'class' => 'bg-primary');
				$jumlah = array('data' => 'Jumlah', 'class' => 'bg-primary text-center');
				$tot= array('data' => 'Sub Total', 'class' => 'bg-primary text-center');
				$tno=array('data' => ++$off, 'class' => 'bg-primary text-center');
				$nama = array('data' => '<strong>Nama User</strong>');
				$alamat = array('data' => '<strong>Alamat</strong>');
				$alamat_kirim = array('data' => '<strong>Alamat Kirim</strong>');
				$telp = array('data' => '<strong>Telepon</strong>');
				$email = array('data' => '<strong>Email</strong>');
				$tgl= array('data' => $asua1->tgl_pesan, 'class' => 'text-right');
				$this->table->add_row($tno);
				$this->table->add_row($nama,'',$asua1->nama,'','','');
				$this->table->add_row($alamat,'',$asua1->alamat,'','','');
				$this->table->add_row($alamat_kirim,'',$asua1->alamat_kirim,'','','');
				$this->table->add_row($telp,'',$asua1->telp,'','','');
				$this->table->add_row($email,'',$asua1->email,'','','');
				$this->table->add_row('','','','',$tanggal,$tgl);
				
				$this->table->add_row($nomer,$not,$nama_produk,$harga,$jumlah,$tot);
				foreach ($asua as $asua) {
					
					$th= array('data' => $asua->tot_harga, 'class' => 'text-center');
					$jml= array('data' => $asua->jumlah, 'class' => 'text-center');
					$this->table->add_row(++$no,$asua->id_transaksi,$asua->nama_produk,$asua->harga,$jml,$th);
					$total +=$asua->tot_harga;

 				}
				if($asua->status =='Tunggu') { 
					$Tunggu='background-color:#c9302c;font-weight: 900;';
				  } else {
				    $Tunggu='background-color:rgb(48, 194, 48);font-weight: 900;';
				  }
				$kt= array('data' => $asua->kota, 'class' => 'text');  
				$ok= array('data' => $asua->biaya, 'class' => 'text-center');
				$tb= array('data' => $total+$asua->biaya.'.00', 'class' => 'text-center');
				$st= array('data' => $asua->status, 'class' => 'sts text-center bg-primary','style'=>$Tunggu);
 				$this->table->add_row('<strong>Ongkos Kirim</strong> <br>('.$asua->kota.')','','','','',$ok);
 				$this->table->add_row('<strong>Total</strong>','','','','',$tb);
				$this->table->add_row('<strong>Status</strong>','','','','<a class="btn btn-warning btn-xs" href="#modalEditStatus'.$asua->id_transaksi.'" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>',$st);
				$this->table->add_row('','','','','','');
				
			}
				$data['banyak']=$lm;
				$data['banyaks']=$lms;
				$data['table']=$this->table->generate();
				$data['offset']=$offset;
				$data['judul']='Pesanan';
				$data['jt']='<span class="glyphicon glyphicon-shopping-cart"></span> Daftar Pesanan Masuk';
				$data['jd']='';
				$data['pesanans']=$this->dashboard_pesanan_model->get_last_ten_pesanan($this->limit,$offset);
				$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
				$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
				$this->template->display('dashboard/pesanan/pesanan',$data);
		
	}
	
	function pesanan_selesai($offset=0)
	{
		if (empty($offset)) $offset=0;
			//$data['belanja'] = $this->User_model->belanja();
			
			//mendapatkan banyak row denga parameter
			$gb=$this->Admin_model->gbs($this->limit,$offset)->num_rows();
			
			//total row
			$lm=$this->Admin_model->countl()->num_rows();
			$lms=$this->Admin_model->countls()->num_rows();
			//pagination
			$this->load->library('pagination');

			$config['base_url'] = site_url('pesanan/pesanan_selesai');;
			$config['uri_segment'] = 3;
			$config['total_rows'] = $lms;
			$config['per_page'] = $this->limit;
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
			//loop tabel sebnyak row
			$this->load->library('table');
			$tmpl = array ( 'table_open'  => '<table class="table">' );
			$this->table->set_template($tmpl);
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('');
			//no tabel
			$off=0+$offset;
			for ($i=0; $i < $gb; $i++) {
				$total=0;
				$no=0;
				//mendapatkan id_transaksi
				$it=$this->Admin_model->gbs($this->limit,$offset)->row($i)->id_transaksi;
				$asua = $this->Admin_model->asua($it);
				$asua1 = $this->Admin_model->asua1($it)->row();
				//set tabel class
				$nomer = array('data' => 'No', 'class' => 'bg-primary');
				$not = array('data' => 'No Trasaksi', 'class' => 'bg-primary');
				$nama_produk = array('data' => 'Nama Barang', 'class' => 'bg-primary');
				$tanggal = array('data' => 'Tanggal', 'class' => 'bg-info');
				$harga = array('data' => 'Harga', 'class' => 'bg-primary');
				$jumlah = array('data' => 'Jumlah', 'class' => 'bg-primary text-center');
				$tot= array('data' => 'Sub Total', 'class' => 'bg-primary text-center');
				$tno=array('data' => ++$off, 'class' => 'bg-primary text-center');
				$nama = array('data' => '<strong>Nama User</strong>');
				$alamat = array('data' => '<strong>Alamat</strong>');
				$alamat_kirim = array('data' => '<strong>Alamat Kirim</strong>');
				$telp = array('data' => '<strong>Telepon</strong>');
				$email = array('data' => '<strong>Email</strong>');
				$tgl= array('data' => $asua1->tgl_pesan, 'class' => 'text-right');
				$this->table->add_row($tno);
				$this->table->add_row($nama,'',$asua1->nama,'','','');
				$this->table->add_row($alamat,'',$asua1->alamat,'','','');
				$this->table->add_row($alamat_kirim,'',$asua1->alamat_kirim,'','','');
				$this->table->add_row($telp,'',$asua1->telp,'','','');
				$this->table->add_row($email,'',$asua1->email,'','','');
				$this->table->add_row('','','','',$tanggal,$tgl);
				
				$this->table->add_row($nomer,$not,$nama_produk,$harga,$jumlah,$tot);
				foreach ($asua as $asua) {
					
					$th= array('data' => $asua->tot_harga, 'class' => 'text-center');
					$jml= array('data' => $asua->jumlah, 'class' => 'text-center');
					$this->table->add_row(++$no,$asua->id_transaksi,$asua->nama_produk,$asua->harga,$jml,$th);
					$total +=$asua->tot_harga;

 				}
				if($asua->status =='Tunggu') { 
					$Tunggu='background-color:#c9302c;font-weight: 900;';
				  } else {
				    $Tunggu='background-color:rgb(48, 194, 48);font-weight: 900;';
				  }
				$kt= array('data' => $asua->kota, 'class' => 'text');  
				$ok= array('data' => $asua->biaya, 'class' => 'text-center');
				$tb= array('data' => $total+$asua->biaya.'.00', 'class' => 'text-center');
				$st= array('data' => $asua->status, 'class' => 'sts text-center bg-primary','style'=>$Tunggu);
 				$this->table->add_row('<strong>Ongkos Kirim</strong> <br>('.$asua->kota.')','','','','',$ok);
 				$this->table->add_row('<strong>Total</strong>','','','','',$tb);
				$this->table->add_row('<strong>Status</strong>','','','','<a class="btn btn-warning btn-xs" href="#modalEditStatus'.$asua->id_transaksi.'" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Edit</a>',$st);
				$this->table->add_row('','','','','','');
				
			}
				$data['banyak']=$lm;
				$data['banyaks']=$lms;
				$data['table']=$this->table->generate();
				$data['offset']=$offset;
				$data['judul']='Pesanan';
				$data['jt']='<span class="glyphicon glyphicon-shopping-cart"></span> Daftar Pesanan Selesai';
				$data['jd']='';
				$data['pesanans']=$this->dashboard_pesanan_model->get_last_ten_pesanan($this->limit,$offset);
				$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
				$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
				$this->template->display('dashboard/pesanan/pesanan',$data);
		
	}
	
	function update()
	{
		$this->_set_rules();
		//run validation
		if($this->form_validation->run()===FALSE)
		{
			$data['message']='';
			redirect('pesanan/index/update_gagal');
		}
		else
		{
			//save data
			$id_transaksi=$this->input->post('id_transaksi');
			$status=array(
				'status'=>$this->input->post('status')
				);
			$this->Admin_model->update($id_transaksi,$status);
			redirect('pesanan/index/update_success');
		}
	}
	function _set_rules(){
		//$this->form_validation->set_rules('kota','Kategori','required|trim');
		$this->form_validation->set_rules('status','status','required|trim');
	}

}