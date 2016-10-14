<?php
class Produk_model extends CI_Model{
	/*
	 * Get All Products
	 */
	public function get_produks(){
		$this->db->select('*');
		$this->db->from('produk');
		$query = $this->db->get();
		return $query->result();
	}
	
	/*
	 * Get Single Product
	 */
	
	public function get_produk_details($id){
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->where('id_produk',$id);
		
		$query = $this->db->get();
		return $query;
	}
	
	public function cari()
	{
		$cari = $this->input->GET('cari', TRUE);
		$data = $this->db->query("SELECT * from produk where nama_produk like '%$cari%' ");
		return $data->result();
	}

	/*
	 * Get All categories
	 */
	
	public function get_categories_details($ik){
		$this->db->select('*');
		$this->db->from('produk');
		$this->db->where('id_kategori',$ik);
		
		$query = $this->db->get();
		return $query;
	}

	/*
	 * Set Categories
	 */
	 
	public function get_categories(){
		$this->db->select('*');
		$this->db->from('kategori');
		$query = $this->db->get();
		return $query->result();	 
	}
	
	/*
	 * Get Most Popular Products
	 */
	
	public function get_popular(){
		$this->db->select('P.*, COUNT(O.id_produk) as total');
		$this->db->from('pesanan AS O');
		$this->db->join('produk AS P', 'O.id_produk = P.id_produk', 'INNER');
		$this->db->group_by('O.id_produk');
		$this->db->order_by('total', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_detail_ongkir(){
		$this->db->select('*');
		$this->db->from('ongkir');
		$query = $this->db->get();
		return $query->result();
	}
	
	/*
	*Add Order To Database
	*/
	
	public function add_order($order_data){
		$insert = $this->db->insert('pesanan',$order_data);
		return $insert;
	}
	
	public function belanja($kota){
		$this->db->select('*');
		$this->db->from('pesanan AS O');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->where('kota',$kota);
		$this->db->join('ongkir AS Q', 'O.id_produk = Q.id_ongkir', 'required joins');
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		return $query->row();
	}
}
?>