--TEST--
Database: Enumerating collections
--SKIPIF--
<?php require_once "tests/utils/standalone.inc"; ?>
--FILE--
<?php
require_once "tests/utils/server.inc";
$a = mongo_standalone();
$d = $a->selectDb(dbname());

$d->listcol->drop();
$d->listcol->insert(array('_id' => 'test'));

echo "without flag\n";
$collections = $d->listCollections();
foreach( $collections as $col )
{
	if ($col->getName() == 'system.indexes') {
		echo $col->getName(), "\n";
	}
}

echo "with flag\n";
$collections = $d->listCollections(true);
foreach( $collections as $col )
{
	if ($col->getName() == 'system.indexes') {
		echo $col->getName(), "\n";
	}
}
--EXPECT--
without flag
with flag
system.indexes
