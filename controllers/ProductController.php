<?php 

class ProductController 
{
	
	public function actionView($productId)
	{
		$categories = array();
		$categories = Category::getCategoriesList();

		$productParameters = array();
		$productParameters = Product::getProductParameters($productId);

		require_once(ROOT.'/views/product/view.php');

		return true;
	}

	public function actionSearch($sort = 'novelty')
	{	
		$condition = htmlspecialchars($_POST['condition']);

		$categories = array();
		$categories = Category::getCategoriesList();

		$products = array();
		$products = Product::getGoodsWithValue($condition);

		if (count($products) > 0) 
			require_once(ROOT.'/views/search/index.php');
		else
			require_once(ROOT.'/views/search/error.php');
		
		return true;
	}

}