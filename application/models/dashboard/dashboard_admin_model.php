<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_admin_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    private $primary_key='id_admin';
    private $table_name='admin';

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
    
    function get_last_ten_admin()
    {
        $query = $this->db->get('admin', 10);
        return $query->result();
    }

    function insert_entry()
    {
        $this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('admin', $this);
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