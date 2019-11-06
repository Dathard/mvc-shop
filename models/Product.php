<?php 


class Product
{
	const SHOW_BY_DEFAULT = 9;
	

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