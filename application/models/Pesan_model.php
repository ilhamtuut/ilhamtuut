<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Pesan_model extends CI_Model {

    private $primary_key='id';
    private $table_name='pesan';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function get()
    {
        $this->db->select('*');
		$this->db->from('pesan');	
		$query = $this->db->get();
		return $query->result();
    }
	function get_last_ten($limit=10,$offset=0)
    {
        $query = $this->db->get('pesan', $limit,$offset);
        return $query->result();
    }
    function count_all()
    {
        return $this->db->count_all($this->table_name);
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