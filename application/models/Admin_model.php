<?php
class Admin_model extends CI_Model{
	//login
	function login($username, $password){
		//Validate
		$this->db->select('*'); 
        $this->db->from('admin'); //nama tabel pada database
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->limit(1); //menandakan data ditemukan atau sama dengan satu
        $query=$this->db->get();

        if($query->num_rows()==1) {
            return $query->result();
        }else {
            return false;
        }   
	}
			
	//130m
	private $primary_key='id_transaksi';
	private $table_name='pesanan';

	function get_paged_list($limit=10,$offset=0,$order_column='',$order_type='asc')
	{
		if(empty($order_column)||empty($order_type))
		$this->db->order_by($this->primary_key2,'asc');
	else
		$this->db->order_by($order_column,$order_type);
		return $this->db->get($this->table_name,$limit,$offset);
	}
	function get_by_id($id)
	{
		$this->db->where($this->primary_key,$id);
		return $this->db->get($this->table_name);
	}
	function count_all()
	{
		return $this->db->count_all($this->table_name);
	}
	function save($person)
	{
		$this->db->insert($this->table_name,$person);
		return $this->db->insert_id();
	}
	function delete($id)
	{
		$this->db->where($this->primary_key,$id);
		$this->db->delete($this->table_name);
	}
	function update($id,$person)
	{
		$this->db->where($this->primary_key,$id);
		$this->db->update($this->table_name,$person);
	}
	function fetch_image($path)
	{
		$this->load->helper('file');
		return get_filenames($path);
	}
	function count_pesan_masuk()
	{
		$this->db->where('status','Tunggu');
		$this->db->where('baca','N');
		$this->db->group_by("id_transaksi");
		return $query = $this->db->get("pesanan");
	}
	function countl()
	{
		$this->db->where('status','Tunggu');
		$this->db->group_by("id_transaksi");
		return $query = $this->db->get("pesanan");
	}
	function countls()
	{
		$this->db->where('status','OK');
		$this->db->group_by("id_transaksi");
		return $query = $this->db->get("pesanan");
	}
	public function gb($limit=5,$offset=0)
	{
		$this->db->where('status','Tunggu');
		$this->db->group_by("id_transaksi");
		$this->db->order_by("tgl_pesan", "desc"); 
		return $query = $this->db->get("pesanan",$limit,$offset);
	}
	public function gbs($limit=5,$offset=0)
	{
		$this->db->where('status','OK');
		$this->db->group_by("id_transaksi");
		$this->db->order_by("tgl_pesan", "desc"); 
		return $query = $this->db->get("pesanan",$limit,$offset);
	}
	
	public function asua($id){
		$this->db->select('*');
		$this->db->from('pesanan as O');
		$this->db->where('id_transaksi',$id);
		$this->db->join('produk AS P', 'O.id_produk = P.id_produk', 'required joins');
		$this->db->join('ongkir AS Q', 'O.kota= Q.kota', 'required joins');
	
		$query = $this->db->get();
		return $query->result();
		}
	public function asua1($id){
		$this->db->select('*');
		$this->db->from('pesanan as O');
		$this->db->where('id_transaksi',$id);
		$this->db->join('produk AS P', 'O.id_produk = P.id_produk', 'required joins');
		$this->db->join('user AS Z', 'O.id_user= Z.id_user', 'required joins');
		
		$query = $this->db->get();
		return $query;
		}
	public function pesanan_masuk(){
		$this->db->select('*');
		$this->db->from('pesanan as O');
		$this->db->where('status','Tunggu');
		$this->db->where('baca','N');
		$this->db->group_by("id_transaksi");
		$this->db->order_by("tgl_pesan", "desc"); 
		$this->db->join('produk AS P', 'O.id_produk = P.id_produk', 'required joins');
		$this->db->join('user AS Z', 'O.id_user= Z.id_user', 'required joins');
		
		$query = $this->db->get();
		return $query->result();
		}
	public function pesanan_masuk2(){
		$this->db->select('*');
		$this->db->from('pesanan as O');
		$this->db->where('status','Tunggu');
		$this->db->where('baca','N');
		$this->db->limit(5);
		$this->db->group_by("id_transaksi");
		$this->db->order_by("tgl_pesan", "desc"); 
		$this->db->join('produk AS P', 'O.id_produk = P.id_produk', 'required joins');
		$this->db->join('user AS Z', 'O.id_user= Z.id_user', 'required joins');
		
		$query = $this->db->get();
		return $query->result();
		}
	
	public function pesanan_masuk_detail($id){
		$this->db->select('*');
		$this->db->from('pesanan as O');
		$this->db->where('status','Tunggu');
		$this->db->where('id_transaksi',$id);
		$this->db->group_by("id_transaksi");
		$this->db->order_by("tgl_pesan", "desc"); 
		$this->db->join('produk AS P', 'O.id_produk = P.id_produk', 'required joins');
		$this->db->join('user AS Z', 'O.id_user= Z.id_user', 'required joins');
		
		$query = $this->db->get();
		return $query;
		}
	function get_last_ten_pesanan($limit=10,$offset=0)
    {
        $query = $this->db->get('pesanan', $limit,$offset);
        return $query->result();
    }
}
?>