<?php

namespace JW3B\Helpful;

use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class Files {
	/**
	 * Puts a number before the filename if it exists.
	 *
	 * @param string $dir Directory path.
	 * @param string $name Filename.
	 * @return string The modified filename if exists.
	 */
	public static function check_file(string $dir, string $name): string
	{
		$fullPath = $dir.DIRECTORY_SEPARATOR.$name;
		if (is_file($fullPath)) {
			$n = 1; // Start at 1, since 0 would be the original filename
			do {
				$newName = $n.$name;
				$fullPath = $dir.DIRECTORY_SEPARATOR.$newName;
				$n++;
			} while (is_file($fullPath));
			return $newName;
		}
		return $name;
	}

	/**
	 * Creates a writable directory.
	 *
	 * @param string $dir Directory to create.
	 * @return bool True if writable, false otherwise.
	 * @throws \RuntimeException if unable to create directory.
	 */
	public static function mk_dir_writable(string $dir): bool
	{
		if (!is_dir($dir)) {
			if (!mkdir($dir, 0755, true)) { // Use more restrictive permissions
				throw new \RuntimeException("Unable to create directory: $dir");
			}
		}
		if (!is_writable($dir)) {
			chmod($dir, 0755); // Change permissions if not writable
		}
		return is_writable($dir);
	}

	/**
	 * Reads all files and folders in a directory.
	 *
	 * @param string $path Path without the trailing slash.
	 * @param string $match Pattern to match files.
	 * @return array List of files and directories.
	 */
	public static function tree(string $path, string $match = ''): array
	{
		$list = ['file' => []];
		$path = rtrim($path, DIRECTORY_SEPARATOR); // Trim trailing separator
		$match = empty($match) ? '/*' : $match;

		if (!is_dir($path)) {
			return [];
		}

		foreach (glob($path.$match) as $file) {
			if (is_dir($file)) {
				$more = self::tree($file, $match);
				$list['dir'][basename($file)] = $more;
				$list['file'] = array_merge($list['file'], $more['file']);
			} else {
				$list['file'][] = str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
			}
		}
		return $list;
	}

	/**
	 * Creates a directory structure based on the current year and month.
	 *
	 * @param string $destination Base directory.
	 * @return string Path to the created directory.
	 */
	public static function make_yr_directory(string $destination): string
	{
		$year = date('Y');
		$month = date('n');
		$yearDir = $destination.DIRECTORY_SEPARATOR.$year;
		$monthDir = $yearDir.DIRECTORY_SEPARATOR.$month;

		if (!is_dir($monthDir)) {
			mkdir($monthDir, 0755, true); // Create year/month directory structure
		}

		return $monthDir;
	}

	/**
	 * Removes empty subfolders.
	 *
	 * @param string $path Path to check.
	 */
	public static function removeEmptySubfolders(string $path): void
	{
		$path = rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
		$dirs = array_diff(glob($path.'*', GLOB_ONLYDIR), ['.', '..']);
		foreach ($dirs as $dir) {
			self::removeEmptySubfolders($dir);
		}
		if (count(glob($path.'*')) === 0) {
			rmdir($path);
		}
	}

	/**
	 * Deletes a directory and its contents.
	 *
	 * @param string $dir Directory to delete.
	 * @param bool $rec Whether to delete recursively.
	 * @return bool True if successful.
	 * @throws \RuntimeException if unable to delete.
	 */
	public static function deleteDir(string $dir, bool $rec = true): bool
	{
		$dir = rtrim($dir, DIRECTORY_SEPARATOR);
		if (!is_dir($dir)) {
			throw new \RuntimeException("Directory does not exist: $dir");
		}

		$files = array_diff(scandir($dir), ['.', '..']);
		foreach ($files as $file) {
			$filePath = $dir.DIRECTORY_SEPARATOR.$file;
			if (is_dir($filePath)) {
				self::deleteDir($filePath, true);
			} else {
				if (!unlink($filePath)) {
					throw new \RuntimeException("Unable to delete file: $filePath");
				}
			}
		}
		if ($rec) {
			if (!rmdir($dir)) {
				throw new \RuntimeException("Unable to delete directory: $dir");
			}
		}
		return true;
	}

	/**
	 * Re-arranges files array for image uploads.
	 * $file_ary = reArrayFiles($_FILES['file']);
	 * foreach ($file_ary as $file) {
	 * 	 print 'File Name: '.$file['name'];
	 * 	 print 'File Type: '.$file['type'];
	 * 	 print 'File Size: '.$file['size'];
	 * }
	 *
	 * @param array $file_post $_FILES array.
	 * @return array Re-arranged files.
	 */
	public static function reArrayFiles(array &$file_post): array
	{
		$file_ary = [];
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);
		for ($i = 0; $i < $file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_ary;
	}

	/**
	 * Zips a directory or file.
	 *	Source: http://stackoverflow.com/questions/1334613/how-to-recursively-zip-a-directory-in-php
	 * zip('/folder/to/compress/', './compressed.zip');
	 * @param string $source Source directory or file.
	 * @param string $destination Destination zip file.
	 * @return bool True if successful.
	 */
	public function zip(string $source, string $destination): bool
	{
		if (!extension_loaded('zip') || !file_exists($source)) {
			return false;
		}
		$zip = new ZipArchive();
		if (!$zip->open($destination, ZipArchive::CREATE)) {
			return false;
		}

		$source = str_replace('\\', '/', realpath($source));
		if (is_dir($source)) {
			$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
			foreach ($files as $file) {
				$file = str_replace('\\', '/', $file);
				if (in_array(basename($file), ['.', '..'])) {
					continue; // Ignore "." and ".."
				}
				if (is_dir($file)) {
					$zip->addEmptyDir(str_replace($source.'/', '', $file.'/'));
				} elseif (is_file($file)) {
					$zip->addFromString(str_replace($source.'/', '', $file), file_get_contents($file));
				}
			}
		} elseif (is_file($source)) {
			$zip->addFromString(basename($source), file_get_contents($source));
		}
		return $zip->close();
	}
}