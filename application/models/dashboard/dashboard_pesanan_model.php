<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_pesanan_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    private $primary_key='id_transaksi';
    private $table_name='pesanan';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function get_by_id($id)
    {
        $this->db->where($this->primary_key,$id);
        return $this->db->get($this->table_name);
    }
    
    function get_last_ten_pesanan()
    {
        $query = $this->db->get('pesanan');
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('pesanan', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('admin', $this, array('id' => $_POST['id']));
    }
	function update($id,$person)
    {
        $this->db->where($this->primary_key,$id);
        $this->db->update($this->table_name,$person);
    }

}