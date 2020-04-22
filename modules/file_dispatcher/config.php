<?php
class const_dispatcher
{
	/*---		SQL 	---*/
	const type_sql =								'mysql';
	const server =									'localhost';
	const user_sql =								'confined';
	const pass_sql =								'confined0';
	const dbname =									'confined';
	const tag_table = 							'tag';
	const file_ref_table = 					'file_ref';

	/*---		BACKUP		---*/
	const backup =									'../data'; 	//place to backup
	const backup_not_stream =						'/data'; 	//place to backup
	const hash =										'md5';		//please use hash function with one argument for security avoiding CSRF exec. pleas use old hash algorithm
	/*---		versionning section 	---*/
	const max_version = 						5;				//max of last version available immediatly
	const rm_old_versions =				'no';			//delete old versions (rm as remove)

	/*---		compression		---
	Phar::GZ 		// .tar.gz
	Phar::BZ2 	// .tar.bz2  - note : you must enable it https://www.php.net/manual/en/bzip2.installation.php
	Phar::NONE 	// .tar
	*/
	const compression_type =	Phar::NONE;		//to compress old versions
}
 ?>
