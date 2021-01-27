<?php

	/*---		BACKUP		---*/
	define('hash', apache_getenv('hash'));		//please use hash function with one argument for security avoiding CSRF exec. pleas use old hash algorithm
	/*---		Attachement	---*/
	define('authorized_ext', apache_getenv('authorized_ext'));
	define('separate_location', apache_getenv('separate_location'));
		//yes 	write in /data/attachement/
		//no 	write in /data/h_code/attachement/
	define('name_dir_attachement', apache_getenv('name_dir_attachement'));
	/*---		versionning section 	---*/
	define('max_version', apache_getenv('max_version'));				//max of last version available immediatly
	define('rm_old_versions', apache_getenv('rm_old_versions'));			//delete old versions (rm as remove)

	/*---		qcm			---*/
	define('qcm', apache_getenv('qcm'));		//table qcm in db

	/*---		compression		---
	Phar::GZ 		// .tar.gz
	Phar::BZ2 	// .tar.bz2  - note : you must enable it https://www.php.net/manual/en/bzip2.installation.php
	Phar::NONE 	// do not compress
	*/
	define('compression_type', apache_getenv('compression_type'));		//to compress old versions
 ?>
