<?php

namespace JW3B\erday;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class Helpful_Files {
	public static function mk_dir_writable($dir){
		if(!is_dir($dir)){
			if (!mkdir($dir, 0777)) { // attempt to make it with read, write, execute permissions
				return false; // bug out if it can't be created
			}
		} else {
			if(is_writable($dir)){
				return true;
			} else {
				chmod($dir, 0777);
			}
		}
	}

	/**
	 * Read all files and folders
	 * @param string path without the trailing slash
	 * @para string match the files to find, just leave empty idr what this did
	 *
	 * @return array ['file'] deep
	 */
	public static function tree($path, $match=''){
		$list['file'] = array();
		// Find the real directory part of the path, and set the match parameter
		$last=strrpos($path,"/");
		if(!is_dir($path)){
			$match=substr($path,$last);
			while(!is_dir($path=substr($path,0,$last)) && $last!==false)
				$last=strrpos($path,"/",-1);
		}
		if(empty($match)) $match="/*";
		if(!$path=realpath($path)) return [];

		// List files
		foreach(glob($path.$match) as $file){
			if(is_dir($file)){
				$more = self::tree($file, $match);
				$list['dir'][substr($file,strrpos($file,"/",-1)+1)] = $more;
				$deeper = $more;
				$list['file'] = array_merge($list['file'], $deeper['file']);
			} else {
				$list['file'][]=str_replace($_SERVER['DOCUMENT_ROOT'], '', $path).'/'.substr($file,strrpos($file,"/")+1);
			}
		}
		return @$list;
	}

	public static function make_yr_directory($destination){
		$year = date('Y', time());
		$month = date('n', time());
		if(!is_dir($destination.$year.'/')){
			@mkdir($destination.$year.'/', 0777);
		}
		if(!is_dir($destination.$year.'/'.$month.'/')){
			@mkdir($destination.$year.'/'.$month.'/', 0777);
		}
		return $destination.$year.'/'.$month.'/';
	}

	public static function removeEmptySubfolders($path){
		if(substr($path,-1)!= DIRECTORY_SEPARATOR){
			$path .= DIRECTORY_SEPARATOR;
		}
		$d2 = array('.','..');
		$dirs = array_diff(glob($path.'*', GLOB_ONLYDIR),$d2);
		foreach($dirs as $d){
			self::removeEmptySubfolders($d);
		}
		if(count(array_diff(glob($path.'*'),$d2))===0){
			rmdir($path);
		}
	}

	public static function deleteDir($dir, $rec=true){
		$mydir = opendir($dir);
		while(false !== ($file = readdir($mydir))) {
			if($file != "." && $file != "..") {
				chmod($dir.$file, 0777);
				if(is_dir($dir.$file)) {
					chdir('.');
					self::deleteDir($dir.$file.'/');
					if(is_dir($dir.$file.'/')) rmdir($dir.$file.'/') or die("couldn't delete $dir$file<br />");
				} else {
					if(is_file($dir.$file)) unlink($dir.$file) or die("couldn't delete $dir$file<br />");
				}
			}
		}
		closedir($mydir);
		if($rec == true) rmdir($dir);
		return true;
	}

	// fix array for the following function for image uploads
	/*
	$file_ary = reArrayFiles($_FILES['file']);
		foreach ($file_ary as $file) {
				print 'File Name: ' . $file['name'];
				print 'File Type: ' . $file['type'];
				print 'File Size: ' . $file['size'];
		}
	*/
	public static function reArrayFiles(&$file_post) {
		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);
		for($i=0; $i<$file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_ary;
	}

// http://stackoverflow.com/questions/1334613/how-to-recursively-zip-a-directory-in-php
// zip('/folder/to/compress/', './compressed.zip');
		/**
	 * Zip function will
	 *
	 * @param string $source
	 * 		A directory of files to zip
	 * @param string $destination
	 * 		The path/to/file.zip to put the zip file
	 * @return bool
	 */
	public function zip($source, $destination){
		if(!extension_loaded('zip') || !file_exists($source)){ return false; }
		$zip = new ZipArchive();
		if(!$zip->open($destination, ZIPARCHIVE::CREATE)){ return false; }
		$source = str_replace('\\', '/', realpath($source));
		if(is_dir($source) === true){
			$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
			foreach ($files as $file){
				$file = str_replace('\\', '/', $file);
				// Ignore "." and ".." folders
				if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
						continue;
				$file = realpath($file);
				if (is_dir($file) === true){
						$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
				} else if (is_file($file) === true){
						$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
				}
			}
		} elseif (is_file($source) === true){
			$zip->addFromString(basename($source), file_get_contents($source));
		}
		return $zip->close();
	}
