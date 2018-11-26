<?php
error_reporting(E_ERROR | E_PARSE);

$servername = "localhost";
$username = "root";
$password = "root";
$db = "kyber_tx";

global $conn;

$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
	logDebug("DB connection failed: " . $conn->connect_error);
}else{
	$sql = "CREATE TABLE IF NOT EXISTS kyber_txs (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		hash VARCHAR(66) NOT NULL UNIQUE,
		status VARCHAR(10) NOT NULL,
		source_amount VARCHAR(20),
		source_symbol VARCHAR(20),
		dest_amount VARCHAR(20),
		dest_symbol VARCHAR(20),
		created_at TIMESTAMP
	)";

	runQuery($sql);
}

function insertDB($data){
	$hash = $data['hash'];
	$status = $data['status'];
	$sql = "INSERT IGNORE INTO kyber_txs (hash, status) VALUES ('$hash', '$status')";
	runQuery($sql);
}

function updateDB($data){
	$hash = $data['hash'];
	$status = $data['status'];
	$source_amount = $data['source_amount'];
	$source_symbol = $data['source_symbol'];
	$dest_amount = $data['dest_amount'];
	$dest_symbol = $data['dest_symbol'];
	$sql = "UPDATE kyber_txs 
		SET 
			status='$status',
			source_amount='$source_amount',
			source_symbol='$source_symbol',
			dest_amount='$dest_amount',
			dest_symbol='$dest_symbol'
		WHERE hash='$hash'";
	runQuery($sql);
}

function getPendingTx(){
	$sql = "SELECT * FROM kyber_txs WHERE status='PENDING'";
	return getQuery($sql);
}

function runQuery($sql){
	$conn = $GLOBALS['conn'];
	if ($conn->query($sql) !== TRUE) {
		logDebug("DATABASE ERROR: " . $conn->error);
		return false;
	}
	return true;
}

function getQuery($sql){
	$conn = $GLOBALS['conn'];
	$result = $conn->query($sql);
	$data = [];
	while($row = $result->fetch_assoc()){
		array_push($data, $row);
	}
	return $data;
}