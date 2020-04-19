<?php

/*---		$tree_structure		---
example :
/data/section/cours/chapter/file.md
array( 'origine' => 'data' , 'section' => '?', 'cours' => '?', 'chapter' => '?', 'end' => '?'  );

where '?' will represent the hash name of file.

you can modify all the organization and change the names of indexing (as for example 'section').
But you must always specify 'origine' at the beginning and 'end' for the file that you want reach.
*/
$tree_structure = 				array( 'origine' => 'data' , 'section' => '?', 'cours' => '?', 'chapter' => '?', 'end' => '?'  );

$hash =										'md5';		//please use hash function with one argument for security avoiding CSRF exec. pleas use old hash algorithm
/*---		versionning section 	---*/
$max_version = 						5;				//max of last version awaylable immediatly
$rm_old_versions =				'no';			//delete old versions (rm as remove)

/*---		compression		---
Phar::GZ 		// .tar.gz
Phar::BZ2 	// .tar.bz2  - note : you must enable it https://www.php.net/manual/en/bzip2.installation.php
Phar::NONE 	// .tar

.gz
*/
$compression_type =	'Phar::GZ';		//to compress old versions

 ?>
