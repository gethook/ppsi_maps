<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('rupiah'))
{
	function rupiah($number,$dec='')
	{
		if($dec=='') $dec=0;
		if(!is_numeric($number) || empty($number) || $number == NULL) return 'Rp -';
		return 'Rp'.number_format($number,$dec,',','.');
	}
}
