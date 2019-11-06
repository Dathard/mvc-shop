<?php 

class CatalogController 
{
	
	public function actionIndex($sort = 'novelty')
	{
		$categories = array();
		$categories = Category::getCategoriesList();

		$products = array();
		$products = Product::getProducts(14, $sort);

		require_once(ROOT.'/views/catalog/index.php');

		return true;
	}

	public function actionCategory($categoryId = false, $sort = false)
	{
		$categories = array();
		$categories = Category::getCategoriesList();

		$products = array();
		$products = Product::getProductListByCategory($categoryId, $sort);

		require_once(ROOT.'/views/catalog/category.php');

		return true;
	}

}