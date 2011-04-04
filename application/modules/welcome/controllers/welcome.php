<?php

class Welcome extends Controller {

	function __construct()
    {
        parent::__construct();
    }

	
	function index()
	{
		$this->load->view('welcome/welcome_message');
	}
	function test(){
		echo 'ini namanya '.modules::run('test/testmod');
	}
	function index2(){
		
		$data['pt'] = 'Dodolan';
		$this->theme->render($data, 'back');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */