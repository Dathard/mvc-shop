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

	// Функція зміни розміру зображення
	// Міняє розмір зображення в залежності від type:
	//	type = 1 - ескіз
	// 	type = 2 - Велике зображення
	public static function uploadFile($file, $type = 1, $rotate = null, $quality = null)
	{
		// обмеження по ширині в пікселях
		$max_thumb_size = 200;
		$max_size = 600;

		if ($quality == null)
			$quality = 75;

		if ($file['type'] == 'image/jpeg')
			$source = imagecreatefromjpeg($file['tmp_name']);
		elseif ($file['type'] == 'image/png')
			$source = imagecreatefrompng($file['tmp_name']);
		elseif ($file['type'] == 'image/gif')
			$source = imagecreatefromgif($file['tmp_name']);
		else
			return false;

		if ($rotate != null)
			$src = imagerotate($source, $rotate, 0);
		else
			$src = $source;

		$w_src = imagesx($src); 
		$h_src = imagesy($src);

		// в залежності від типу (эскіз / велике зображення) встановлюємо обмеження по ширині.
		if ($type == 1)
			$w = $max_thumb_size;
		elseif ($type == 2)
			$w = $max_size;

		$dest = imagecreatetruecolor($w, $w);

		// вирізаем квадратну середину по x, якщо фото горизонтальне
		if ($w_src > $h_src)
			imagecopyresampled($dest, $src, 0, 0, round((max($w_src, $h_src) - min($w_src, $h_src))/2), 0, $w, $w, min($w_src, $h_src), min($w_src, $h_src));
		// вирізаем квадратну середину по y, якщо фото горизонтальне
		elseif ($w_src < $h_src)
			imagecopyresampled($dest, $src, 0, 0, 0, round((max($w_src, $h_src) - min($w_src, $h_src))/2), $w, $w, min($w_src, $h_src), min($w_src, $h_src));
		// маштабування фото без вирізок
		elseif ($w_src == $h_src)
			imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $w, $w_src, $w_src);

		imagejpeg($dest, self::TMP_PATH . $file['name'], $quality);
		imagedestroy($dest);
		imagedestroy($src);



		if (!@copy(self::TMP_PATH . $file['name'], self::PATH . $file['name']))
		{
			echo 'Щось пішло не так.';
			return false;
		}else{
			$new_name = rand(10000000000, 99999999999);
			$new_namesds = explode(".", $file['name']);
			$new_name .= '.' . end($new_namesds);
			rename(self::PATH.$file['name'], self::PATH.$new_name);

			unlink(self::TMP_PATH . $file['name']);
		}

		return $new_name;
	}

}