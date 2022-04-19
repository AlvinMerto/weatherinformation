			<div class='bodyline'>
				<div class='divcatcher'>
					<div class='todaydiv'>
						<h2 class='blueit'> <?php echo $data['bodyline']['name']; ?> </h2>
						<h3 class='grayit'>  <?php echo $data['bodyline']['addr']; ?> </h3>
					</div>
					<div class='todayweather'>
						<h2 class='blueit'> 
							<?php echo $data['bodyline']['theweather']['list'][0]->main->temp; ?> 
							<img style='margin-left: -22px;' src='http://openweathermap.org/img/w/<?php echo $data['bodyline']['theweather']['list'][0]->weather[0]->icon; ?>.png'/> 
							</h2>
						<h3 class='grayit' style='font-size: .9rem;'> 
							<?php echo $data['bodyline']['theweather']['list'][0]->weather[0]->description; ?>  
						</h3>
						<h3 class='blueit'> <?php echo "Today";// $data['bodyline']['theweather']['list'][0]->weather[0]->description; ?>  </h3>
					</div>
				</div>
				<div class='divcatcher'>
					<?php 

						for($i = 1; $i <= 3 ; $i++) {
							$timestamp   = $data['bodyline']['theweather']['list'][$i]->dt;
							$weatherdesc = $data['bodyline']['theweather']['list'][$i]->weather[0]->description;
							$wtemp       = $data['bodyline']['theweather']['list'][$i]->main->temp;
							$theicon     = "<img style='margin-bottom: -22px;' src='http://openweathermap.org/img/w/".$data['bodyline']['theweather']['list'][$i]->weather[0]->icon.".png'/>";
							echo "<div>
									<h3 class='blueit'> ".gmdate("h:i A", $timestamp)." </h3>
									<h4> <span class='blueit'> {$wtemp} </span> - {$theicon} <span class='grayit'> {$weatherdesc} </span> </h4>
								  </div>";
						}

					?>
				</div>
				<div class='divcatcher'>
					<div>
						<h4 class='blueit'> Categories </h4>
						<ol class='categs'>
							<?php 
								foreach($data['bodyline']['categs'] as $ls) {
									echo "<li>".$ls."</li>";
								}
							?>
						</ol>
					</div>
				</div>
			</div>

	