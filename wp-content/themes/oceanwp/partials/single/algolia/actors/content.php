<?php
require '_data.php';
?>
<?php if($account_status == "Free") {?>
<div class="container_actors_name">
	<div class="actors_name">
    	<div class="actors_name_content">
        	<h1><?php echo $actors_meta['title']?> <?php echo $actors_meta['firstname']?> <?php echo $actors_meta['middlename']?> <?php echo $actors_meta['surname']?></h1>
    	</div>
	</div>
</div>
<div class="cont_actors_info">
	<div class="actors_info_section">
    	<div class="actors_info_content">
			<ul class="box__container--info">
				<li class="box__container--profession">
                    <i class="fas fa-user fw fa-lg"></i>
						<a>
							<?php
								foreach($actors_meta['Profession'] as $profession){
									foreach($profession as $prof_it=>$key){
										$arr_key[] = $key;
									}
								}
								echo implode( ', ', $arr_key );
							?>	 
						</a>
                </li>
                <li class="box__container--site">
                    <i class="fas fa-external-link-square-alt fw fa-lg"></i>
                    
                        <a target="_new" href="#">
                            Sito Web
                        </a>
                </li>
                <li class="box__container--facebook">
                    <i class="fab fa-facebook-square fw fa-lg"></i>
                        <a target="_new" href="#">
                            Pagina Facebook
                        </a>
                </li>
        
                <li class="box__container--linkedin">
                    <i class="fab fa-linkedin fw fa-lg"></i>
                   
                        <a target="_new" href="#">
                            Pagina LinkedIn
						</a>
                </li>
        	</ul>
    	</div>
	</div>
</div>
<div class="cont_images">
	<div class="row">
		<div class="img_1">
			<?php foreach($actors_meta['actor_image'] as $actorImage):?>
				<div class="column">
				<img src="<?php echo $actorImage ?>" alt="<?php echo $actorImage ?>" style="width:100%">
				</div>
			<?php endforeach;?>
		</div>
		<div class="profession_row">
			<?php foreach($actors_meta['Profession'] as $profession){ ?>
				<?php foreach($profession as $prof_it=>$key){ ?>
					<div class="profession_column">
					<h5><?php echo $key;?></h5>	
					</div>	
				<?php } ?>
			<?php  } ?>
					<div class="profession_column">
						<h5></h5>	
					</div>
		</div>
	</div>
</div>
<div class="cont_profession">
	
</div>
		<?php if($postcat[0]->name == 'Actors'){ ?>
			<div class="phrase-actors">
				<p> Sei il professionista presente in questa scheda e vuoi aiutarci a migliorare le informazioni qui pubblicate? </p>
        		<input type="submit" class="phrase--buttons" id="phrase-act--button" name="phrase-act--button" value="Clicca qui"/>
		</div>
    <?php } ?>
<?php } ?>


