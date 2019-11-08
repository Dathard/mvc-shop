<?php 

class Product
{
	const SHOW_BY_DEFAULT = 9;

	/**
	 * Adds a new product
	 */
	public static function newProduct($data, $pictureName)
	{
		$name = addslashes(htmlspecialchars($data['name'])); 
		$category = $data['category'];
		$code = addslashes( htmlspecialchars($data['code']) );
		$price = (int) filter_var($data['price'], FILTER_SANITIZE_NUMBER_INT);
		$description = addslashes( htmlspecialchars($data['description']) ); 

		$db = Db::getConnection();

		$sql = "INSERT INTO `product` (`name`, `category_id`, `code`, `price`, `image`, `description`) 
		VALUES ('$name', '$category', '$code', '$price', '$pictureName', '$description');";
		$db->query($sql);

		echo true;
	}

	/**
	 * Сhanges product information
	 */
	public static function editProduct($productParameters, $newData, $pictureName = false)
	{
		$newData = array(
			'name' => addslashes( htmlspecialchars($newData['name']) ),
			'category_id' => $newData['category'],
			'code' => addslashes( htmlspecialchars($newData['code']) ),
			'price' => (int) filter_var($newData['price'], FILTER_SANITIZE_NUMBER_INT),
			'description' => addslashes( htmlspecialchars($newData['description']) )

		);

		if ($pictureName) {
			$filename = 'template/images/product/'.$productParameters['image'];

			if (file_exists($filename)) 
				unlink($filename);
			
			$newData['image'] = $pictureName;
		}
		
		$db = Db::getConnection();

		foreach( $newData as $key => $value ){
			$sql = "UPDATE product SET $key = '".$value."' WHERE id = '".$productParameters['id'] ."'";
			$db->query($sql);
		}

		echo true;
	}

	public static function deleteProduct($productParameters, $productId = false)
	{
		if ($productId) {
			$db = Db::getConnection();

			$sql = "DELETE FROM product WHERE id = '$productId'";
			$db->query($sql);

			$filename = 'template/images/product/'.$productParameters['image'];

			if (file_exists($filename)) 
				unlink($filename);

			echo true;
		}
	}

	/**
	 * Return the product parameter array
	 */
	public static function getProductParameters($productId = false)
	{
		if ($productId) {
			$db = Db::getConnection();

			$sql = "SELECT * FROM product WHERE id = $productId";
			$result = $db->query($sql);

			$productParameters = $result->fetch_assoc();

			return $productParameters;
		}
	}

	/**
	 * Return an array of products
	 */
	public static function getProducts($count = self::SHOW_BY_DEFAULT, $sort = 'novelty')
	{
		$count = intval($count);

		switch ($sort) {
			case 'novelty':
			$sortingProducts = "date DESC";
			break;
			case 'cheap':
			$sortingProducts = "price";
			break;
			case 'expensive':
			$sortingProducts = "price DESC";
			break;
			case 'alphabet':
			$sortingProducts = "name";
			break;
			default:
			$sortingProducts = "date DESC";
			break;
		}

		$productList = array();

		$db = Db::getConnection();

		$sql = "SELECT id, name, price, image FROM product ORDER BY $sortingProducts LIMIT $count";
		$result = $db->query($sql);

		while( $row = $result->fetch_assoc() ){
			array_push($productList, array(
				'id'	=>	$row['id'],
				'name'	=>	$row['name'],
				'price'	=>	$row['price'],
				'image'	=>	$row['image']
			));
		}

		return $productList;
	}

	/**
	 * Return the category product array
	*/
	public static function getProductListByCategory($categoryId = false, $sort = 'novelty')
	{
		if ( $categoryId ) {
			$categoryId = intval($categoryId);
			
			switch ($sort) {
				case 'novelty':
				$sortingProducts = "date DESC";
				break;
				case 'cheap':
				$sortingProducts = "price";
				break;
				case 'expensive':
				$sortingProducts = "price DESC";
				break;
				case 'alphabet':
				$sortingProducts = "name";
				break;
				default:
				$sortingProducts = "date DESC";
				break;
			}

			$db = Db::getConnection();

			$productList = array();

			$sql = "SELECT id, name, price, image FROM product WHERE category_id = $categoryId ORDER BY $sortingProducts LIMIT " . self::SHOW_BY_DEFAULT;
			$result = $db->query($sql);

			while ( $row = $result->fetch_assoc() ) {
				array_push($productList, array(
					'id'	=>	$row['id'],
					'name'	=>	$row['name'],
					'price'	=>	$row['price'],
					'image'	=>	$row['image']
				));
			}

			return $productList;
		}
	}

	/**
	 * Returned array of goods with condition
	 */
	public static function getGoodsWithValue($condition)
	{
		$db = Db::getConnection();

		$productList = array();

		$sql = "SELECT id, name, price, image FROM product WHERE concat(name,code,description) LIKE '%$condition%' ORDER BY date";
		$result = $db->query($sql);

		while ( $row = $result->fetch_assoc() ) {
			array_push($productList, array(
				'id'	=>	$row['id'],
				'name'	=>	$row['name'],
				'price'	=>	$row['price'],
				'image'	=>	$row['image']
			));
		}

		return $productList;
	}

}