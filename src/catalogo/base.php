<header>
	<nav class="flex-container">
		<div class="flex-1">
			<a id="logo-img" href="index.php"><img style="width:100px" src="./img/logo.png" alt=""></a>
			<h1><a href="index.php">UniBonsai</a></h1>
			<button class="icon" id="expand-menu"><i class="fa fa-bars"></i></button>
		</div>
		<div class="flex-2">
			<ul id="menu">
				<?php if ($vars["logged"]): ?>
				<li><a href="notifiche.php"><i class="fa fa-bell-o"></i> Notifiche</a></li>
				<?php endif ?>
				<li>
					<a href="?action=user&mode=<?php echo $vars["logged"] ? "profile" : "login" ?>">
						<i class="fa fa-<?php echo $vars["logged"] ? "user-circle-o" : "sign-in" ?>"></i>
						<?php echo $vars["user"]?>
					</a>
				</li>
				<li>
					<a href="?action=user&mode=<?php echo $vars["logged"] ? "logout" : "subscribe" ?>">
						<i class="fa fa-<?php echo $vars["logged"] ? "sign-out" : "id-card-o" ?>"></i>
						<?php echo $vars["logged"] ? "Logout" : "Registrati" ?>
					</a>
				</li>
			</ul>
		</div>
	</nav>
</header>
<aside>
	<div id="sidenav" class="pt-3">
		<button class="icon" id="close-search"><i class="fa fa-arrow-left"></i></button>
		<div id="accordion" class="mt-3">
			<div>
				<h2 class="header m-0">
					<a class="collapsed" data-bs-toggle="collapse" href="#search-1">Forma</a>
				</h2>
				<div id="search-1" class="collapse" data-bs-parent="#accordion">
					<div class="body m-0 py-3">
						<label><input type="checkbox" value=""> Forma 1</label>
						<label><input type="checkbox" value=""> Forma 2</label>
						<label><input type="checkbox" value=""> Forma 3</label>
					</div>
				</div>
			</div>
			<div>
				<h2 class="header m-0">
					<a class="collapsed" data-bs-toggle="collapse" href="#search-2">Dimensione</a>
				</h2>
				<div id="search-2" class="collapse" data-bs-parent="#accordion"> 
					<div class="body m-0 py-3">
						<label><input type="checkbox" value=""> Dimensione 1</label>
						<label><input type="checkbox" value=""> Dimensione 2</label>
						<label><input type="checkbox" value=""> Dimensione 3</label>
					</div>
				</div>
			</div>
			<div>
				<h2 class="header m-0">
					<a class="collapsed" data-bs-toggle="collapse" href="#search-3">Prezzo</a>
				</h2>
				<div id="search-3" class="collapse" data-bs-parent="#accordion">
					<div class="body m-0 py-3">
						<input type="range" min="1" max="200" value="200" id="slider" />
						<label>Prezzo max: <span id="search-value">200</span></label>
					</div>
				</div>
			</div>
		</div>
		<button type="button" class="btn btn-secondary mt-3" id="cerca">Applica</button>
	</div>
</aside>
<main>
	<div id="filters">
		<button title="Filtri" class="icon" id="search-button"><i class="fa fa-search"></i></button>
		Filtri correnti: "<span id="current-filters">nessuno</span>"
	</div>
	<?php echo "UTENTE: " . ($db->getUserById($_SESSION["uid"] ?? -1) ?: "NON LOGGATO") ?>	
</main>