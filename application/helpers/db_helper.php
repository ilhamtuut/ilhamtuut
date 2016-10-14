<?php
/*
 * Get Categories
 */
function get_categories_h(){
	$CI = get_instance();
	$categories = $CI->Produk_model->get_categories();
	return $categories;
}

/*
 * Get Sidebar Most Popular
 */
function get_popular_h(){
	$CI =& get_instance();
	$CI->load->model('Produk_model');
	$popular_produks = $CI->Produk_model->get_popular();
	return $popular_produks;
}
?>