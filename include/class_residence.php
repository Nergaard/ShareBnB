<?php

	class Residence {
		public function insert_new_residence($headline, $address, $zipcode, $city, $country, $price, $size, $bedrooms, $main_sleeps, $extra_sleeps, $residence_type, $description, $img, $owner_email, $subleaser_email) {
			global $pdo;

			// Henter ellevante verdier for databasen ut fra input variablene
			$residence_type_int = $this->get_int_from_residence_type($residence_type);
			$owner = (int)$this->get_user_id_by_email($owner_email);
			$subleaser = (int)$this->get_user_id_by_email($subleaser_email);

			// Caster verdier som skal være int til int fra string
			$zipcode = (int)$zipcode;
			$price = (int)$price;
			$size = (int)$size;
			$bedrooms = (int)$bedrooms;
			$main_sleeps = (int)$main_sleeps;
			$extra_sleeps = (int)$extra_sleeps; 

			// Setter residence inn i DB
			$query = $pdo->prepare("INSERT INTO residence (
														residence_address, 
														residence_zipcode, 
														residence_city, 
														residence_contry, 
														residence_type, 
														residence_price, 
														residence_size, 	
														residence_bedrooms, 
														residence_main_sleeps, 
														residence_extra_sleeps, 
														residence_headline, 
														residence_description, 
														residence_main_img_ID, 
														residence_owner_user_ID,
														residence_subleaser_user_ID
														) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

			$query->bindValue(1, $address);
			$query->bindValue(2, $zipcode);
			$query->bindValue(3, $city);
			$query->bindValue(4, $country);
			$query->bindValue(5, $residence_type_int);
			$query->bindValue(6, $price);
			$query->bindValue(7, $size);
			$query->bindValue(8, $bedrooms);
			$query->bindValue(9, $main_sleeps);
			$query->bindValue(10, $extra_sleeps);
			$query->bindValue(11, $headline);
			$query->bindValue(12, $description);
			$query->bindValue(13, $img);
			$query->bindValue(14, $owner);
			$query->bindValue(15, $subleaser);
			$query->execute();
			
			// Sjekker om det er lastet opp et bilde. 
			if (!empty($img)) {
				// Setter inn foregn key fra img til residence for hovedbildet til residencen
				$query = $pdo->prepare("UPDATE img SET img_residence_ID = (SELECT residence_ID FROM residence WHERE residence_main_img_ID = ?) WHERE img_ID = ?");
				$query->bindValue(1, $img);
				$query->bindValue(2, $img);
				$query->execute();
			}
		}

		public function update_residence($residence_ID, $headline, $address, $zipcode, $city, $country, $price, $size, $bedrooms, $main_sleeps, $extra_sleeps, $residence_type, $description, $owner_email, $subleaser_email) {
			global $pdo;
			// Henter ellevante verdier for databasen ut fra input variablene
			$residence_type_int = $this->get_int_from_residence_type($residence_type);
			$owner = (int)$this->get_user_id_by_email($owner_email);
			$subleaser = (int)$this->get_user_id_by_email($subleaser_email);

			// Caster verdier som skal være int til int fra string
			$zipcode = (int)$zipcode;
			$price = (int)$price;
			$size = (int)$size;
			$bedrooms = (int)$bedrooms;
			$main_sleeps = (int)$main_sleeps;
			$extra_sleeps = (int)$extra_sleeps; 

			// Setter residence inn i DB
			$query = $pdo->prepare("UPDATE residence SET residence_address = ?, 
														residence_zipcode = ?, 
														residence_city = ?, 
														residence_contry = ?, 
														residence_type = ?, 
														residence_price = ?, 
														residence_size = ?,
														residence_bedrooms = ?, 
														residence_main_sleeps = ?, 
														residence_extra_sleeps = ?, 
														residence_headline = ?, 
														residence_description = ?, 
														residence_owner_user_ID = ?,
														residence_subleaser_user_ID = ?
														WHERE residence_ID = ?");

			$query->bindValue(1, $address);
			$query->bindValue(2, $zipcode);
			$query->bindValue(3, $city);
			$query->bindValue(4, $country);
			$query->bindValue(5, $residence_type_int);
			$query->bindValue(6, $price);
			$query->bindValue(7, $size);
			$query->bindValue(8, $bedrooms);
			$query->bindValue(9, $main_sleeps);
			$query->bindValue(10, $extra_sleeps);
			$query->bindValue(11, $headline);
			$query->bindValue(12, $description);
			$query->bindValue(13, $owner);
			$query->bindValue(14, $subleaser);
			$query->bindValue(15, $residence_ID);
			$query->execute();
		}

		public function residence_rent($time_from, $time_to, $rented_by, $residence_ID, $residence_administrator) {
			global $pdo;
			$query = $pdo->prepare("INSERT INTO rental (
									rental_time_from, 
									rental_time_to, 
									rental_rented_by,
									rental_residence_ID,
									rental_admin_ID
									) VALUES (?, ?, ?, ?, ?)");
				$query->bindValue(1, $time_from);
				$query->bindValue(2, $time_to);
				$query->bindValue(3, $rented_by);
				$query->bindValue(4, $residence_ID);
				$query->bindValue(5, $residence_administrator);
				$query->execute();
		}

		public function rental_aprove_by_owner($owner_id, $rental_id) {
			global $pdo;
			$query = $pdo->prepare("UPDATE rental SET rental_approved_by = ? WHERE rental_ID = ?");
			$query->bindValue(1, $owner_id);
			$query->bindValue(2, $rental_id);
			$query->execute();
		}

		public function rental_aprove_by_renter($renter_id, $rental_id) {
			global $pdo;
			$query = $pdo->prepare("UPDATE rental SET rental_approved_by_user = ? WHERE rental_ID = ?");
			$query->bindValue(1, $renter_id);
			$query->bindValue(2, $rental_id);
			$query->execute();
		}

		public function insert_contract_name($pdf_name, $rental_id) {
			global $pdo;
			$query = $pdo->prepare("UPDATE rental SET rental_contract = ? WHERE rental_ID = ?");
			$query->bindValue(1, $pdf_name);
			$query->bindValue(2, (Int)$rental_id);
			$query->execute();
		}

		private function get_int_from_residence_type($residence) {
			switch ($residence) {
				case "house":
					return 1;
				case "flat":
					return 2;
				case "room_private":
					return 3;
				case "room_shared":
					return 4;
			}
		}

		public function get_residence_type_from_int($residence) {
			switch ($residence) {
				case 1:
					return "house";
				case 2:
					return "flat";
				case 3:
					return "room_private";
				case 4:
					return "room_shared";
			}
		}
		public function get_residence_rating($resID) {
			global $pdo;
			$resID=(int)$resID;
			$query = $pdo->prepare("SELECT residence_rating/residence_rating_count FROM residence WHERE residence_ID=?");
			$query->bindValue(1,$resID);
			$query->execute();
			return $query->fetch()[0];
		}
		public function get_residence_rating_count($resID) {
			global $pdo;
			$resID=(int)$resID;
			$query = $pdo->prepare("SELECT residence_rating_count FROM residence WHERE residence_ID=?");
			$query->bindValue(1,$resID);
			$query->execute();
			return $query->fetch()[0];
		}
		
	//     public function get_img_link_from_imgID($img) {
	//         global $pdo;
	//         $img = (Int)$img;
	//         $query = $pdo->prepare("SELECT img_link FROM img WHERE img_ID = ?");
	//         $query->bindValue(1, $img);
	//         $query->execute();
			
	//     return $query->fetch();
	// }

		public function get_stars_from_float($residence_rating) {
			switch ((int)$residence_rating) {
				case 1:
					return "*";
				case 2:
					return "**";
				case 3:
					return "***";
				case 4:
					return "****";
				case 5:
					return "*****";
			}
		}
		////////
		public function get_message_to_a_user($userID) {
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM chat WHERE chat_to_user_ID = ?"); 
			$query->bindValue(1, $userID);
			$query->execute(); 
			
			return $chat = $query->fetchAll();
		}


		public function get_user_id_by_email($email) {
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM user WHERE user_email = ?"); 
			$query->bindValue(1, $email);
			$query->execute(); 
			$user = $query->fetch();
			return $user['user_ID'];
		}

		public function search_by_id($userID) {
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM residence 
									WHERE residence_owner_user_ID = ? OR residence_subleaser_user_ID = ?");
			$query->bindValue(1, $userID);
			$query->bindValue(2, $userID);
			$ex = $query->execute(); //execution of the query
			$count = count($ex); //count the number of result rows
			// $count = (int)$query->fetchColumn();
			
			if($count == 0){
				echo '<section class="cardcontainer">Ingen leiligheter funnet</section>';
				$output ='No results';
			}
			else {
				foreach ($query as $this_residence) {
					$type;
					if($this_residence['residence_owner_user_ID'] == $userID){
						$type = "Owned";
					}else{
						$type = "Subletting";
					}
					$this->print_card_sml_owned($this_residence['residence_ID'], $this_residence['residence_main_img_ID'], $this_residence['residence_rating'], $this_residence['residence_address'],$this_residence['residence_price'], $this_residence['residence_active_status'], $type);
				}
			}
		}


		public function search_by_city($city) {
			global $pdo;
			$query = $pdo->prepare("SELECT * FROM residence 
									WHERE residence_city = ?");
			$query->bindValue(1, $city);
			$query->execute();
			$count = (int)$query->fetchColumn();
			
			if($count == 0){
				$output ='No results';
			}
			else {


				foreach ($query as $all_residences[$i]) {
					$this->print_card_sml($all_residences[$i]['residence_main_img_ID'], $all_residences[$i]['residence_rating'], $all_residences[$i]['residence_headline'], $all_residences[$i]['residence_description'],$all_residences[$i]['residence_price']);
				}
			}
		}

			public function get_img_link_from_imgID($img) {
				global $pdo;
				$img = (Int)$img;
				$query = $pdo->prepare("SELECT img_link FROM img WHERE img_ID = ?");
				$query->bindValue(1, $img);
				$query->execute();
				
			return $query->fetch();
		}

			private function is_apt_active($residenceStatus){
				 switch ((int)$residenceStatus) {
					case 0:
						return "Available";
					case 1:
						return "Rented out";
				}
			}
			
			
		public function print_card_sml($img, $rating, $headline, $description, $price) {
			$img = $this->get_img_link_from_imgID($img);
			$rating = $this->get_stars_from_float($rating);

			echo '<section class="card_sml">';
			echo '<a href="?pg=search">';
			echo '<img src="img/uploads/',$img[0],'" alt="">';
			echo '</a>';
			echo '<article>';
			echo '<h4>',$rating,'</h4>';
			echo '<h1>',$headline,'</h1>';
			echo '<p>',$description,'</p>';
			echo '<h3>Kr ',$price,',-</h3>';
			echo '</article>';
			echo '</section>';
		}
			
		public function fetch_residence_by_id($residence_ID) {
			global $pdo;

			// Sjekker om det residencen har en tilhørende subleaser
			$query = $pdo->prepare("SELECT residence_subleaser_user_ID FROM residence WHERE residence_ID = ?");
			$query->bindValue(1, (Int)$residence_ID);
			$query->execute();
			$quer = $query->fetch();

			// Henter data inklusiv/eksklusiv subleaser
			if ($quer['residence_subleaser_user_ID'] == 0) {
				$query = $pdo->prepare("SELECT * FROM residence
											JOIN (SELECT user_ID AS owner_ID, user_email AS owner_email FROM user) AS owner 
												ON owner.owner_ID = residence.residence_owner_user_ID
										WHERE residence_ID = ?
										");
			} else {
				$query = $pdo->prepare("SELECT * FROM residence
											JOIN (SELECT user_ID AS owner_ID, user_email AS owner_email FROM user) AS owner 
												ON owner.owner_ID = residence.residence_owner_user_ID
											JOIN (SELECT user_ID AS subleaser_ID, user_email AS subleaser_email FROM user) AS subleaser 
												ON subleaser.subleaser_ID = residence.residence_subleaser_user_ID
										WHERE residence_ID = ?
										");
			}

			$query->bindValue(1, (Int)$residence_ID);
			$query->execute();
			return $query->fetch();
		}


		public function search_by_city_v2($city) {
			global $pdo;
			

			$query = $pdo->prepare("SELECT 
				r.residence_ID, 
				r.residence_address, 
				r.residence_zipcode, 
				r.residence_city,
				r.residence_contry,
				r.residence_type, 
				r.residence_price,
				r.residence_size,
				r.residence_bedrooms,
				r.residence_main_sleeps,
				r.residence_extra_sleeps,
				r.residence_headline,
				r.residence_main_img_ID,
				img.img_link,
				r.residence_rating,
				r.residence_rating_count
				FROM residence as r
					inner join img
					on r.residence_main_img_ID = img.img_ID
					WHERE r.residence_active_status = 1 AND r.residence_city = ?");

			$query->bindValue(1, $city);
			$query->execute();
			$query = $query->fetchAll();
			$this->create_js_search_response($query);
		}


		public function search_by_city_and_date($city, $date_from, $date_to) {
			global $pdo;
			
			$query = $pdo->prepare("SELECT 
										r.residence_ID, 
										r.residence_address, 
										r.residence_zipcode, 
										r.residence_city,
										r.residence_contry,
										r.residence_type, 
										r.residence_price,
										r.residence_size,
										r.residence_bedrooms,
										r.residence_main_sleeps,
										r.residence_extra_sleeps,
										r.residence_headline,
										r.residence_main_img_ID,
										i.img_link,
										r.residence_rating,
										r.residence_rating_count
									FROM (
										SELECT *
										FROM (SELECT rental_residence_ID from rental
											WHERE (rental_time_from >= ? AND rental_time_from <= ?) 
												OR (rental_time_to >= ? AND rental_time_to <= ?)) AS rnt
											RIGHT JOIN 
												(SELECT * FROM residence 
												WHERE residence_active_status = 1 
													AND residence_city = ?) AS res 
											ON rnt.rental_residence_ID = res.residence_ID
											WHERE rnt.rental_residence_ID IS NULL) AS r
									join (SELECT img_ID, img_link FROM img) AS i
									on r.residence_main_img_ID = i.img_ID");
	
			$query->bindValue(1, $date_from);
			$query->bindValue(2, $date_to);
			$query->bindValue(3, $date_from);
			$query->bindValue(4, $date_to);
			$query->bindValue(5, $city);
			$query->execute();
			$query = $query->fetchAll();
			$this->create_js_search_response($query);
		}


		public function create_js_search_response($all_residences) {
			echo '<script>';
			echo 'let search_query_result = [';
			$num_of_res = count($all_residences);

				for ($i = 0; $i < $num_of_res; $i++) {
					$mem_beds_total = ((Int)$all_residences[$i]['residence_main_sleeps']) + ((Int)$all_residences[$i]['residence_extra_sleeps']);
					echo '{';
						echo '"r_ID":"',$all_residences[$i]['residence_ID'],'",';
						echo 'r_address:"',$all_residences[$i]['residence_address'],'",';
						echo 'r_zipcode:"',$all_residences[$i]['residence_zipcode'],'",';
						echo 'r_city:"',$all_residences[$i]['residence_city'],'",';
						echo 'r_contry:"',$all_residences[$i]['residence_contry'],'",';
						echo 'r_type:"',$all_residences[$i]['residence_type'],'",';
						echo 'r_price:"',$all_residences[$i]['residence_price'],'",';
						echo 'r_size:"',$all_residences[$i]['residence_size'],'",';
						echo 'r_bedrooms:"',$all_residences[$i]['residence_bedrooms'],'",';
						echo 'r_sleeps_total:"',$mem_beds_total,'",';
						echo 'r_sleeps_main:"',$all_residences[$i]['residence_main_sleeps'],'",';
						echo 'r_sleeps_extra:"',$all_residences[$i]['residence_extra_sleeps'],'",';
						echo 'r_headline:"',$all_residences[$i]['residence_headline'],'",';
						echo 'r_img_ID:"',$all_residences[$i]['residence_main_img_ID'],'",';
						echo 'r_rating:"',$all_residences[$i]['residence_rating'],'",';
						$stars = ceil($all_residences[$i]['residence_rating']/$all_residences[$i]['residence_rating_count']);
						if ((int)$all_residences[$i]['residence_rating_count'] == 0) {
							echo 'r_rating_print:"',$this->get_stars_from_float(3),'",';
						}
						else { 

							echo 'r_rating_print:"',$this->get_stars_from_float($stars),'",';
						}
						echo 'r_rating_count:"',$all_residences[$i]['residence_rating_count'],'",';
						echo 'r_img:"',$all_residences[$i]['img_link'],'"';
					echo '}';
					if ($i != $num_of_res-1) {
						echo ',';
					}
				}

				echo '];';
			echo '</script>';
			
			?>
			<script>
				search_query_result.forEach(res => {
					// Setter min og max pris variabler
					let mem_price = Number(res.r_price);
					if (mem_price < price_lowest) {
						price_lowest = mem_price
					} else if (mem_price > price_highest) {
						price_highest = mem_price
					}
					// Setter min og max størrelse variabler
					let mem_size = Number(res.r_size);
					if (mem_size < size_lowest) {
						size_lowest = mem_size
					} else if (mem_size > size_highest) {
						size_highest = mem_size
					}
					// Setter min og max soveplass variabler
					let mem_sleeps = Number(res.r_sleeps_total);
					if (mem_sleeps < sleeps_lowest) {
						sleeps_lowest = mem_sleeps
					} else if (mem_sleeps > sleeps_highest) {
						sleeps_highest = mem_sleeps
					}

					print_residence_to_cardcontainer(res);

				});

				// Setter min pris slider/filter verdier
				document.getElementById('range_price_min').value = price_lowest;
				document.getElementById('range_price_min').min = price_lowest;
				document.getElementById('range_price_min').max = price_highest;
				

				// Setter maks pris slider/filter verdier
				document.getElementById('range_price_max').value = price_highest;
				document.getElementById('range_price_max').min = price_lowest;
				document.getElementById('range_price_max').max = price_highest;
				
				// Setter min og maks pris slider tekst verdier
				document.getElementById('range_price_min_output').innerHTML = price_lowest;
				document.getElementById('range_price_max_output').innerHTML = price_highest;




				// Setter min size slider/filter verdier
				document.getElementById('range_size_min').value = size_lowest;
				document.getElementById('range_size_min').min = size_lowest;
				document.getElementById('range_size_min').max = size_highest;

				// Setter maks prsizeis slider/filter verdier
				document.getElementById('range_size_max').value = size_highest;
				document.getElementById('range_size_max').min = size_lowest;
				document.getElementById('range_size_max').max = size_highest;
				
				// Setter min og maks size slider tekst verdier
				document.getElementById('range_size_min_output').innerHTML = size_lowest;
				document.getElementById('range_size_max_output').innerHTML = size_highest;




				// Setter min size slider/filter verdier
				document.getElementById('range_sleeps_min').value = sleeps_lowest;
				document.getElementById('range_sleeps_min').min = sleeps_lowest;
				document.getElementById('range_sleeps_min').max = sleeps_highest;

				// Setter maks prsizeis slider/filter verdier
				document.getElementById('range_sleeps_max').value = sleeps_highest;
				document.getElementById('range_sleeps_max').min = sleeps_lowest;
				document.getElementById('range_sleeps_max').max = sleeps_highest;
				
				// Setter min og maks size slider tekst verdier
				document.getElementById('range_sleeps_min_output').innerHTML = sleeps_lowest;
				document.getElementById('range_sleeps_max_output').innerHTML = sleeps_highest;
				
			</script>
			<?php
		}

		public function print_card_sml_as_js($residence) {
			echo '<br><br>print<br>';
			echo var_dump($residence);
		}


		//Setter inn om det er lov med fremleie eller ikke. Enten ved å opprette en ny rad eller ved å oppdatere den som er der.
		public function allow_sublet($residenceId, $checked) {
			global $pdo;
			$check = sizeof($this->check_sublet($residenceId));
			if($check > 1){
				$query = $pdo->prepare("UPDATE subletting SET allowed = ? WHERE residence_ID = ?");
				$query->bindValue(1, $checked);
				$query->bindValue(2, $residenceId);
				$query->execute();
			}else{
				$query = $pdo->prepare("INSERT INTO subletting(residence_ID, allowed) VALUES (?, ?)");
				$query->bindValue(1, $residenceId);
				$query->bindValue(2, $checked);
				$query->execute();
			}
		}

		//Henter ut om det er lov med fremleie eller ikke.
		private function check_sublet($residenceId){
			global $pdo;
			$query = $pdo->prepare("SELECT allowed FROM subletting WHERE residence_ID = ?");
			$query->bindValue(1, $residenceId);
			$query->execute(); 

			return $query->fetch();
		}

		public function print_card_sml_owned($ID, $img, $rating, $address, $price, $active, $type) {
			$img = $this->get_img_link_from_imgID($img);
			$rating = $this->get_stars_from_float($rating);
			$status = $this->is_apt_active($active);
			$sublet = $this->check_sublet($ID); //Sjekker om boksen for sublet skal hukes av. Den er 0 som default. 
			$allowed = $sublet['allowed']; //Henter verdien. 

			echo '<section class="card_sml zoom" id = "section',$ID,'" name="',$ID,'">';
			echo '<a href="?pg=residence_edit&id=',$ID,'">';
			echo '<img src="img/uploads/',$img[0],'"alt ="">';
			echo '</a>';
			echo '<article>';
			echo '<h4>',$rating,'</h4>';
			echo '<a href="?pg=residence_view&id=',$ID,'" <h1 class="capital">',$address,'</h1></a>';
			echo '<p class="availability">',$status,'</p>';
			echo '<h5>',$type,'</h5>'; 
			
			//Sjekk om leiligheten er eid eller ikke. Hvis den er eid skal bruker kunne huke av for eller mot fremleie.
			if($type == "Owned" && $allowed == 1){
				echo '<div><form action="?pg=user_overview" method="POST"> <input type ="checkbox" name="sub" checked> Tillat fremleie </input> <input type="hidden" name="residence_ID" value=',$ID,' /> <button name="submit"> Oppdater </button> </form> </div>';                
				
			}else if($type == "Owned"){ //Eid leilighet som ikke har tillat fremleie
				echo '<div><form action="?pg=user_overview" method="POST"> <input type ="checkbox" name="sub"> Tillat fremleie </input> <input type="hidden" name="residence_ID" value=',$ID,' /> <button name="submit"> Oppdater </button> </form> </div>';
			}
			else{ //Ikke eid leilighet har ikke mulighet for å tillate fremleie
				echo '<div><form id= ',$ID,'>'," ",'</form></div>';
			}

			echo '<h3>Kr ',$price,',-</h3>';
			echo '</article>';
			echo '</section>';
		}
	}
