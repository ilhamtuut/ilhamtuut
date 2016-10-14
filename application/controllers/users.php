<?php
class Users extends CI_Controller{
	private $limit=5;
	function __construct(){
	parent::__construct();
	
	$this->load->library('fpdf/fpdf'); // load librari fpdf di folder aplication fpdf
	}
	public function register(){
		//Validation Rules
		$this->form_validation->set_rules('nama','Nama Lengkap','trim|required|max_length[30]|min_length[2]');
		$this->form_validation->set_rules('notelp','No Telp','trim|required|max_length[12]|min_length[2]');
		$this->form_validation->set_rules('alamat','Alamat','trim|required|max_length[300]|min_length[2]');
		$this->form_validation->set_rules('kota','Kota','trim|required|max_length[20]|min_length[2]');
		//$this->form_validation->set_rules('email','Email','trim|required|valid_emal');
		$this->form_validation->set_rules('username','Username','trim|required|min_length[4]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[16]');
		$this->form_validation->set_rules('password2','Konfirmasi Password','trim|required|matches[password]');

		
		if ($this->form_validation->run() == FALSE){
			//Show view
			$this->load->model('User_model');		
			$data['album'] = $this->User_model->getalbums();
			$data['main_content'] = 'register';
			$this->load->view('layouts/main', $data);
		}
		else{
			if($this->User_model->register()){
			$this->session->set_flashdata('registered', 'Registrasi sukses silahkan login');
			redirect('produks');
			}
		}
		//combobox
	}
	
	public function login(){
		$this->form_validation->set_rules('username','Username','trim|required|min_length[4]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[16]');
	
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		$user_id = $this->User_model->login($username, $password);
		//Validate user
		if($user_id){
			//Create array of user data
			$data = array(
				'id_user' 	=> $user_id,
				'username'	=> $username,
				'logged_in' => true
			);
			//Set sesion userdata
			$this->session->set_userdata($data);
			
			//Set message
			$this->session->set_flashdata('pass_login', 'Anda Telah Berhasil Login, Selamat Berbelanja ');
			redirect('produks');
		} else {
			//Set error
			$this->session->set_flashdata('fail_login', 'Anda Gagal Login, Silahkan Buat Akun atau Coba Lagi !!!');
			redirect('produks');
		}
	}
		
	public function logout(){
		$this->session->unset_userdata('logged_in');
		//$this->session->unset_userdata('id_user');
		//$this->session->unset_userdata('username');
		//$this->session->sess_destroy();
		redirect('produks');
		}
		
	public function caraorder(){
		$this->load->model('dashboard/dashboard_cara_model');
		$data['cara']=$this->dashboard_cara_model->get();
		$data['main_content'] = 'caraorder';
		$this->load->view('layouts/main', $data);
	}
	
	public function carabayar(){
		$this->load->model('dashboard/dashboard_cara_model');
		$data['cara']=$this->dashboard_cara_model->get();
		$data['main_content'] = 'carabayar';
		$this->load->view('layouts/main', $data);
	}
	
	public function kontak(){
		if($this->uri->segment(3)=='add_success')
			$data['message']='<p class="alert alert-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Pesan Berhasil Dikirim</p>';
		else if($this->uri->segment(3)=='add_gagal')
			$data['message']='<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Pesan Gagal Dikirim</p>';
		else
			$data['message']='';

		$data['main_content'] = 'kontak';
		$this->load->view('layouts/main', $data);
	}
	
	function tambah()
	{
		$this->form_validation->set_rules('nama','Nama Lengkap','trim|required|max_length[30]|min_length[2]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_emal');
		$this->form_validation->set_rules('pesan','Pesan','required|trim');

		//run validation
		if($this->form_validation->run()===FALSE)
		{
			redirect('users/kontak/add_gagal');
		}
		else
		{
			//save data
			$pesan=array(
				'nama'=>$this->input->post('nama'),
				'email'=>$this->input->post('email'),
				'pesan'=>$this->input->post('pesan')
				);
			$id=$this->Pesan_model->save($pesan);
			
			//set form input nama
			$this->validation->id=$id;

			redirect('users/kontak/add_success');
		}
	}
	
