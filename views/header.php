<?php
	if(session_status()==PHP_SESSION_NONE){
		session_start();
	}
?>
<!DOCTYPE html>
<!DOCTYPE php>

<html>
<head>
    <title>Header</title>
    <meta charset="utf-8">
</head>


<body>

   	<header>
		<h1>Welcome to Cookingly</h1>
	</header>
	<nav>
		<ul>
		    <li><a href="index.php?controle=controllers&action=fridge">Home</a></li>
		    <li><a href="index.php?controle=controllers&action=profile">Profile</a></li>
		    <li><a href="index.php?controle=controllers&action=signOut">Sign out</a></li>
		</ul> 
	</nav>

	<?php if(isset($_SESSION['flash'])):>
		<?php foreach($_SESSION['flash'] as $type => $message):?>
			<div class="alert alert-<?=$type;?>">
				<?= $message;?>
			</div>
		<?php endforeach;?>
		<?php unset($_SESSION['flash']);?>
		<?php endif; ?>
</body>
</html>
