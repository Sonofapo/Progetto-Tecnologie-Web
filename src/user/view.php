<header>
	<h1><a href="index.php" title="home">UniBonsai</a></h1>
</header>
<main>
<?php echo get_include_contents("./src/templates/prompt.php") ?>
	<div class="container-fluid mt-3">
		<div class="row text-center">
			<div class="col-10 col-md-8 col-lg-6 col-xl-4
				offset-1 offset-md-2 offset-lg-3 offset-xl-4 
				py-3 px-5 border border-dark rounded">
				<img id="login-img" src="./img/logo.png" alt="" />
				<h2><?php echo $vars["isLogin"] ? "Accesso" : "Registrazione" ?></h2>
				<form action="index.php" method="post">
					<input type="hidden" name="action" value="user" />
					<input type="hidden" name="mode" value="<?php echo $vars["isLogin"] ? "login" : "subscribe"?>" />
					
					<label for="username">Username:</label>
					<input class="form-control mb-3" type="text" id="username" name="username" required />
					
					<label for="password">Password:</label>
					<input class="form-control mb-3" type="password" id="password" name="password" required />
					
					<button class="btn btn-success mb-3" type="submit">
						<?php echo $vars["isLogin"] ? "accedi" : "registrati"?>
					</button>
				</form>
				<p class="m-0">
					oppure
					<a href="index.php?action=user&mode=<?php echo $vars["isLogin"] ? "subscribe" : "login" ?>"
						title="<?php echo $vars["isLogin"] ? "registrati" : "accedi"?>">
						<?php echo $vars["isLogin"] ? "registrati" : "accedi"?>
					</a>
				</p>
			</div>
		</div>
	</div>
</main>