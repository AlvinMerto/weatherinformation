<html>
	<head>
		<title> Weather Information System </title>
		<link rel='stylesheet' href="assets/css/style.css" />
	</head>
	<body>
		<div class='wrapper'>

			<?php
				require_once('vendor/autoload.php');
				require_once("assets/controller/apicall.php");

				$near = $_GET['city'];
				$ac   = new getcityinfo($near);

			?>	

			<div class='tabs'>
				<div class='leftsidetab'>
					<div class='leftsidetab'>
						<!-- the main -->
						<div class='themain white'>
							<h3 class='titlethis'> Weather Information </h3>
							<div class='mainhead'>
								<div class='headline'>
									<div class='dateholder'>
										<?php $data = $ac->returntopthemain(); ?>
										<h4> <?php echo date("F d", strtotime($data['topmain']['datetoday'])); ?> </h3>
										<h3> <?php echo date("Y", strtotime($data['topmain']['datetoday'])); ?> </h4>
										<h5> <?php echo date("D", strtotime($data['topmain']['datetoday'])); ?> </h5>
									</div>
									<div class='locationholder'>
										<h2> <?php echo $data['topmain']['thenear']; ?> </h2>
										<h3> <?php echo $data['topmain']['locality']; ?> </h3>
									</div>
								</div>
							</div>
						</div>
						<!-- end -->
						<?php 
							$ac->returnbodyline();
							echo $ac->displaytheinfo();
						?>

					</div>
				</div>

				<?php include_once("views/righttab.php"); ?>	
			</div>
		</div>
	</body>
	<footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src='assets/js/procs.js'></script>
	</footer>
</html>
