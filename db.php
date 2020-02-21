<?php
//DBへの接続処理
try {
	$pdo = new PDO(
		'mysql:host=localhost;dbname=book_sample;charset=utf8',
		'takao',
		'1111',
		array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ));
} catch (PDOException $e) {
	exit('Error: '.$e->getMessage());
}