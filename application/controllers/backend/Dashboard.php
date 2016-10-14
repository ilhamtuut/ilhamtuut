<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in_admin') != TRUE ){
            $this->session->set_flashdata('notif','LOGIN GAGAL USERNAME ATAU PASSWORD ANDA SALAH !');
            redirect('');
        };
		$this->load->library('template');
		$this->load->model('dashboard/dashboard_admin_model');
		$this->load->model('dashboard/dashboard_produk_model');
		$this->load->model('dashboard/dashboard_ongkir_model');
		$this->load->model('dashboard/dashboard_kategori_model');
		$this->load->helper('currency_format_helper');
		$this->load->helper('text');
		
	}
	function index()
	{
		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
		$data['count']=$this->dashboard_produk_model->count_all();
		$data['judul']='Dashboard';
		$data['jt']='<span class="glyphicon glyphicon-dashboard"></span> Dashboard';
		$data['jd']='';
		$this->template->display('Dashboard/dashboard',$data);
	}
	
	function profile()
	{
		$this->load->model('dashboard/dashboard_admin_model');
		$session=$this->session->userdata('logged_in_admin');
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
		$data['admin']=$this->dashboard_admin_model->get_by_id($session['id_admin'])->row();
		$data['judul']='Profile';
		$data['jt']='<span class="glyphicon glyphicon-user"></span> Profile';
		$data['jd']='';
		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
		$this->template->display('Dashboard/profil',$data);
	}
	
	function pesan_masuk($id)
	{
		
			$this->load->library('table');
			$tmpl = array ( 'table_open'  => '<table class="table">' );
			$this->table->set_template($tmpl);
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('');
			//no tabel
			
				$total=0;
				$no=0;
				$temp_rec = $this->Admin_model->pesanan_masuk_detail($id);
				$num_rows = $temp_rec->num_rows();
				if($num_rows > 0) // jika data ada di database
				{
				//mendapatkan id_transaksi
				$detail=$this->Admin_model->pesanan_masuk_detail($id)->row();
				$asua = $this->Admin_model->asua($id);
				//set tabel class
				
				$nomer = array('data' => 'No', 'class' => 'bg-primary');
				$not = array('data' => 'No Trasaksi', 'class' => 'bg-primary');
				$nama_produk = array('data' => 'Nama Barang', 'class' => 'bg-primary');
				$tanggal = array('data' => 'Tanggal', 'class' => 'bg-info');
				$harga = array('data' => 'Harga', 'class' => 'bg-primary');
				$jumlah = array('data' => 'Jumlah', 'class' => 'bg-primary text-center');
				$tot= array('data' => 'Sub Total', 'class' => 'bg-primary text-center');
				//$tno=array('data' => ++$off, 'class' => 'bg-primary text-center');
				$nama1 = array('data' => '<strong>Nama User</strong>');
				$alamat = array('data' => '<strong>Alamat</strong>');
				$alamat_kirim = array('data' => '<strong>Alamat Kirim</strong>');
				$telp = array('data' => '<strong>Telepon</strong>');
				$email = array('data' => '<strong>Email</strong>');
				$tgl= array('data' => $detail->tgl_pesan, 'class' => 'text-right');
				$alm_krm= array('data' => $detail->alamat_kirim, 'class' => 'text-right');
				//$this->table->add_row($tno,'','','','','');
				$this->table->add_row($nama1,'',$detail->nama,'','','');
				$this->table->add_row($alamat,'',$detail->alamat,'','','');
				$this->table->add_row($alamat_kirim,'',$detail->alamat_kirim,'','','');
				$this->table->add_row($telp,'',$detail->telp,'','','');
				$this->table->add_row($email,'',$detail->email,'','','');
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
 				$this->table->add_row('<strong>Ongkos Kirim</strong> <br>('.$detail->kota.')','','','','',$ok);
 				$this->table->add_row('<strong>Total</strong>','','','','',$tb);
				$this->table->add_row('<strong>Status</strong>','','','','',$st);
				$this->table->add_row('','','','','','');
		//Update
			$data=array(
				'baca'			=> 'Y'
				);
			$this->Admin_model->update($id,$data);
			}
		else // jika data kosong
		{
			redirect('dashboard');
		}
			
		$session=$this->session->userdata('logged_in_admin');
		$data['admin']=$this->dashboard_admin_model->get_by_id($session['id_admin'])->row();
		$data['judul']='Pesanan Masuk';
		$data['jt']='<span class="glyphicon glyphicon-shopping-cart"></span> Pesanan Masuk';
		$data['jd']='';
		$data['table']=$this->table->generate();
		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk']=$this->Admin_model->pesanan_masuk();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
		$data['pesanan_masuk_detail']=$this->Admin_model->pesanan_masuk_detail($id);
		$this->template->display('Dashboard/pesan_masuk',$data);
		
	}
	function lihat_semua()
	{
		$session=$this->session->userdata('logged_in_admin');
		$data['admin']=$this->dashboard_admin_model->get_by_id($session['id_admin'])->row();
		$data['judul']='Pemberitahuan';
		$data['jt']='<span class="glyphicon glyphicon-globe"></span> Lihat Semua Pemberitahuan';
		$data['jd']='';
		$data['banyak']=$this->Admin_model->countl()->num_rows();
		$data['banyaks']=$this->Admin_model->countls()->num_rows();
		$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
		$data['pesanan_masuk']=$this->Admin_model->pesanan_masuk();
		$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
		$this->template->display('Dashboard/lihat_semua',$data);
	}
	
	function update_profile()
	{
		$this->_set_rules_profile();
		//run validation
		if($this->form_validation->run()===FALSE)
		{
			$data['message']='';
			redirect('Dashboard/profile/update_gagal');
		}
		else
		{
			//save data
			$id_admin=$this->input->post('id_admin');
			$admin=array(
				'nama'=>$this->input->post('nama'),
				'alamat'=>$this->input->post('alamat'),
				'email'=>$this->input->post('email'),
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password'))
				);
			$this->dashboard_admin_model->update($id_admin,$admin);
			redirect('dashboard/profile/update_success');
		}
	}
	function _set_rules_profile(){
		
		$this->form_validation->set_rules('nama','nama','required|trim');
		$this->form_validation->set_rules('alamat','alamat','required|trim');
		$this->form_validation->set_rules('email','Email','trim|required|valid_emal');
		$this->form_validation->set_rules('username','Username','trim|required|min_length[4]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[16]');
		$this->form_validation->set_rules('password2','Konfirmasi Password','trim|required|matches[password]');
	}
	
	function logout(){
		$this->session->unset_userdata('logged_in_admin');
		//$this->session->unset_userdata('id_admin');
		//$this->session->unset_userdata('username');
		//$this->session->sess_destroy();
		
		redirect('admin','refresh');
	}
	
}