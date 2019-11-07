<?php 

class ProductController 
{

	public function actionNew()
	{
		if(!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {
			echo 'Помилка не вибрано файл'; 
			return true;
		}

		$status = true;
		$status = File::fileVerification($_FILES['file']);

		if (!$status) 
			return true;
		
		$pictureName = File::uploadFile($_FILES['file'], 2);

		Product::newProduct($_POST, $pictureName);

		return true;
	}

	public function actionEdit()
	{
		$status = true;

		if( !(!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) ) {
			$status = File::fileVerification($_FILES['file']);

			if (!$status) 
				return true;

			$pictureName = File::uploadFile($_FILES['file'], 2);
		}

		$productParameters = array();
		$productParameters = Product::getProductParameters($_POST['id']);

		if ( isset($pictureName) ) 
			Product::editProduct($productParameters, $_POST, $pictureName);	
		else
			Product::editProduct($productParameters, $_POST);

		return true;
	}

	public function actionDelete()
	{
		$productParameters = array();
		$productParameters = Product::getProductParameters($_POST['id']);

		Product::deleteProduct($productParameters, $_POST['id']);

		return true;
	}
	
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