<?php
echo $_SERVER['PHP_SELF'];

try
{
    $a = new PharData('test/archive.tar');

    // ADD FILES TO archive.tar FILE
    $a->addFile('test/newfile.txt');
    $a->addFile('test/oh.tar');

    // COMPRESS archive.tar FILE. COMPRESSED FILE WILL BE archive.tar.gz
    $a->compress(Phar::GZ);

    // NOTE THAT BOTH FILES WILL EXISTS. SO IF YOU WANT YOU CAN UNLINK archive.tar
    unlink('test/archive.tar');
}
catch (Exception $e)
{
    echo "Exception : " . $e;
}
?>

<?php

// decompress from gz
$p = new PharData('test/oh.tar.gz');
$p->decompress(); // creates /path/to/my.tar

// unarchive from the tar
$phar = new PharData('test/oh.tar');
$phar->extractTo('test/');

 ?>