	public function belanja($offset=0){
		$session=$this->session->userdata('logged_in');
		if($session!=""){
			if (empty($offset)) $offset=0;
			//$data['belanja'] = $this->User_model->belanja();
			$data['dbelanja'] = $this->User_model->get_user();
			//mendapatkan banyak row denga parameter
			$gb=$this->User_model->gb($this->limit,$offset)->num_rows();
			//total row
			$lm=$this->User_model->count_all()->num_rows();
			//pagination
			$this->load->library('pagination');

			$config['base_url'] = site_url('users/belanja/');;
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

			if($this->uri->segment(3)=='update_success')
				$data['message']='<p class="alert alert-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Data Berhasil Diubah</p>';
			else if($this->uri->segment(3)=='update_gagal')
				$data['message']='<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Data Gagal Diubah</p>';
			else
				$data['message']='';
			
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
				$it=$this->User_model->gb($this->limit,$offset)->row($i)->id_transaksi;
				$asua = $this->User_model->asua($it);
				$asua1 = $this->User_model->asua1($it)->row();
				//set tabel class
				$nomer = array('data' => 'No', 'class' => 'bg-primary');
				$not = array('data' => 'No Trasaksi', 'class' => 'bg-primary');
				$nama = array('data' => 'Nama Barang', 'class' => 'bg-primary');
				$tanggal = array('data' => 'Tanggal', 'class' => 'bg-info');
				$harga = array('data' => 'Harga', 'class' => 'bg-primary');
				$jumlah = array('data' => 'Jumlah', 'class' => 'bg-primary text-center');
				$tot= array('data' => 'Sub Total', 'class' => 'bg-primary text-center');
				$alm= array('data' => 'Alamat Kirim', 'class' => 'bg-info');
				$tno=array('data' => ++$off, 'class' => 'bg-info text-center');
				$tgl= array('data' => $asua1->tgl_pesan, 'class' => 'text-right');
				$alm_krm= array('data' => $asua1->alamat_kirim, 'class' => 'text-right');
				$this->table->add_row($tno,'','','','','<a href="'.base_url().'laporan/cetak/'.$asua1->id_transaksi.'" target="_blank"><span class="glyphicon glyphicon-print pull-right"></span></a>');
				$this->table->add_row($tanggal,$tgl,'','','','');
				$this->table->add_row($alm,$alm_krm,'','','','');
				$this->table->add_row($nomer,$not,$nama,$harga,$jumlah,$tot);
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
				$this->table->add_row('<strong>Status</strong>','','','','',$st);
				$this->table->add_row('','','','','','');
				
			}
				$data['banyak']=$lm;
				$data['table']=$this->table->generate();
				$data['main_content'] = 'belanja';
				$this->load->view('layouts/main', $data);
		} else {
			//Set error
			redirect('produks');
		}
	}
	
	public function ongkir(){
		//Get category Details
		$data['ongkir'] = $this->Produk_model->get_detail_ongkir();
		
		//Load View
		$data['main_content'] = 'ongkir';
		$this->load->view('layouts/main', $data);
	}
	
	function update_user()
	{
		$this->_set_rules_user();
		//run validation
		if($this->form_validation->run()===FALSE)
		{
			$data['message']='';
			redirect('users/belanja/update_gagal');
		}
		else
		{
			//save data
			$id_user=$this->input->post('id_user');
			$user=array(
				'nama'=>$this->input->post('nama'),
				'alamat'=>$this->input->post('alamat'),
				'telp'=>$this->input->post('telp'),
				'email'=>$this->input->post('email'),
				);
			$this->User_model->update($id_user,$user);
			redirect('users/belanja/update_success');
		}
	}
	
	function update_pass()
	{
		$this->_set_rules_pass();
		//run validation
		if($this->form_validation->run()===FALSE)
		{
			$data['message']='';
			redirect('users/belanja/update_gagal');
		}
		else
		{
			//save data
			$id_user=$this->input->post('id_user');
			$user=array(
				'username'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password'))
				);
			$this->User_model->update($id_user,$user);
			redirect('users/belanja/update_success');
		}
	}
	function _set_rules_user(){
		$this->form_validation->set_rules('nama','Nama','required|trim');
		$this->form_validation->set_rules('alamat','Alamat','required|trim');
		$this->form_validation->set_rules('telp','Telepon','required|trim');
		$this->form_validation->set_rules('email','Email','trim|required|valid_emal');
	}
	function _set_rules_pass(){
		$this->form_validation->set_rules('username','Username','trim|required|min_length[4]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[4]|max_length[16]');
		$this->form_validation->set_rules('password2','Konfirmasi Password','trim|required|matches[password]');
	}
}
