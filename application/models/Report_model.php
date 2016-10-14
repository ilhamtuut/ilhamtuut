<?PHP
class Report_model extends CI_Model
{
  function transaksi($id)
  {
    $this->db->select('*');
	$this->db->from('pesanan as O');
	$this->db->where('id_transaksi',$id);
	$this->db->join('produk AS P', 'O.id_produk = P.id_produk', 'required joins');
	$this->db->join('user AS Z', 'O.id_user= Z.id_user', 'required joins');
	$this->db->join('ongkir AS Q', 'O.kota= Q.kota', 'required joins');
	$query = $this->db->get();
	return $query;
  }
}
?>