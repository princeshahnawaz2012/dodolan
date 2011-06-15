<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Barock_page
{
  var $target_page ='';
  var $num_records ='';
  var $num_link    ='';
  var $per_page    ='';
  var $cur_page    ='';
     
  function Barock_page($params = array())
    {
    	$this->_ci =& get_instance();	
    	if (count($params) > 0)
		{
			$this->initialize($params);
		}

		log_message('debug', "Barock Page Class Initialized");
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
	function make_link($page_var = 'page'){
	
	$targetpage  = $this->target_page;
	$limit       = $this->per_page; 
	$total_pages = $this->num_records;
	$page        = $this->cur_page;
	$stages      = $this->num_link;
	$start       = $this->next_start();
	
	
	// Initial page num setup
	if ($page == 0){$page = 1;}
	$prev 		= $page - 1;	
	$next		= $page + 1;							
	$lastpage 	= ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
		$paginate .= '<ul>';
		// Previous
		if ($page > 1){
		$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/'.$prev.'">prev</a></li>';
		}
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= '<li><span class="current">'.$counter.'</span></li>';
				}else{
					$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/'.$counter.'">'.$counter.'</a></li>';}					
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= '<li><span class="current">'.$counter.'</span></li>';
					}else{
						$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/'.$counter.'">'.$counter.'</a></li>';}					
				}
				$paginate.= '...';
				$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/'.$LastPagem1.'">'.$LastPagem1.'</a></li>';
				$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/'.$lastpage.'">'.$lastpage.'</a></li>';		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/1/">1</a></li>';
				$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/2/">2</a></li>';
				$paginate.= '...';
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= '<li><span class="current">'.$counter.'</span></li>';
					}else{
						$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/'.$counter.'">'.$counter.'</a></li>';}					
				}
				$paginate.= '...';
				$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/'.$LastPagem1.'">'.$LastPagem1.'</a></li>';
				$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/'.$lastpage.'">'.$lastpage.'</a></li>';		
			}
			// End only hide early pages
			else
			{
				$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/1">1</a></li>';
				$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/2">2</a></li>';
				$paginate.= '...';
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= '<li><span class="current">'.$counter.'</span></li>';
					}else{
						$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/'.$counter.'">'.$counter.'</a></li>';}					
				}
			}
		}
		// Next
		if ($page < $counter - 1){ 
			$paginate.= '<li><a href="'.$targetpage.'/'.$page_var.'/'.$next.'">next</a></li>';
		}
			
		$paginate.= '</ul><br class="clear"/>';	
		return	$paginate;
		}
 	
	}
	function next_start(){
		$page = $this->cur_page;
		if($page){
		$start = ($page - 1) * $this->per_page; 
		}else{
		$start = 0;	
		}	
		return $start;
	}
  }