<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_produk_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    private $primary_key='id_produk';
    private $table_name='produk';

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
    
    function get_last_ten_produk($limit=10,$offset=0)
    {
        $query = $this->db->get($this->table_name, $limit,$offset);
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('produk', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('admin', $this, array('id' => $_POST['id']));
    }
    function count_all()
    {
        return $this->db->count_all($this->table_name);
    }
	function delete_poto($id)
    {
        $this->db->where($this->primary_key,$id);
        $query = $getData = $this->db->get('produk');
		if($getData->num_rows()>0)
			return $query;
		else
			return null;
    }
    function delete($id)
    {
        $this->db->where($this->primary_key,$id);
        $this->db->delete($this->table_name);
    }
    function save($person)
    {
        $this->db->insert($this->table_name,$person);
        return $this->db->insert_id();
    }
    function update($id,$person)
    {
        $this->db->where($this->primary_key,$id);
        $this->db->update($this->table_name,$person);
    }

}