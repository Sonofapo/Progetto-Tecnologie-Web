<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
	<section>
		<?php if (isset($vars["products"])) : ?>
		<div id="sec-header">
			<h3>Il tuo carrello</h3>
			<div>
				<button class="btn btn-danger" id="empty-cart">Svuota</button>
			</div>
		</div>
		<div id="product-list">
			<?php $total = 0 ?>
			<?php foreach ($vars["products"] as $product) : ?>
			<?php $total += $product["price"] * $product["quantity"] ?>
			<div class="product-card">
				<div class="product-img">
					<img src="<?php echo $vars["IMG_PATH"].$product["path"] ?>" alt="" />
				</div>
				<div class="product-info">
					<p class="product-name"><?php echo ucfirst($product["name"]) ?></p>
					<p>
						Quantità: <?php echo $product["quantity"] ?> -
						Prezzo: <?php echo $product["price"] * $product["quantity"] ?>&euro;
					</p>
					<button class="remove-from-cart btn btn-danger" id="prod-<?php echo $product["id"] ?>">
						Rimuovi
					</button>
				</div>
			</div>
			<?php endforeach ?>
		</div>
		<div class="text-center mt-4">
			<p>Totale: <?php echo $total ?>&euro;</p>
			<a class="btn btn-success" href="?action=catalogo&mode=purchase">Acquista</a>
		</div>
		<?php else: ?>
		<h2>Il tuo carrello è vuoto</h2>
		<?php endif ?>
	</section>
</main>