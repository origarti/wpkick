<?php 
$last_selected = $_GET['par'];
if(isset($last_selected)){

	switch ($last_selected ) {
		case 'titre':
			$titre_selected = "selected"; $realisateur_selected = "";	$casting_selected = "";
			break;
		case 'realisateur':
			$titre_selected = ""; $realisateur_selected = "selected";	$casting_selected = "";
			break;
		case 'casting':
			$titre_selected = ""; $realisateur_selected = "";	$casting_selected = "selected";
			break;
		
		default:
			$titre_selected = "selected"; $realisateur_selected = "";	$casting_selected = "";
			break;
	}
}
else{
	$titre_selected = "selected"; $realisateur_selected = "";	$casting_selected = "";
}

?>
<form action="/" method="get" id="search_form">
	<div id="search-message"></div>
    <select autocomplete="off"  name="par" id="filter-field" class="field" placeholder="Rechercher par">
    	<option value="titre" <?php echo $titre_selected; ?>>Titre du film</option>
    	<option value="realisateur" <?php echo $realisateur_selected; ?>>Réalisation</option>
    	<option value="casting" <?php echo $casting_selected; ?>>Casting</option>
    </select>
    <input autocomplete="off" type="search" class="field" placeholder="Votre recherche" name="s" id="search-field" value="<?php the_search_query(); ?>" required />
    <input type="submit" class="field icone" id="search-submit" value="Rechercher">
</form>