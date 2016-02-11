<div class="" id="menu_left">
	<ul class="side-nav">
		<?php
			if(isset($_SESSION["loggato"]) && $_SESSION["loggato"]==100){
		?>
			<li> <a href="<?php echo LOCAL?>/admin/index.php?logout=1" ><i class="icon-signout"></i> Logout</a> </li>
			<li> <a href="<?php echo LOCAL?>/admin/index.php?change_pwd=1" ><i class="icon-exchange"></i> Cambia Password</a> </li>
			<li class="divider"></li>
		<?php
			}
		?>
		<li class="title"><span>PRODOTTI</span>
			<ul>
				<div class="title_div">
					<li> <a href=<?php echo PATHUTILITIES."tipo"; ?>><i class="icon-plus"></i> Gestisci Tipi di prodotto</a> </li>
					<li> <a href=<?php echo PATHUTILITIES."ingredienti"; ?>><i class="icon-plus"></i> Gestisci Ingredienti</a> </li>
					<li> <a href=<?php echo PATHUTILITIES."prodotti"; ?>><i class="icon-plus"></i> Gestisci Prodotti</a> </li>
				</div>
			</ul>
		</li>
		<li class="divider"></li>
</div>
