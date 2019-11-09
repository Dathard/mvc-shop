<?php 

class File
{
	const MAX_FILE_SIZE = 1024000;
	const FILE_TYPES = array('image/jpeg');
	const PATH = 'template/images/product/';
	const TMP_PATH = 'template/tmp/';


	public static function fileVerification($file)
	{
		if (!in_array($file['type'], self::FILE_TYPES)){
			echo 'Заборонений тип файлу.';

			return false;
		}

		if ($file['size'] > self::MAX_FILE_SIZE){
			echo 'Занадто великий розмір файлу.';

			return false;
		}

		return true;
	}


	public static function uploadFile($file)
	{
		if ($file['type'] == 'image/jpeg')
			$source = imagecreatefromjpeg($file['tmp_name']);
		elseif ($file['type'] == 'image/png')
			$source = imagecreatefrompng($file['tmp_name']);
		elseif ($file['type'] == 'image/gif')
			$source = imagecreatefromgif($file['tmp_name']);
		else
			return false;


		$new_name = rand(10000000000, 99999999999);
		$format = explode(".", $file['name']);
		$format = end($format);
		$new_name .= '.' . $format;


		if (!move_uploaded_file($file['tmp_name'], self::PATH . $new_name)) {
			die('При записи изображения на диск произошла ошибка.');
		}

		return $new_name;
	}

}