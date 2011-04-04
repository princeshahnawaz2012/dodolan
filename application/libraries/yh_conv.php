<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Yh_conv 
{
	function conv($currencyfrom,$currencyto)
{
       $from   = $currencyfrom;
		$to     = $currencyto;
	    $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
	    $handle = @fopen($url, 'r');
	    if ($handle) {
	            $result = fgets($handle, 4096);
	            fclose($handle);
	    }
	     $allData = explode(',',$result); /* Get all the contents to an array */
	     $rate = $allData[1];
	     return $rate;
}


}