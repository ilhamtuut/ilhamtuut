<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_ongkir_model extends CI_Model {

    private $primary_key='id_ongkir';
    private $table_name='ongkir';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function get_by_id($id)
    {
        $this->db->where($this->primary_key,$id);
        return $this->db->get('ongkir');
    }

    function get_last_ten_ongkir($limit=10,$offset=0)
    {
        $query = $this->db->get('ongkir', $limit,$offset);
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