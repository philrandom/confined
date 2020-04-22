<?php
try
{
    $a = new PharData('../../data/5ab73bff9a44d3e7345271f2cfefd0bf/archive.tar');

    // ADD FILES TO archive.tar FILE
    $a->addFile('../../data/5ab73bff9a44d3e7345271f2cfefd0bf/0');
    $a->addFile('../../data/5ab73bff9a44d3e7345271f2cfefd0bf/1');

    // COMPRESS archive.tar FILE. COMPRESSED FILE WILL BE archive.tar.gz
    $a->compress(Phar::GZ);

    // NOTE THAT BOTH FILES WILL EXISTS. SO IF YOU WANT YOU CAN UNLINK archive.tar
    unlink('../../data/5ab73bff9a44d3e7345271f2cfefd0bf/archive.tar');
}
catch (Exception $e)
{
    echo "Exception : " . $e;
}
?>