<?php if($account_status == "Silver") {?>
	<div class="entry-content clr" <?php oceanwp_schema_markup('entry_content'); ?>>

		<div class="actor_silver_info">
			<div class="column-1">
				<div class="actor_silver_image">
					<div class="actor_silver_image--content">
						<img src="https://www.med4.care/wp-content/uploads/elementor/thumbs/marco-de-nardin-opqmxpywkdll5xq0kwpsde894v8m3p1civ5vehxyck.png" alt="Avatar">
					</div>
				</div>
				<div class="actor_silver_space">
					<div class="actor_silver_image--space">
					
					</div>
				</div>
			</div>
			<div class="column-2">
				<div class="actor_silver_name">
					<div class="actor_silver_name--content">
						<h1>DOTT. MARCO DE NARDIN</h1>
					</div>
				</div>
				<div class="actor_silver_background--info">
					<div class="actor_silver_backgroung-info-section1">
						<div class="info-list--section1">
							<span class="fas fa-user"></span>
							<span class="info-text">&nbsp;Medico Chirurgo, Anestesista, Rianimatore</span>
						</div>
						<div class="info-list--section1">
							<span class="fas fa-certificate"></span>
							<span class="info-text">&nbsp;Albo dei Medici Chirurghi di VENEZIA. N°: 6093</span>
						</div>
						<div class="info-list--section1">
							<span class="fas fa-phone-square-alt"></span>
							<span class="info-text">&nbsp;006 785 765</span>
						</div>
						<div class="info-list--section1">
							<span class="fas fa-external-link-alt"></span>
							<span class="info-text">&nbsp;Sito Web</span>
						</div>
						<div class="info-list--section1">
							<span class="fab fa-facebook-f"></span>
							<span class="info-text">&nbsp; Pagina Facebook</span>
						</div>
						<div class="info-list--section1">
							<span class="fab fa-linkedin"></span>
							<span class="info-text">&nbsp;Pagina LinkedIn</span>
						</div>
					</div>
					<div class="actor_silver_backgroung-info-section2">
						<div class="info-section2-heading">
							<h2>SEDI</h2>
						</div>
						<div class="info-list--section2">
							<span class="fas fa-user-md"></span>
							<span class="info-text--section2"><strong>&nbsp;Studio Dott. De Nardin</strong>, via dei Salici, 8, 40789, Adria RO</span>
						</div>
						<div class="info-list--section2">
							<span class="fas fa-clinic-medical"></span>
							<span class="info-text--section2"><strong>Poliambulatorio XYZ</strong>, via dei Cipressi, 8, 40789, Cittadella PD</span>
						</div>
						<div class="info-list--section2">
							<span class="fas fa-clinic-medical"></span>
							<span class="info-text--section2"><strong>Casa di Cura</strong>, via dei Platani, 8, 40789, Chioggia VE</span>
						</div>
					</div>
				</div>
			</div>		
		</div>
		<div class="actor_silver_info-section2">
			<div class="actor_silver_info-content">
				<div class="info-content1">
					<button type="button" class="collapsible_actors-info">Titoli di studio</button>
					<div class="content_actors-info">
  						<p>Diploma maturità classica Istituto M. Foscarini, Venezia, 60/60, 1995</p>
						<p>Laurea in Medicina e Chirurgia Università di Padova, 110/110 e lode, 2001</p>
						<p>Specializzazione in Anestesia e Rianimazione, 70/70 e lode, 2005</p>
					</div>
				</div>
				<div class="info-content2">
					<button type="button" class="collapsible_actors-info">Carriera professionale</button>
					<div class="content_actors-info">
						<p>Durante la mia carriera ho lavorato con regime lavorativo di tipo SUMAI, dipendente pubblico intra-moenia, extra-moenia, libero professionista</p>
						<p>Fino ad aprile 2018 sono stato direttore sanitario del centro “Servizio di Posturologia”, con all’attivo migliaia di esami posturali eseguiti.</p>
						<p>Nel Luglio 2018 ho fondato Med4Care e ne sono attualmente direttore.</p>
					</div>
				</div>
				<div class="info-content3">
					<button type="button" class="collapsible_actors-info">Esami e prestazioni</button>
					<div class="content_actors-info">
						<ul>
  							<li>Visita cardiologica</li>
  							<li>Holter cardiaco</li>
  							<li>Holter pressorio</li>
							<li>Elettrocardiogramma (ECG)</li>
  							<li>Test da sforzo</li>
						</ul>
					</div>
				</div>
				<div class="info-content4">
					<button type="button" class="collapsible_actors-info">Patologie e sintomi trattati</button>
					<div class="content_actors-info">
						<ul>
  							<li>Glaucoma</li>
  							<li>Herpes Occhio</li>
  							<li>Maculopatia</li>
						</ul>
					</div>
				</div>
				<div class="info-content5">
					<button type="button" class="collapsible_actors-info">Altre informazioni e contatti</button>
					<div class="content_actors-info">
  						<p>Email: dottdenardin@xyz.com</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
				</div>
			</div>
		</div>
		
<?php } ?>
<?php
require '_data.php';
?>
<script type="text/javascript">
var coll = document.getElementsByClassName("collapsible_actors-info");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active_actors-info");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>