<?php

# inizializzazione del database
require "./src/database/DB.class.php";
$db = new DB();

# abilitazione della sessione
session_start();

# richiesta per non mantenere cache
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

# variabili di configurazione
define("IMG_PATH", "./img/products");

# funzioni di supporto
function get_include_contents(string $file) {
	if (is_file($file)) {
		extract($GLOBALS, EXTR_REFS);
		ob_start();
		include $file;
		return ob_get_clean();
	}
	throw new ErrorException("$file not found");
}

function generate_order_list() {
	global $UID, $db;
	$orders = $db->getOrders($UID);
	foreach ($orders as $o) {
		$orderProd = $db->getOrderProducts($o["id"]);
		$res[] = ["orderId" => $o["id"], "date" => $o["date"], "total" => $o["total"], "prods" => $orderProd];
	}
	return $res ?? [];
}

function get_in_params($array) {
	return "(".rtrim(str_repeat("?,", count($array)), ",").")";
}

function generate_filters() {
	$filter1 = [
		[ "active" => false, "name" => "Tondeggiante" ],
		[ "active" => false, "name" => "Squadrato" ]
	];
	$filter2 = [
		[ "active" => false, "name" => "Piccolo" ],
		[ "active" => false, "name" => "Medio" ],
		[ "active" => false, "name" => "Grande" ]
	];
	return [
		"shape" => [ "values" => $filter1, "name" => "Forma" ],
		"size" =>  [ "values" => $filter2, "name" => "Misura" ]
	];
}

function generate_product($isEmpty = false) {
	if ($isEmpty)
		return array_fill_keys(["id", "name", "price", "size", "shape", "availability", "path"], "");
	else
		return ["id" => $_POST["id"], "name" => $_POST["name"], "price" => $_POST["price"],
			"size" => $_POST["size"], "shape" => $_POST["shape"], "availability" => $_POST["availability"]];
}

function check_image($name, $destination) {
	return !$_FILES[$name]["tmp_name"] ||
		@mime_content_type($_FILES[$name]["tmp_name"]) == "image/jpeg" &&
		move_uploaded_file($_FILES[$name]["tmp_name"], $destination);
}

function getCart($uid) {
	if (isset($_COOKIE[$uid]) && $list = json_decode($_COOKIE[$uid], true)) {
		if (count($list["products"])) {
			$ids = array_column($list["products"], "productId");
			$quantities = array_column($list["products"], "quantity");
			return array_combine($ids, $quantities);
		}
	}
	return [];
}

function broadcast_vendor($message) {
	global $db;
	foreach ($db->getVendorIds() as $vendor)
		$db->addMessage($vendor, $message);
}

?>