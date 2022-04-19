<?php 
	class getcityinfo {
		private $theinfo;

		private $thenear;
		private $count = 0;

		private $thedata;

		public function __construct($near) {
			$client = new \GuzzleHttp\Client();

			$response = $client->request("GET","https://api.foursquare.com/v3/places/search?near=".$near, $this->header());

			$this->thenear = $near;
			$this->theinfo = (array) json_decode($response->getBody());
		}

		private function header() {
			return [
				  'headers' => [
				    'Accept' => 'application/json',
				    'Authorization' => 'fsq356vhyphigtsXhdEGLX2lFO3SA5g5NvGDyxxsxOL9Sw8=',
				  ]
				];
		}

		public function details() {
			return $this->theinfo;
		}

		public function returntopthemain() {
			$data['topmain']['thenear']   = $this->thenear;
			$data['topmain']['datetoday'] = date("m/d/Y");

		// 	if (isset($this->theinfo['results'][$this->count]->location->country)) {
				$data['topmain']['locality']  = $this->theinfo['results'][0]->location->country;
		//	}

			return $data;
		}

		public function returnbodyline() {
			if ($this->count > count($this->theinfo['results'])-1) {
				return true;
			}

			$data = [];
			
			$data['bodyline']['name'] = $this->theinfo['results'][$this->count]->name;
						
			$data['bodyline']['addr'] = $this->theinfo['results'][$this->count]->location->formatted_address;
			
			$lat  = $this->theinfo['results'][$this->count]->geocodes->main->latitude;
			$long = $this->theinfo['results'][$this->count]->geocodes->main->longitude;

			$data['bodyline']['theweather'] = $this->gettheweather($lat, $long);
			
			$data['bodyline']['categs'] = [];
				foreach($this->theinfo['results'][$this->count]->categories as $ss) {
					array_push($data['bodyline']['categs'], $ss->name);
				}

			if ($this->count <= count($this->theinfo['results'])-1) {
				$this->count += 1;
				$this->preparetable($data);
				$this->returnbodyline();
			}
			
		}

		private function gettheweather($lat, $long) {
			$apiid = "4218ceae9456d31075452b351a22c17b";
			$url   = "http://api.openweathermap.org/data/2.5/forecast?lat={$lat}&lon={$long}&appid={$apiid}";
			$ch    = curl_init();

			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			$contents = curl_exec($ch);

			return (array) json_decode($contents);	
		}

		private function preparetable($data) {
			$this->thedata .= "<div class='bodyline'>
					<div class='divcatcher'>
						<div class='todaydiv'>
							<h2 class='blueit'> {$data['bodyline']['name']} </h2>
							<h3 class='grayit'> {$data['bodyline']['addr']} </h3>
						</div>
						<div class='todayweather'>
							<h2 class='blueit'> 
								{$data['bodyline']['theweather']['list'][$this->count]->main->temp} 
								<img style='margin-left: -22px;' src='http://openweathermap.org/img/w/{$data['bodyline']['theweather']['list'][$this->count]->weather[0]->icon}.png'/> 
								</h2>
							<h3 class='grayit' style='font-size: .9rem;'> 
								{$data['bodyline']['theweather']['list'][$this->count]->weather[0]->description}
							</h3>
							<h3 class='blueit'>Today </h3>
						</div>
					</div>
					<div class='divcatcher'>";
						

							for($i = 1; $i <= 3 ; $i++) {
								$timestamp   = $data['bodyline']['theweather']['list'][$i]->dt;
								$weatherdesc = $data['bodyline']['theweather']['list'][$i]->weather[0]->description;
								$wtemp       = $data['bodyline']['theweather']['list'][$i]->main->temp;
								$theicon     = "<img style='margin-bottom: -22px;' src='http://openweathermap.org/img/w/".$data['bodyline']['theweather']['list'][$i]->weather[0]->icon.".png'/>";
								$this->thedata .= "<div>
										<h3 class='blueit'> ".gmdate("h:i A", $timestamp)." </h3>
										<h4> <span class='blueit'> {$wtemp} </span> - {$theicon} <span class='grayit'> {$weatherdesc} </span> </h4>
									  </div>";
							}

			$this->thedata .= "
					</div>
					<div class='divcatcher'>
						<div>
							<h4 class='blueit'> Categories </h4>
							<ol class='categs'>";			
									foreach($data['bodyline']['categs'] as $ls) {
										$this->thedata .= "<li>".$ls."</li>";
									}
			$this->thedata .= "					
							</ol>
						</div>
					</div>
				</div>";
		}

		public function displaytheinfo() {
			return $this->thedata;
		}
	}
?>