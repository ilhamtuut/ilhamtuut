<?php
class Cart extends CI_Controller{
	public $total = 0;
	public $grand_total;
	
	/*
	 * Cart Index
	 */
	 
	public function index(){
		//Load View
		$this->load->model('User_model');	
		if($this->uri->segment(3)=='belanja_success')
			$data['message']='<p class="alert alert-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Terima Kasih Telah Berbelanja Di WEB Kami, Silahkan Melakukan Pembayaran Untuk Proses Selanjutnya</p>';
			else if($this->uri->segment(3)=='belanja_gagal')
				$data['message']='<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Alamat Kirim Masih Kosong, Mohon Diisi Dengan Benar !!!</p>';
			else
			$data['message']='';
		$data['album'] = $this->User_model->getalbums();
		$data['main_content'] = 'cart';
		$this->load->view('layouts/main', $data);
	}
	
	/*
	 * Add to Cart
	 */
	public function add(){
		// Item data
		$data = array(
			'id' => $this->input->post('item_number'),
			'qty' => $this->input->post('qty'),
			'price' => $this->input->post('price'),
			'name' => $this->input->post('title')
		);
		//print_r($data);die();
		
		// Insert into cart
		$this->cart->insert($data);
		
		redirect('produks');
	}
	
	function delete(){
        $data=array(
            'rowid'=>$this->input->post('rowid'),
            'qty'=>0
            );
        $this->cart->update($data);
		redirect('cart','refresh');
    }
	
	/*
	 * Update Cart
	 */
	public function update($in_cart = null){
		$data = $_POST;
		$this->cart->update($data);
		
		//Show Cart Page
		redirect('cart','refresh');
	}
	
	public function process(){
		$this->_set_rules();

		//run validation
		if($this->form_validation->run()===FALSE)
		{
			//set common propertis
			redirect('cart/index/belanja_gagal');
		}
		else
		{
			if($_POST){
			$gb=$this->User_model->count_all()->num_rows();
			foreach($this->input->post('item_name') as $key => $value){
				$item_id  = $this->input->post('item_code')[$key];
				$produks  = $this->Produk_model->get_produk_details($item_id)->row();
				$ongkir2  = $this->User_model->belanja();
				//Price x Quanity
				$subtotal = ($produks->harga * $this->input->post('item_qty')[$key]); 
				$total    = ($subtotal + $ongkir2->biaya);
				$i=0;
				//Create Order Array
				$order_data = array(
				'id_produk' 	=> $item_id,
				'id_user'		=> $this->session->userdata('id_user'),
				'id_transaksi'	=> 'T'.$this->session->userdata('id_user').$gb,
				'jumlah'		=> $this->input->post('item_qty')[$key],
				'tot_harga'		=> $subtotal,
				'total'			=> $total,
				'alamat_kirim' 	=> $this->input->post('alamat'),
				'kota' 			=> $this->input->post('kota'),
				'status'		=> 'Tunggu',
				'baca'			=> 'N'
				);
				
				//Add Order Data
				$this->Produk_model->add_order($order_data);
			}
			//Get Grand Total
			$this->grand_total = $this->total + $this->tax;
			//Destroy cart
			$this->cart->destroy();
			redirect('produks/index/belanja_success');
		}
		}

	}
	function _set_rules(){
		$this->form_validation->set_rules('alamat','Alamat Kirim','required|trim');
	}
}
?>