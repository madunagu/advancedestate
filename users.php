<?php
require_once("includes/initialize.php");
if(!empty($_POST['MakeAgent']) && is_numeric($_POST['MakeAgent'])){
if(empty(Agent::find_by_id((int)$_POST['MakeAgent']))){
$agent=new Agent();
$agent->person_id=(int)$_POST['MakeAgent'];
$agent->save();
}
redirect_to();
}
require_once("parts/header.php");


?>	
			<!-- Agents Section -->
			<section class="agents-section has-padding">
				<div class="container">
					<div class="section-header">
						<h1>Our agents</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec viverra erat. Aenean elit tellus mattis quis maximus et malesuada congue velit</p>
					</div>

					<div class="row row-fit-10">
                    <form action="?" method="post" >
					<?php
					$agents=User::find_all();
					foreach($agents as $agent){
					
						echo "				
						<div class=\"col-md-12\">
							<div class=\"agent fully-styled\">";

								if($pix=$agent->get_picture('list')){
								echo "			<div class=\"image\">
									<a href=\"agent.php?agent=$agent->id\">
										<img src=\"$pix\" alt=\"agent photo\" />
									</a>
								</div>";

							}
				
							echo "	<h3><a href=\"agent.php?agent=$agent->id\">$agent->first_name $agent->last_name</a></h3>
								<p class=\"position\">agent</p>

								<p>$agent->about</p>

								<ul class=\"social-block\">";
								echo $agent->show_social('<li>');
								echo "
								</ul>
                                <button class=\"update-btn\" type=\"submit\" name=\"MakeAgent\" value=\"$agent->id\">Make An Agent</button>
							</div>
						</div>
";
					}
					?>
		</form>
				</div>
				</div>
			</section>

			<!-- Most viewed Section -->
			<section class="most-viewed-section">
				<div class="container">
					<div class="section-header">
						<h1>Most viewed</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec viverra erat. Aenean elit tellus mattis quis maximus et malesuada congue velit</p>
					</div>

					<ul class="most-viewed-carousel most-viewed-items">
					         <?php
                        
                    $properties=    Property::fetch(10,'views');
                    foreach($properties as $property){
                        $property->get_details();
						$property->get_picture();
                    }
					foreach($properties as $property){
						if(!empty($property->pix)){
						echo "						
						<li class=\"item\">
								<div class=\"most-viewed-item\">
									<div class=\"item-cover\">
										<div class=\"cover\">
											<div class=\"text\">
												<a href=\"".$property->link()."\">Info</a>
												<p>$property->detail</p>
											</div>
										</div>
										<img src=\"".$property->pix->most_viewed."\" alt=\"item cover\" />
									</div>

									<div class=\"item-body\">
										<ul class=\"services\">";
										foreach($property->property_non_boolean as $non_bool) {
											echo "
											<li><p class=\"".$non_bool['code_name']."\">".$non_bool['screen_name']." <span>".$non_bool['value_held']."</span></p></li>
								";
										}
										echo "
										</ul>

										<div class=\"location\">
											<h3>
												<a href=\"".$property->link().".\">$property->name</a>
											</h3>
											<p>LA 325</p>

											<span class=\"price\">\$$property->price</span>
						</div>
								</div>
							</div>
						</li>
";
}			
}
                    ?>
				
			</ul>
				</div>
			</section>
		</div>
<?php
require_once("parts/footer.php");
	