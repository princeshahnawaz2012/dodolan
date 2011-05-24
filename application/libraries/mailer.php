<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
Mailer Library for CI, Personaly Use for barock [zidmubarock@gmail.com]
file name : msiler.php
**/

class Mailer
{

	var $to = '';
	var $subject ='';
	var $from = 'zidmubarock@gmail.com';
	var $name_from = 'Culture Update';
	var $cssinline ='';
	var $body = '';
	
	function Mailer($params = array()){
		$this->_ci =& get_instance();
		if (count($params) > 0)
			{
				$this->initialize($params);
		}
		$this->cssinline = $this->_ci->load->library('inlinestyle');
		$this->email = $this->_ci->load->library('email');
	
	
	}
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}
	function setbody($data){
		$config['source'] = $this->_ci->load->view('email_theme/general_email', $data, true);
		$this->cssinline->initialize($config);
		$this->cssinline->convert();
		$this->cssinline->applyStylesheet($this->cssinline->extractStylesheets());
		return 	$this->cssinline->getHTML();
	}
	
	function send(){
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($this->from, $this->name_from);
		$this->email->to($this->to);
		$this->email->subject($this->_ci->config->item('site_name').' - '.$this->subject);
		$this->email->message($this->setbody($this->body)); 
		$this->email->send();
		$data['debug'] = $this->email->print_debugger();
		return $data;
	}

	
	
	/*
	function setHTML($string){
		$this->_source = $string
		return $this->_source;
	}
	*/
}