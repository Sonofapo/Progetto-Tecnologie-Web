<?php echo get_include_contents("./src/templates/header.php") ?>
<main>
	<?php echo get_include_contents("./src/templates/prompt.php") ?>
	<h2 class="text-center mt-3">Procedi al pagamento</h2>
	<div class="col-10 col-md-8 col-lg-6 col-xl-4
		offset-1 offset-md-2 offset-lg-3 offset-xl-4">
		<form action="index.php" method="post">
			<input type="hidden" name="action" value="user" />
			<input type="hidden" name="mode" value="buy" />

			<label for="name">Titolare</label>
			<input class="form-control mb-3" type="text" id="name" name="name"
				pattern="[a-zA-Z\s]{1,50}" maxlength="50" />

			<label for="pan">Numero carta</label>
			<input class="form-control mb-3" type="tel" id="pan" name="pan"
				inputmode="numeric" pattern="[0-9\s]{19}" maxlength="19" />

			<label for="cvv">CVV</label>
			<input class="form-control mb-3" type="tel" id="cvv" name="cvv"
				inputmode="numeric" pattern="[0-9]{3}" maxlength="3" />

			<label for="date">Data di scadenza</label>
			<input class="form-control mb-3 min-today" type="date" id="date" name="date" />

			<div class="text-center my-4">oppure</div>
			<label for="cards">Seleziona una delle tue carte</label>
			<select name="cards" class="form-select" id="cards">
				<option disabled selected value="">Carte</option>
				<?php foreach ($vars["cards"] as $card) : ?>
				<option value="card-<?php echo $card["id"] ?>">
				<?php echo $card["name"] . " *" . substr($card["pan"], -4, 4) ?>
				</option>
				<?php endforeach ?>
			</select>

			<div class="text-center mt-4">
				<button class="btn btn-success" type="submit" title="acquista">Acquista</button>
			</div>
		</form>
	</div>
</main>
