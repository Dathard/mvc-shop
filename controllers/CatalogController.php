<?php 

class CatalogController 
{
	
	public function actionIndex($sort = 'novelty', $page = 1)
	{
		$count = 14;
		$total = Product::getTotalProducts();
		
		if ( ($page-1) * $count > $total )
			return 404;

		$categories = array();
		$categories = Category::getCategoriesList();

		$products = array();
		$products = Product::getProducts($count, $sort, $page);

		$pagination = new Pagination($total, $page, $count, 'page=');

		require_once(ROOT.'/views/catalog/index.php');

		return true;
	}

	public function actionCategory($categoryId = false, $sort = false, $page = 1)
	{
		if ( $categoryId == false || !Category::checkCategory($categoryId))
			return 404;

		$count = Product::SHOW_BY_DEFAULT;
		$total = Product::getTotalProductsInCategory($categoryId);

		if ( ($page-1) * $count > $total )
			return 404;

		$categories = array();
		$categories = Category::getCategoriesList();

		$products = array();
		$products = Product::getProductListByCategory($categoryId, $sort, $page);

		$pagination = new Pagination($total, $page, $count, 'page=');

		require_once(ROOT.'/views/catalog/category.php');

		return true;
	}

}