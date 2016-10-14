<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_user_model extends CI_Model {

    private $primary_key='id_user';
    private $table_name='user';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function get_by_id($id)
    {
        $this->db->where($this->primary_key,$id);
        return $this->db->get('user');
    }

    function get_last_ten_user($limit=10,$offset=0)
    {
        $query = $this->db->get('user', $limit,$offset);
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