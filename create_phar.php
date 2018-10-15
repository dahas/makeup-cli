<?php

$buildRoot = "D:\\xampp\\htdocs\\makeUp2\\makeup";
$srcRoot = "_sources";

$phar = new Phar($buildRoot . "/cli.phar", FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, "cli.phar");
$phar->buildFromDirectory($srcRoot);
$phar->setStub($phar->createDefaultStub("cli.php"));