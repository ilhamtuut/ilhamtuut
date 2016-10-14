<?php
class User_model extends CI_Model{
	private $primary_key='id_user';
    private $table_name='user';
	
	public function register(){
		$data = array(
		'nama' 			=> $this->input->post('nama'),
		'telp' 			=> $this->input->post('notelp'),
		'alamat' 		=> $this->input->post('alamat'),
		'kota' 			=> $this->input->post('kota'),
		'email' 		=> $this->input->post('email'),
		'username' 		=> $this->input->post('username'),
		'password' 		=> md5($this->input->post('password'))
	);
	$insert = $this->db->insert('user', $data);
	return $insert;
	}
	
	public function login($username, $password){
		//Validate
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		
		$result = $this->db->get('user');
		if($result->num_rows() == 1){
			return $result->row(0)->id_user;
		} else {
			return false;
		}
	}
	public function belanja(){
		$this->db->select('*');
		$this->db->from('pesanan AS O');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->join('produk AS P', 'O.id_produk = P.id_produk', 'required joins');
		$this->db->join('ongkir AS Q', 'O.id_produk = Q.id_ongkir', 'required joins');
		//$this->db->order_by('id','DESC');
		$query = $this->db->get();
		return $query->result();	
	}
	function count_all()
	{
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->group_by("id_transaksi");
		return $query = $this->db->get("pesanan");
	}
	public function gb($limit=5,$offset=0)
	{
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->group_by("id_transaksi");
		$this->db->order_by("tgl_pesan", "desc"); 
		return $query = $this->db->get("pesanan",$limit,$offset);
	}
	public function asua($id){
		$this->db->select('*');
		$this->db->from('pesanan as O');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$this->db->where('id_transaksi',$id);
		$this->db->join('produk AS P', 'O.id_produk = P.id_produk', 'required joins');
		$this->db->join('ongkir AS Q', 'O.kota= Q.kota', 'required joins');
		//$this->db->group_by("tgl_pesan");
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

	public function get_user(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id_user', $this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query->row();
	}
	
	public function getalbums() {
		$data = array();
		$query = $this->db->get('ongkir');
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
		         	$data[] = $row;
		        }
		}	
		$query->free_result();
		return $data;	
		}
	function update($id,$person)
    {
        $this->db->where($this->primary_key,$id);
        $this->db->update($this->table_name,$person);
    }
	
}
?>