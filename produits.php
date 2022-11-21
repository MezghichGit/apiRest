<?php
include("db_connect.php");

$request_method = $_SERVER["REQUEST_METHOD"];

//getProducts();

switch($request_method) {
    case 'GET':
        // Retrive Products
        if (!empty($_GET["id"])) {
            $id=intval($_GET["id"]);
            getProduct($id);
        } else {
            getProducts();
        }
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function getProducts()
	{
		global $conn;
		$query = "SELECT * FROM produit";
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}

    function getProduct($id=0)
	{
		global $conn;
		$query = "SELECT * FROM produit";
		if($id != 0)
		{
			$query .= " WHERE id=".$id." LIMIT 1";
		}
		$response = array();
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result))
		{
			$response[] = $row;
		}
		header('Content-Type: application/json');
		echo json_encode($response, JSON_PRETTY_PRINT);
	}

?>