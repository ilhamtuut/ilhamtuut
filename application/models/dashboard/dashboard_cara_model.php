<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_cara_model extends CI_Model {

    private $primary_key='id';
    private $table_name='cara';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	function get()
    {
        $this->db->select('*');
		$this->db->from('cara');	
		$query = $this->db->get();
		return $query->result();
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