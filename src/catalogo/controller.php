<?php
	switch ($vars["mode"]) {
		case "show":
			$vars["products"] = $db->getProducts();
			$content = get_include_contents("./src/catalogo/view.php");
			break;			
		case "filter":
			$shapes	= $_REQUEST["shape"] ?? [];
			$sizes	= $_REQUEST["size"] ?? [];
			$price	= $_REQUEST["price"] ?? null;

			$filteredIDs = $db->filter($shapes, $sizes, $price);
			$vars["products"] = $db->getProducts($filteredIDs);

			$shapes = array_map("get_icon", $shapes);
			$sizes  = array_map("get_icon", $sizes);
			$vars["filters"]  = count($shapes) ? join(", ", $shapes) . " | " : "";
			$vars["filters"] .= count($sizes) ? join(", ", $sizes) . " | " : "";
			$vars["filters"] .= $price ? "Max: ${price}€" : "";
			$content = get_include_contents("./src/catalogo/view.php");
			break;
		case "cart":
			if (isset($_COOKIE[$UID]) && $list = json_decode($_COOKIE[$UID])) {
				$ids = array_map("split_id", $list);
				$qty = array_count_values($ids);
				foreach ($db->getProducts(array_unique($ids)) as $product) {
					$product["quantity"] =  $qty[$product["id"]];
					$vars["products"][] = $product;
				}
			}
			$content = get_include_contents("./src/catalogo/cart.php");
			break;
		case "purchase":
			if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE[$UID]) && $list = json_decode($_COOKIE[$UID])) {
				$vars["cards"] = $db->getCards($_SESSION["uid"]);
				$content = get_include_contents("./src/catalogo/purchase.php");
			} else {
				$content = get_include_contents("./src/catalogo/view.php");
			}
			break;
		default:
			die("Pagina non disponibile.");
	}
	$vars["body"] = $content;
?>