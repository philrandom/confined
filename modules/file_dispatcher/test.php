<?php
$myfile = fopen("test/newfile.txt", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);
?>


<?php
$p = new Phar('test/my.phar', 0, 'my.phar');
$p['myfile.txt'] = 'hi';
$p['myfile2.txt'] = 'hi';
foreach ($p as $file) {
    var_dump($file->getFileName());
    var_dump($file->isCompressed());
    var_dump($file->isCompressed(Phar::BZ2));
    var_dump($file->isCompressed(Phar::GZ));
}
$p->compressFiles(Phar::GZ);
foreach ($p as $file) {
    var_dump($file->getFileName());
    var_dump($file->isCompressed());
    var_dump($file->isCompressed(Phar::BZ2));
    var_dump($file->isCompressed(Phar::GZ));
}
?>
<?php
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
