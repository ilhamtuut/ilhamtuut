 <?php
class Produks extends CI_Controller{
	public function index(){
		//Pesan
		if($this->uri->segment(3)=='belanja_success')
			$data['message']='<p class="alert alert-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Terima Kasih Telah Berbelanja Di WEB Kami, Silahkan Melakukan Pembayaran Untuk Proses Selanjutnya</p>';
			else if($this->uri->segment(3)=='belanja_gagal')
				$data['message']='<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Anda Gagal Melakukan Pembelian !!!</p>';
			else
			$data['message']='';
		//Get ALl products
		$data['produks'] = $this->Produk_model->get_produks();
		
		//load View
		$data['main_content'] = 'produks';
		$this->load->view('layouts/main', $data);
	}
	
	public function details($id){
		$temp_rec = $this->Produk_model->get_produk_details($id);
		$num_rows = $temp_rec->num_rows();
		if($num_rows > 0) // jika data ada di database
		{
			//Get Product Details
			$data['produk'] = $this->Produk_model->get_produk_details($id)->row();
			//Load View
			$data['main_content'] = 'details';
			$this->load->view('layouts/main', $data);
		}
		else // jika data kosong
		{
		  redirect('produks');
		}
	}
	
	public function hasil_cari(){
		//Get Product Details
		$data['cari'] = $this->Produk_model->cari();
		
		//Load View
		$data['main_content'] = 'cari';
		$this->load->view('layouts/main', $data);
	}
	
	public function category($ik){
		$temp_rec = $this->Produk_model->get_categories_details($ik);
		$num_rows = $temp_rec->num_rows();
		if($num_rows > 0) // jika data ada di database
		{
		//Get category Details
		$data['produk'] = $this->Produk_model->get_categories_details($ik)->result();
		
		//Load View
		$data['main_content'] = 'category';
		$this->load->view('layouts/main', $data);
		}
		else // jika data kosong
		{
		  redirect('produks');
		}
	}
}
?>