<?php
class Admin extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('template');
		$this->load->model('dashboard/dashboard_admin_model');
		$this->load->model('dashboard/dashboard_produk_model');
		$this->load->model('dashboard/dashboard_ongkir_model');
		$this->load->model('dashboard/dashboard_kategori_model');
		$this->load->helper('currency_format_helper');
		$this->load->helper('text');
		
	}
	public function index(){
		if($this->session->userdata('logged_in_admin')) {
				
				$data['count']=$this->dashboard_produk_model->count_all();
				$data['banyak']=$this->Admin_model->countl()->num_rows();
				$data['banyaks']=$this->Admin_model->countls()->num_rows();
				$data['pesan_masuk']=$this->Admin_model->count_pesan_masuk()->num_rows();
				$data['pesanan_masuk2']=$this->Admin_model->pesanan_masuk2();
				$data['judul']='Dashboard';
				$data['jt']='<span class="glyphicon glyphicon-dashboard"></span> Dashboard';
				$data['jd']='';
				
				$this->template->display('Dashboard/Dashboard',$data);
            }
            else {
                //Jika tidak ada session di kembalikan ke halaman login
                $this->load->view('dashboard/login', 'refresh');
            }
	}
	
	function aksilogin(){
		
        //validasi field terhadap database
        $username = $this->input->post('username');
		$password= md5($this->input->post('password'));
		
        //query ke database
        $result = $this->Admin_model->login($username, $password);
    
        if($result) {
            $sess_array = array();
            foreach($result as $row) {
                $sess_array = array(
				'id_admin'	=>$row->id_admin,
				'nama'		=>$row->nama,
                'username' => $row->username,
                'password' => $row->password
                );
            $this->session->set_userdata('logged_in_admin', $sess_array);
            }
			$this->session->set_flashdata('pass_login', 'Selamat Datang <strong>'.$row->nama.'</strong>, Anda Telah Login Dengan Username <strong>'.$username.'</strong>');
			redirect('admin');
            return TRUE;
       }
       else {
		   $this->session->set_flashdata('fail_login', '<center><h4>Anda gagal login, Silahkan coba lagi</h4></center>');
		   redirect('admin', 'refresh');
            return false;
       }
	}
	public function logout(){
		$this->session->unset_userdata('logged_in_admin');
		$this->session->unset_userdata('id_admin');
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		
		redirect('admin','refresh');
		}

	//dat_validation callback
	function valid_date($str){
		if(!preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$str))
		{
			$this->form_validation->set_message('valid_date','date format is ot valid. yyyy-mm-dd');
			return false;
		}else{
			return true;
		}
	}
}