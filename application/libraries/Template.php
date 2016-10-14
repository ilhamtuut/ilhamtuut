<?php
class Template{
	protected $_ci;
	function __construct()
	{
		$this->_ci=&get_instance();
	}

	function display($Template,$data=null)
	{
		$data['_content']=$this->_ci->load->view($Template,$data,true);
		$data['_header']=$this->_ci->load->view('Template/header',$data,true);
		$data['_top_menu']=$this->_ci->load->view('Template/menu',$data,true);
		$data['_right_menu']=$this->_ci->load->view('Template/sidebar',$data,true);
		$data['_footer']=$this->_ci->load->view('Template/footer',$data,true);
		$this->_ci->load->view('/Template.php',$data);
	}
}