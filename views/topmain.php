
			<div class='themain white'>
				<h3 class='titlethis'> Weather Information </h3>
				<div class='mainhead'>
					<div class='headline'>
						<div class='dateholder'>
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

