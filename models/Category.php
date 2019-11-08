<?php 

class Category
{

	/**
	 * 
	 */
	public static function checkCategory($categoryId)
	{
		$db = Db::getConnection();

		$sql = "SELECT * FROM category WHERE id = $categoryId";
		$result = $db->query($sql);

		if ($result->num_rows > 0) 
			return true;
		else
			return false;
	}
	
	/**
	 * Returns as array of categories
	 */
	public static function getCategoriesList()
	{
		$db = Db::getConnection();

		$categoryList = array();

		$sql = 'SELECT id, name FROM category';
		$result = $db->query($sql);

		while ( $row = $result->fetch_assoc() ) {
			array_push($categoryList, array(
				'id'	=>	$row['id'],
				'name'	=>	$row['name']
			));
		}

		return $categoryList;
	}
	
}