<?php
require '_data.php';
?>
<?php if($account_status != 'Free'){ ?>
	<div class="actors_created_articles">
		<div class="actors_created_article-content">
			<div class="heading-article">
				<h1>I miei Articoli</h1>
			</div>
			<div class="articles">
				<?php echo example_cats_related_post(); ?>
			</div>
		</div>
	</div>
	<div class="actors_courses">
		<div class="actors_courses-content">
			<div class="heading-courses">
				<h1>Corsi per Professionisti</h1>
			</div>
			<div class="courses">
				<?php echo example_cats_related_post(); ?>
			</div>
		</div>
	</div>
<?php } ?>
<div class="phrase-actors">
    <p> Sei il professionista presente in questa scheda e vuoi aiutarci a migliorare le informazioni qui pubblicate? </p>
	<input type="submit" class="phrase--buttons" onclick="window.open('https://www.med4.care/form-provider/','_blank')" id="phrase-actors--button" name="phrase-actors--button" value="Clicca qui" />
</div>