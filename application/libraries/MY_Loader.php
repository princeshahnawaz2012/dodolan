<?
class MY_Loader extends CI_Loader{
       
    function MY_Loader(){
        parent::CI_Loader();        

       	$this->_ci_view_path = '../../themes/';
        
    }
}