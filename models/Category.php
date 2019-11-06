<?php 

class Category
{
	
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