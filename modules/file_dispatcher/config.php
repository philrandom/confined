<?php

/*---		SQL 	---*/
require('db.php');

$tag_table = 							'tag';
$file_ref_table = 				'file_ref';

/*---		BACKUP		---*/
$backup =									'/data'; 	//place to backup
$hash =										'md5';		//please use hash function with one argument for security avoiding CSRF exec. pleas use old hash algorithm
/*---		versionning section 	---*/
$max_version = 						5;				//max of last version available immediatly
$rm_old_versions =				'no';			//delete old versions (rm as remove)

/*---		compression		---
Phar::GZ 		// .tar.gz
Phar::BZ2 	// .tar.bz2  - note : you must enable it https://www.php.net/manual/en/bzip2.installation.php
Phar::NONE 	// .tar
*/
$compression_type =	'Phar::GZ';		//to compress old versions

 ?>
