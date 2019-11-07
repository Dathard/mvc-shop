<?php 

return array(
	//'catalog/page=([0-9]+)'	=>	'catalog/index/$1',

	//'category/([0-9]+)/page=([0-9]+)'	=>	'catalog/category/$1/$2',

	'new-product' => 'product/new',
	'edit-product' => 'product/edit',

	'search' => 'product/search',

	'category/([0-9]+)/sort=([a-z]+)' => 'catalog/category/$1/$2',
	'category/([0-9]+)' => 'catalog/category/$1',

	'product/([0-9]+)' => 'product/view/$1',
	
	'sort=([a-z]+)' => 'catalog/index/$1',
	'' => 'catalog/index'
);