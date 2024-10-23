<?php

namespace JW3B\Helpful;

use JW3B\Helpful\Files;

class Images
{
	public string $magick = 'magick';

	/**
	 * Get the large version of an image.
	 *
	 * @param string $img The path to the image.
	 * @return string The path to the large image.
	 */
	public static function get_large_img(string $img): string
	{
		$base = basename($img);
		$large_img = str_replace($base, 'l'.substr($base, 1), $img);
		return $large_img;
	}

	/**
	 * Set the ImageMagick command.
	 *
	 * @param string $val The ImageMagick command.
	 * @return $this
	 */
	public function set_im(string $val): self
	{
		$this->magick = $val;
		return $this;
	}

	/**
	 * Get the MIME type of a file.
	 *
	 * @param array $file The file information.
	 * @return string|array The MIME type or an error.
	 */
	public static function get_mime_type(array $file): string|array
	{
		return match ($file['type']) {
			'image/pjpeg', 'image/jpeg', 'image/jpg' => 'jpg',
			'image/webp' => 'webp',
			'image/apng' => 'apng',
			'image/png', 'image/x-png' => 'png',
			'image/gif' => 'gif',
			'image/avif' => 'avif',
			'image/svg' => 'svg',
			'image/vnd.adobe.photoshop' => 'psd',
			default => ['error' => $file['type']],
		};
	}

	/**
	 * Convert an image to webp using GD.
	 *
	 * @param string $source The path to the original image.
	 * @param int $quality The quality of the webp image (0-100).
	 * @param bool $removeOld Whether to remove the original image.
	 * @return string|bool The path to the webp image.
	 */
	public static function webpImage(string $source, int $quality = 75, bool $removeOld = false): string|bool
	{
		$dir = pathinfo($source, PATHINFO_DIRNAME);
		$name = pathinfo($source, PATHINFO_FILENAME);
		$destination = $dir.DIRECTORY_SEPARATOR.$name.'.webp';

		$info = getimagesize($source);
		$image = match ($info['mime']) {
			'image/jpeg' => imagecreatefromjpeg($source),
			'image/gif' => imagecreatefromgif($source),
			'image/png' => imagecreatefrompng($source),
			default => null,
		};
		if(is_null($image)) { return false; }

		if ($info['mime'] === 'image/gif' || $info['mime'] === 'image/png') {
			imagepalettetotruecolor($image);
			imagealphablending($image, true);
			imagesavealpha($image, true);
		}

		imagewebp($image, $destination, $quality);

		if ($removeOld && is_file($destination)) {
			unlink($source);
		}

		return $destination;
	}

	/**
	 * Resize and upload an image.
	 *
	 * @param array $file The file information (e.g., $_FILES['input-name']).
	 * @param string $dir The directory to upload to.
	 * @param array $opts Options for resizing and conversion.
	 * @return string|array The path to the resized images or an error message.
	 */
	public function resize_uploaded_image(array $file, string $dir, array $opts = []): string|array
	{
		$make_webp = false;
		if ($file['error'] == 0) {
			$opts['convert'] = $opts['convert'] ?? true;
			$opts['sizes'] = $opts['sizes'] ?? ['s' => '300', 'l' => '800'];

			$check = self::get_mime_type($file);
			if (is_array($check) && isset($check['error'])) {
				return 'Incorrect file type uploaded. Only png, gif, and jpg files are supported. - '.$check['error'];
			}

			$ext = '.'.$check;
			if ($ext != 'webp' && $opts['convert']) {
				$make_webp = true;
			}

			$filename = preg_replace('/[^a-zA-Z0-9\._]/i', '', $file['name']);
			$dir = Files::make_yr_directory($dir);
			$filename = Files::check_file($dir, $filename);
			move_uploaded_file($file['tmp_name'], $dir.$filename);

			if (is_file($dir.$filename)) {
				return $this->resize_image($dir, $filename, $opts['sizes'], ['ext' => $check, 'make' => $make_webp], $opts['trim_filepath'] ?? '');
			} else {
				return ['error' => 'couldn’t move uploaded file or copy the temp file to the destination.'];
			}
		} else {
			return 'Looks like there was an error uploading this file.';
		}
	}

	/**
	 * Resize an image using ImageMagick.
	 *
	 * @param string $dir The directory the file is in.
	 * @param string $filename The filename.
	 * @param array $sizes The sizes to resize to.
	 * @param array $make_webp Options for converting to webp.
	 * @param string $remove_from_beginning Path to remove from the beginning of the file path.
	 * @return array The paths to the resized images.
	 */
	public function resize_image(string $dir, string $filename, array $sizes, array $make_webp = [], string $remove_from_beginning = ''): array
	{
		$created = [];
		[$width, $height] = getimagesize($dir.$filename);
		$total_sizes = count($sizes);

		foreach ($sizes as $pre => $size) {
			$new_file = $total_sizes > 1 ? $dir.$pre.'-'.$filename : $dir.$pre.'-'.$filename;
			if ($width > $size || $height > $size) {
				system($this->magick." ".escapeshellarg($dir.$filename)." -resize ".escapeshellarg($size."x".$size)." -quality 100 ".escapeshellarg($new_file));
			} else if ($new_file != $dir.$filename) {
				copy($dir.$filename, $new_file);
			}

			if ($make_webp['make'] ?? false) {
				$webp_file = str_replace('.'.$make_webp['ext'], '-webp.'.$make_webp['ext'], $new_file);
				if (!str_ends_with($new_file, 'webp')) {
					system($this->magick.' '.escapeshellarg($new_file).' -quality 80 '.escapeshellarg($webp_file));
				}
			}

			if (!is_file($new_file)) {
				$created['not_found'][$pre] = $new_file;
			} else {
				$created[$pre] = str_replace($remove_from_beginning, '', $new_file);
			}

			if (isset($webp_file) && !is_file($webp_file)) {
				$created['webp_not_found'][$pre] = $webp_file;
			} else {
				$created['webp'][$pre] = str_replace($remove_from_beginning, '', $webp_file ?? '');
			}
		}

		return $created;
	}
}
