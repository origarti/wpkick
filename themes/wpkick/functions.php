<?php

$template_url = get_template_directory_uri();  
//include (get_template_directory_uri() . '/engine/includes/admin-custom.php');
require_once("engine/register/register_custom_post_type.php");
require_once("engine/register/register_menu.php");
require_once("engine/register/register_sidebar.php");
require_once("engine/register/register_panels.php");
/**
* Ajouter une feuille de style personnalisée pour le Back-Office (Admin) de Wordpress
* Source : http://wpchannel.com/creer-feuille-styles-back-office-wordpress/
*/
// Ceci est à placer dans functions.php		
function admin_css_custom() {
	$admin_handle = 'admin_css_custom';
	
	// Le chemin de destination de notre nouvelle feuille de style pour notre Back-Office
	// ici : repertoire_de_notre_theme/css/admin.css

	$admin_css_custom_file = get_template_directory_uri() . '/style/admin.css';
	
	wp_enqueue_style( $admin_handle, $admin_css_custom_file );
}
// On hook le chargement de la feuille de style CSS par défaut du Back-Office en ajoutant au passage notre propre feuille de style
add_action('admin_print_styles', 'admin_css_custom', 11 );


function admin_js_custom() {
	$admin_js_custom_file = get_template_directory_uri() . '/js/admin.js';
	wp_enqueue_script('admin.js', $admin_js_custom_file);
	
}
add_action('admin_enqueue_scripts', 'admin_js_custom');

// [Optimisation] Supprimer les variables des fichiers JavaScript et CSS
// SOURCE : http://www.cachem.fr/3-fonctions-wordpress-ajouter/
function retire_ver_cssjs( $src ) {
   if( strpos( $src, '?ver=' ) )
   $src = remove_query_arg( 'ver', $src );
   return $src;
}
add_filter( 'style_loader_src', 'retire_ver_cssjs', 10, 2 );
add_filter( 'script_loader_src', 'retire_ver_cssjs', 10, 2 );


function cinezine_custom_login_page() { ?>
    <style type="text/css">
    	body{
    		background: url(http://cinezine.fr/wp-content/uploads/2015/08/interstellar.jpg) no-repeat center;
    		-webkit-background-size: cover;
    		background-size: cover;
    	}
        .login h1 a {
            background-image: url(http://cinezine.fr/wp-content/uploads/2015/02/logo.png);
            width: 320px; height: 120px;
            -webkit-background-size: 320px;
            background-size: 320px;
            padding-bottom: 30px;
        }
        .login form{
        	box-shadow: 0px 15px 40px #333;
        }
        .login #backtoblog, .login #nav {
		    font-size: 13px;
		    padding: 9px 24px;
		    background: #FFF;
		    margin: 0 0 0 !important;
		}

    </style>

<?php }
add_action( 'login_enqueue_scripts', 'cinezine_custom_login_page' );

// Utiliser une version de JQuery hébergée plutôt que la version 1.1 utilisée par WP
function modifier_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', false, false);
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'modifier_jquery');


/*function cookies_accepte_set(){
	if(!isset($_COOKIE['cookies_accepte'])) {
		setcookie("cookies_accepte", "0", time()+60*60*24*365, "/", ".cinezine.fr");
	}
}
add_action( 'init', 'cookies_accepte_set' );*/
// Message d'avertissement d'utilisation des cookies #CNIL
function cookies_message(){
	if($_COOKIE['cookies_accepte'] != "1"){
	    $output = '<div id="cookies-message">';
		    $output .= '<div class="wrap">';
		    	$output .= '<div class="cookies-warning">';
		    		$output .= 'En naviguant sur <strong>cinezine.fr</strong>, vous acceptez que celui-ci utilise des <em>"cookies"</em>, afin de nous permettre d\'améliorer régulièrement votre expérience.';
		    	$output .= '</div>';
			    $output .= '<div class="cookies-navigation">';
				    $output .= '<ul>';
				    	$output .= '<li><a href="#" id="cookies-accepte">J\'ai compris</a></li>';
				   		$output .= '<li><a href="http://cinezine.fr/mentions-legales/#cookies" id="cookies-info">En savoir plus</a></li>';
				    $output .= '</ul>';
			    $output .= '</div>';
		    $output .= '</div><!-- /.wrapp -->';
	    $output .= '</div><!-- #cookies-message -->';
	} else{
		$output = "";
	}
    return $output;
}
/*
function cookies_accepte(){
	//setcookie("cookies_accepte", "test", time()+3600*24*100, COOKIEPATH, COOKIE_DOMAIN, false);
		$value = "1";
		setcookie('cookies_accepte', $value, time()+60*60*24*365, "/", COOKIE_DOMAIN, false); 
		wp_send_json_success( "<strong>Merci</strong> à vous ! " );
}

add_action( 'wp_ajax_cookies_accepte', 'cookies_accepte' );
add_action( 'wp_ajax_nopriv_cookies_accepte', 'cookies_accepte' );*/



// TAILLES DE MINIATURES
// add_image_size( $name, $width, $height, $crop );
add_theme_support( 'post-thumbnails');
add_theme_support( 'excerpt');
//add_theme_support( 'comments');

add_image_size('note_express_poster-home', 75, 100, true);
add_image_size('liste_admin', 50, 50, true);
add_image_size('poster', 450, 280, true);
add_image_size('poster-listing', 400, 230, true);
add_image_size('poster-medium', 335, 150, true);
add_image_size('poster-home', 570, 570, true);
add_image_size('poster-open_graph', 1200, 540, true);
add_image_size('poster-open_graph-medium', 600, 270, true);


add_action( 'after_setup_theme', 'register_menus' );

function register_menus() {
  register_nav_menu( 'Menu_principal', 'Menu principal' );
  register_nav_menu( 'Menu_footer', 'Menu Pied de page' );
}


add_action( 'init', 'register_sidebar' );



function generer_title(){
	
	if(is_page() || is_single()){
		if(is_home() || is_front_page()){$page_title = "Cinézine, par Mathieu Huitric"; }
		else{
			if(is_singular('film')){
				$annee = substr(get_field('film_date'), 0, 4);
				$page_title = "Cinézine | "; $page_title .= get_the_title(); $page_title .= " ("; $page_title .= $annee;	$page_title .= " )";
			}
			else{$page_title = "Cinézine | "; $page_title .= get_the_title();}
		}
	}
	else if(is_tax() || is_archive() || is_category()){	
		if(isset($_GET["affichage"])){
			if($_GET["affichage"] == "top"){
				$page_title = "Cinézine | ";  $page_title .= "Les mieux notés";
			} else if($_GET["affichage"] == "flop"){
				$page_title = "Cinézine | ";  $page_title .= "Les moins bien notés";
			}
			else{
				$page_title = "Cinézine | ";  $page_title .= single_cat_title( '', false );	
			}
		}
		else{
			$page_title = "Cinézine | ";  $page_title .= single_cat_title( '', false );	
		}
	}
	else if(is_search()){ $page_title = "Cinézine |  #";	$page_title .= get_search_query();	$page_title .= ""; }
	
	return $page_title;
}

function generer_description(){
	
	if(is_tax() || is_archive()){
		$categorie = single_cat_title('', false);
		$page_description = "Tous les articles '$categorie' de Cinézine, par Mathieu Huitric (@Cinezine_fr)";
	}
	else if(is_search()){
		 $page_description = "Résultat(s) de recherche pour '";
		 $page_description .= get_search_query();	
		 $page_description .= "'";
	}
	else if(is_page() || is_single() || is_front_page() || is_page_template('single-film.php')){
		 $og_twitter = get_field('og_twitter_description');
		 $og_fb = get_field('og_fb_description');
		 $film_realisateur = get_field('film_realisateur');
		 $film_casting = get_field('film_casting');
		 $film_avis = get_field('film_avis');
		 $film_note = get_field('film_note');
		 $excerpt = get_the_excerpt();

			 if($film_avis != ""){ 	  $page_description = $film_avis;	 }
		else if($og_twitter != ""){	  $page_description = $og_twitter;   }
		else if($og_fb != ""){		  $page_description = $og_fb;  	     }
		else if($excerpt != ""){	  $page_description = $excerpt; 	 }
		else if($film_realisateur != ""  &&	$film_casting != ""){ 
			 if($film_note == ""){
			 	$page_description = "Un film de $film_realisateur avec $film_casting"; 
			 } else{
			 	$page_description = "Un film de $film_realisateur avec $film_casting. Noté $film_note/10 par Mathieu Huitric";
			 }
		}
		else{ $page_description	= "par Mathieu Huitric (@Cinezine_fr)";	 }
	}
	
	else{ $page_description = "par Mathieu Huitric (@Cinezine_fr)"; }

	return $page_description;
}

// Gérer l'open graph Facebook
function open_graph() {
	global $post;

	$page_title = generer_title();
	$page_description = generer_description();

	if(is_tax() || is_category()){
	    $category_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	    $permalink = $category_link;
	}
	else{
		$permalink = get_permalink();
	}

	echo '<meta property="og:locale" content="fr_FR" />';
	echo "<meta property=\"og:url\" content=\"$permalink\" />";
    echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '"/>';
	echo "<meta property=\"og:title\" content=\"$page_title\" />";
	echo "<meta property=\"og:description\" content=\"$page_description\"/>";

	echo "<meta name=\"twitter:card\" content=\"summary_large_image\">";
	echo "<meta name=\"twitter:site\" content=\"@cinezine_fr\">";
	echo "<meta name=\"twitter:creator\" content=\"@cinezine_fr\">";
	echo "<meta name=\"twitter:title\" content=\"$page_title\">";
	echo "<meta name=\"twitter:description\" content=\"$page_description\">";
	


	if ( is_front_page() || is_search() || is_404() || is_page()) {			
		echo '<meta property="og:type" content="website"/>';
	}
	elseif ( is_singular('post') || is_singular('film')  ) {
		echo '<meta property="og:type" content="article"/>';
	}
	else {
		echo '<meta property="og:type" content="website"/>';
	}
   
	// VISUEL ACCOMPAGNANT LA PUBLICATION  
	if(!isset($post) || !has_post_thumbnail( $post->ID ) || is_search()) { 
		//Si l'article ou la page n'a pas d'image à la une, on utilise une image par défaut
		$default_image = "http://cinezine.fr/wp-content/uploads/2015/01/cover-1200x500.jpg"; 
		echo '<meta property="og:image" content="' . $default_image . '"/>'; 
		echo '<meta property="twitter:image" content="' . $default_image . '"/>';
	}
	elseif (is_tax()) {
		$terms = get_the_terms($post->ID, 'type');
		$term_list = wp_get_post_terms($post->ID, 'type', array("fields" => "id"));

		if ( $terms && ! is_wp_error( $terms ) ) : $terms_array = array();
			foreach ( $terms as $term ) { $terms_array[] = $term->term_taxonomy_id;	}
		endif;	
		
		$tax_id = $terms_array[0];
		$default_image = "http://cinezine.fr/wp-content/themes/cinezine/pic/dist/couverture/couverture_$tax_id.jpg"; 
		
		echo '<meta property="og:image" content="' . $default_image . '"/>'; 
		echo '<meta property="twitter:image" content="' . $default_image . '"/>';
	}
	elseif (is_archive()) {
		$category = single_term_title("", false);
		$catid = get_cat_ID( $category );
		$default_image = "http://cinezine.fr/wp-content/themes/cinezine/pic/dist/couverture/couverture_$catid.jpg"; 
		
		echo '<meta property="og:image" content="' . $default_image . '"/>'; 
		echo '<meta property="twitter:image" content="' . $default_image . '"/>';
	}
	else{
		//Sinon on utilise l'image à la une prévue
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'poster-open_graph' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
		echo '<meta property="twitter:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}

	echo "\n";
}
add_action('wp_head', 'open_graph', 5);

function facebook_share_link(){
	if(is_tax() || is_category()){
	    $category_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	    $link = $category_link;
	}
	else{
		$link = get_permalink();
	}

	$title = get_the_title();  ?>
	
	<li class="sharer">
		<a class="sharer-fb" title="Partager cet article via Facebook" href="https://www.facebook.com/dialog/feed?app_id=1604147639859098&link=<?php echo $link; ?>&redirecturi=<?php echo $link; ?>&picture=<?php echo $large_url; ?>&name=<?php echo $og_title; ?>&description=<?php echo generer_description(); ?>">Partager via Facebook</a>
	</li>

<?php }


function twitter_share_link(){
	if(is_tax() || is_category()){
	    $category_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	    $link = $category_link;
	}
	else{
		$link = get_permalink();
	}

	$title = get_the_title();
	
	
	if(is_page()){ ?>
		<li class="sharer">
			<a class=" sharer-twitter" title="Partager cet article via Twitter" href="https://twitter.com/share?url=<?php echo $link; ?>&via=cinezine_fr&hashtags=cinema&text=[ Cinézine ] <?php echo $title; ?>">
			Partager via Twitter
			</a>
		</li>
	<?php }
	else { 
		if(is_singular("film")){
			$note = get_field('film_note');
			$annee = substr(get_field('film_date'), 0, 4);
			?>
			<li class="sharer">
				<a class=" sharer-twitter" title="Partager cet article via Twitter" href="https://twitter.com/share?url=<?php echo $link; ?>&via=cinezine_fr&hashtags=cinema&text=[ Cinézine ] <?php echo $title; ?> <?php if($annee != ""){ echo "( $annee )"; } ?> - <?php if($term_list[0] != "4" || $term_list[1] != "4" || $term_list[2] != "4"){ ?><?php urlencode( "$title - Noté $note/10, par Mathieu Huitric"); } ?>">
				Partager via Twitter
				</a>
			</li>
		<?php }
		else{?>
			<li class="sharer">
				<a class=" sharer-twitter" title="Partager cet article via Twitter" href="https://twitter.com/share?url=<?php echo $link; ?>&via=cinezine_fr&hashtags=cinema&text=[ Cinézine ] <?php echo $title; ?>">
				Partager via Twitter
				</a>
			</li>
		<?php }
	}
}

// Charger les balises meta pour les landing pages pour IPHONE
function ios_landing_page() {
	?>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="white">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/pic/dist/landingpage/icon2.png"/>
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/pic/dist/landingpage/icon.png" />
	<link href="<?php bloginfo('template_url'); ?>/pic/dist/landingpage/320x460.png" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">
	<link href="<?php bloginfo('template_url'); ?>/pic/dist/landingpage/640x960.png" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
	<link href="<?php bloginfo('template_url'); ?>/pic/dist/landingpage/640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
	<link href="<?php bloginfo('template_url'); ?>/pic/dist/landingpage/768x1024.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">
	<link href="<?php bloginfo('template_url'); ?>/pic/dist/landingpage/768x1024.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">
	<link href="<?php bloginfo('template_url'); ?>/pic/dist/landingpage/1536x2008.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
	<link href="<?php bloginfo('template_url'); ?>/pic/dist/landingpage/1496x2048.png" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
	<?php
}
add_action('wp_head', 'ios_landing_page');

// all actions related to emojis
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
/*
============================================================
                	Compteur de vue                    
============================================================
*/

//Source = http://b-website.com/ajouter-un-compteur-de-vues-sur-un-post-wordpress

// 1- Compter le nombre de vues
// Avec cette première fonction, on va compter le nombre de vues et enregistrer ce nombre dans un post_meta.
// Si le post_meta n’existe pas, on l’initialise par 1 (première consultation). 
// Dans le cas contraire, on récupère la valeur du meta et on l’incrémente de 1. Tout simplement !

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        add_post_meta($postID, $count_key, '1');
    } else{
    	if(!is_user_logged_in()){
        	$count++;
        	update_post_meta($postID, $count_key, $count);
    	}
    }
}

// 2 - Retourner le nombre de vues
// Cette seconde fonction est encore plus simple, ici, on cherche simplement à retourner la valeur actuelle du compteur.
// On retourne donc la valeur du post_meta lorsqu’il y en a une, sinon, on retourne 1 pour la première consultation.

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count ==''){
        return "1";
    }
    else{
   	 return $count;
    }
}

// 3 - Enregistrer et afficher le nombre de vues
// On se retouve maintenant avec 2 fonctions, l’une pour enregistrer le nombre de vues, et l’autre pour retourner se même nombre.
// Nous allons maintenant les combiner pour afficher un compteur qui est capable de mettre à jour sa valeur 
// et de l’afficher en même temps.

function set_get_PostViews($postID) {
    setPostViews($postID);
    $counter_views = getPostViews($postID);
    if ( $counter_views < 2) {
        echo 'Article vu '.$counter_views.' fois';}
    else {
        echo 'Article vu '.$counter_views.' fois';
    };
}

/*
============================================================
                	Baseline                    
============================================================
*/
function baseline_aleatoires($baselines){

	$baseline_array = array();
	$baseline_explode = explode("||", $baselines);
	//$limit = 1;
	foreach ($baseline_explode as $baseline){ 
		//$limit++;
		if(!empty($baseline)) {
			array_push($baseline_array, $baseline);
		}
	}

	$rand = array_rand($baseline_array, 1);
	$result = $baseline_array[$rand];
	$result = str_replace("Cinézine", "<strong>Cinézine</strong>", $result);
	$result = str_replace("Mathieu Huitric", "<strong>Mathieu Huitric</strong>", $result);
	echo $result;
}
/*
============================================================
             	Bientôt en salles -  degré impatience                    
============================================================
*/
function teaser_impatience_scale($score){
	$score2 = round($score, 0, PHP_ROUND_HALF_DOWN);
	switch ($score2) {
		case '0': return "0%"; break;
		case '1': return "10%"; break;
		case '2': return "20%"; break;
		case '3': return "30%"; break;
		case '4': return "40%"; break;
		case '5': return "50%"; break;
		case '6': return "60%"; break;
		case '7': return "70%"; break;
		case '8': return "80%"; break;
		case '9': return "90%"; break;
		case '10': return "100%"; break;
		
		default: return "0";  break;
	}
}
/*
============================================================
   * Google Analytics
============================================================
*/
function google_analytics_render(){
	 if(get_option('analytics_suivi', "") == "true"){
		if(get_option('google_analytics_code', "") != ""){
			return get_option('google_analytics_code', "");
		}
		else{
			$google_analytics_id = get_option('google_analytics', "");
			$google_analytics_code = "<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', '$google_analytics_id', 'auto');  ga('send', 'pageview');</script>";
			return $google_analytics_code;
		}
	}
	else{
		//return false;
	}
}
//add_action('wp_footer', 'google_analytics_render');

/*
============================================================
                	FILMS - dates                   
============================================================
*/
function humanify_date($date, $contexte = ""){
	$day_raw = substr($date, 8, 9);
	$month_raw = substr($date, -5, -3);
	$year_raw = substr($date, 0, 4);

	if($contexte == ""){
		switch ($month_raw) {
			case '01': $month = "Janvier"; break; 		case '02': $month = "Février"; break;
			case '03': $month = "Mars"; break;			case '04': $month = "Avril"; break;
			case '05': $month = "Mai"; break;			case '06': $month = "Juin"; break;
			case '07': $month = "Juillet"; break;		case '08': $month = "Août"; break;
			case '09': $month = "Septembre"; break;		case '10': $month = "Octobre"; break;
			case '11': $month = "Novembre"; break;		case '12': $month = "Décembre"; break;
			
			default: $month = date('m'); break;
		}
	}
	else if($contexte = "court"){
		switch ($month_raw) {
			case '01': $month = "Janv."; break; 		case '02': $month = "Févr."; break;
			case '03': $month = "Mars"; break;			case '04': $month = "Avril"; break;
			case '05': $month = "Mai"; break;			case '06': $month = "Juin"; break;
			case '07': $month = "Juil."; break;			case '08': $month = "Août"; break;
			case '09': $month = "Sept."; break;			case '10': $month = "Oct."; break;
			case '11': $month = "Nov."; break;			case '12': $month = "Déc."; break;
			
			default: $month = date('m'); break;
		}
	}
	$new_date = $day_raw;
	$new_date .= " ";
	$new_date .= $month;
	$new_date .= " ";
	$new_date .= $year_raw;

	return $new_date;

}

function date_rebours($fin) {
		$debut = date('Y');
		$debut .= "/";
		$debut .= date('m');
		$debut .= "/";
		$debut .= date('d');
		$debut = str_replace("/", "-", $debut);

		$fin = str_replace("/", "-", $fin);
        //60 secondes X 60 minutes X 24 heures dans une journée
        $nbSecondes= 60*60*24;
 
        $debut_ts = strtotime($debut);
        $fin_ts = strtotime($fin);
        $diff = $fin_ts - $debut_ts;
        $jours_restants = round($diff / $nbSecondes);

       	if($jours_restants <= 0){
       		return " <strong class=\"txt_teaser\">( Sorti ! )</strong>";
       	}
       	else{
       		if($jours_restants <= 365){
       			return " <span class=\"txt_gris\">( J-$jours_restants )</span>";
       		}
       		else{
       			return " <span class=\"txt_gris\">( +1 an ... )</span>";
       		}

       	}
    }
/*
============================================================
                	FILMS - Notes                   
============================================================
*/
function zero_note($note){
	if(strlen($note) < 4){
		return "$note"+".0";
	}
	else{
		return $note;
	}
}

/*
============================================================
                	FILMS - Dossier à la une                    
============================================================
*/
function dossier_derniers($limit = '5', $contexte = "home"){
	/**
	* Récupérer les derniers films de la catégorie "Dossier à la une".
	* Doc : http://codex.wordpress.org/Function_Reference/query_posts
	* 
	*/
	$args = array(
		'post_type' => 'post',
		'category_id' => '1',
		'posts_per_page' => $limit,
		'order' => 'DESC'
	);
	$the_query = new WP_Query( $args ); ?>
	
	
	<div class="slider_wrapper">
		<div class="slider_container">
			
			<ul class="slider" >
			<?php
				
				$thumbs = [];
				$titles = [];
				$description = [];

				$index = 1;
				if (  $the_query->have_posts() ) : 
					$nb_resultat = 0;

					while (  $the_query->have_posts() ) : $the_query->the_post(); 
					$nb_resultat++;


					$thumb_id = get_post_thumbnail_id();

					$small = wp_get_attachment_image_src($thumb_id,'poster-medium', true);
					$small_url = $small[0];

					$medium = wp_get_attachment_image_src($thumb_id,'poster-open_graph-medium', true);
					$medium_url = $medium[0];

					$large = wp_get_attachment_image_src($thumb_id,'poster-open_graph', true);
					$large_url = $large[0];

				array_push($thumbs, $small_url);
				array_push($titles, get_the_title());
				array_push($description, get_the_excerpt());

				?>
				<li id="article-focus-<?php echo $index; ?>" class="article_news">
					<div class="article_news_content">
						<a href="<?php echo get_the_permalink(); ?>" class="article_news-visuel">
							<img src="<?php bloginfo('template_url'); ?>/pic/dist/fakeimg_large.png" data-large="<?php echo $large_url; ?>" data-medium="<?php echo $medium_url; ?>" alt="Lire l'article à propos de <?php the_title(); ?>">
						</a>
						<div  class="article_news-titre bg">
							<a href="<?php echo get_the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
							<?php the_excerpt(); ?>
						</div>	
					</div><!-- /.article-news -->
				</li>
		
			<?php 
				$index++;
				endwhile; 
			?>
			</ul>

		</div><!-- .slider_container -->
		<div class="slider_pagination">
			<div class="pagination pagination-prev"></div>
			<div class="pagination pagination-next"></div>
		</div><!-- /.slider_pagination -->
		<?php if($nb_resultat > 3){ ?>
			<div class="slider_puce">
				<ul aria-visible="hidden">
					<?php
					for ($i=1; $i < $index; $i++) { 
						$j = $i-1;
						echo "<li id=\"puce-article-focus-$i\" class=\"pagination-puce\">";
							//echo "<div class=\"puce-thumb\">";
								echo "<img src=\"$thumbs[$j]\" alt=\"$titles[$j]\" title=\"$titles[$j]\"/>";
							//echo "</div>";
							/*echo "<div class=\"puce-caption\">";
								
								echo "<span class=\"puce-description\">$description[$j]</span>";
							echo "</div>";*/
						echo "</li>";
					}
					?>
				</ul>
			</div><!-- /.slider_puce -->
		<?php } ?>

	</div><!-- /.slider_wrapper -->
	<?php wp_reset_postdata(); 
	else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; 
}
/*
============================================================
                	FILMS - CRITIQUES, NOTES, TEASER                      
============================================================
*/
function article_poster($image_size = "poster-home"){
	$image = get_field('film_affiche');
	$article_title = get_the_title(); 

	if( !empty($image) ){

		// vars
		$url = $image['url'];
		$title = $image['title'];
		$alt = $image['alt'];
		$caption = $image['caption'];

		// thumbnail
		$size = $image_size;
		$thumb = $image['sizes'][ $size ];
		$width = $image['sizes'][ $size . '-width' ];
		$height = $image['sizes'][ $size . '-height' ];

	} 
	return "<img src=\"$thumb\" alt=\"Affiche du film $article_title\" width=\"$width\" height=\"$height\" />";

}

function film_genres($output = "echo"){
	$taxonomy = get_the_term_list($post->ID, 'genre','','-','');
	switch ($output) {
		case 'echo':
			echo $taxonomy;
			break;
		case 'get':
			return strip_tags($taxonomy);
			break;
		case 'array':
			$genre_array = array();
			$liste_genre = explode('-', strip_tags($taxonomy));
			foreach ($liste_genre as $genre){ 
				array_push($genre_array, $genre);
			}
			return $genre_array;
			break;
		
		default:
			# code...
			break;
	}
}

function article_derniers($limit = '6', $contexte = "home", $type_id){
	/**
	* Récupérer les derniers films de la catégorie $type (slug).
	* Doc : http://codex.wordpress.org/Function_Reference/query_posts
	* 
	*/
	if($type_id == "4"){

		$start_date = date('Y');
		$start_date .= "/";
		$start_date .= date('m');
		$start_date .= "/";
		$start_date .= date('d');

		

		$args = array(
			'post_type' => 'film',
			'tax_query' => array(
		        array(
		            'taxonomy' => 'type',
		            'terms' => array($type_id),
		            'field' => 'term_id',
		            'operator' => 'AND'
		        )
		    ),
			'showposts' => $limit,
			'meta_query'  => array(         // restrict posts based on meta values
                'key'     => 'film_date',  // which meta to query
                'value'   => $start_date,  // value for comparison
                'compare' => '>='
            ),
            'meta_key' => 'film_date',
			'orderby' => 'meta_value',
			'order' => "ASC"
		);
	}
	else{

		$args = array(
			'post_type' => 'film',
			'tax_query' => array(
		        array(
		            'taxonomy' => 'type',
		            'terms' => array($type_id),
		            'field' => 'term_id',
		            'operator' => 'AND'
		        )
		    ),
			'showposts' => $limit,
			'order' => 'DESC'
		);
	}
	$the_query = new WP_Query( $args ); 
	
	?>
		<ul>
		<?php
			 
			if (  $the_query->have_posts() ) : while (  $the_query->have_posts() ) : $the_query->the_post(); 
				$thumb_id = get_post_thumbnail_id();
				$medium = wp_get_attachment_image_src($thumb_id,'poster-medium', true);
				$medium_url = $medium[0];
				$large = wp_get_attachment_image_src($thumb_id,'poster', true);
				$large_url = $large[0];
		?>
			
			<li class="article_flux">
				
				
				<div class="article_visuel">
					<a href="<?php echo get_the_permalink(); ?>" class="article_lien" title="Lire l'article à propos de <?php the_title(); ?> ">
						<?php 
							//the_post_thumbnail('poster'); 
						?>
						<img src="<?php bloginfo('template_url'); ?>/pic/dist/fakeimg_medium.png" alt="Image accompagnant l'article traitant de <?php the_title(); ?>" data-large="<?php echo $large_url; ?>" data-medium="<?php echo $medium_url; ?>" alt="Lire l'article à propos de <?php the_title(); ?>">
					</a>
					<div class="article-meta">
						<h3><a href="<?php echo get_the_permalink(); ?>" title="Lire l'article à propos de <?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<?php if($type_id != "4"){ ?>
							<small><?php the_time('j F Y') ?></small>
						<?php } else{ 
							if(get_field('film_date') != ""){ ?>
								<small>Sortie prévue le <strong class="txt_teaser"><?php echo humanify_date(get_field('film_date')); ?></strong><?php echo date_rebours(get_field('film_date')); ?></small>
							<?php } 
							else{
								echo "<small>Date de sortie inconnue</small>";
							} 
						?>
						<?php }?>
					</div>
					<?php //comments_popup_link( '<span class="comment_nb">0</span>', '<span class="comment_nb">1</span>', '<span class="comment_nb">%</span>', 'comments-link', '');?>
					<?php if($type_id != "4"){ ?>

						<div class="article_note" itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating"><?php echo zero_note(get_field('film_note'));  ?></div>
					
					<?php } else{ ?>
						
					<?php if(get_field('film_teaser_url') != ""){ ?>
						<a href="<?php the_field('film_teaser_url'); ?>" class="lightbox-iframe article_play" title="Visionner la bande-annonce de <?php the_title(); ?>">Bande-annonce</a>
					<?php } ?>
				<?php } ?>
				</div>
			</li>
			<?php endwhile; ?>
		</ul>	
		
	<?php wp_reset_postdata(); 
	else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; 
}
/*
============================================================
                	FILMS - TOP / Flop                        
============================================================
*/
function article_top_flop($limit = '5', $contexte = "home", $order){
	/**
	* Récupérer les derniers films de la catégorie 'note' 
	* order "DESC" = TOP 
	* order  "ASC" = flop
	* Doc : http://codex.wordpress.org/Function_Reference/query_posts
	* 
	*/
	


	$args = array(
		'post_type' => 'film',
		'tax_query' => array(
	        array(
	            'taxonomy' => 'type',
	            'terms' => array(2, 3),
	            'field' => 'term_id',
	        )
	    ),
		'showposts' => $limit,
		'meta_key' => 'film_note',
		'orderby' => 'meta_value_num',
		'order' => $order
	);

	$the_query = new WP_Query( $args ); ?>
		<ul>
		<?php
			if (  $the_query->have_posts() ) : while (  $the_query->have_posts() ) : $the_query->the_post(); 
		?>
			
			<li class="article_widget">
				
				<div class="article_visuel">
					<a href="<?php echo get_the_permalink(); ?>" class="article_lien" title="<?php the_title(); ?> (<?php echo substr(get_field('film_date'), 0, 4); ?>)">
						<?php 
						//the_post_thumbnail('thumbnail'); 
						echo article_poster('thumbnail');
						?>
					</a>
					<div class="article_coin" >
						<?php the_field('film_note'); ?>
					</div><!-- /.article_coin -->
				</div><!-- /.article_visuel -->
				
				<div class="article_info">
					
					<h3><a href="<?php echo get_the_permalink(); ?>" title="Lire l'article consacré à <?php the_title(); ?> "><?php the_title(); ?></a></h3>
					
					<p><strong>par</strong> <?php the_field('film_realisateur'); ?><br /> 
					   <strong>avec</strong> <?php the_field('film_casting'); ?>
					</p>
				</div><!-- /.article_info -->
				
			</li>
			<?php endwhile; ?>
		</ul>	
		
	<?php wp_reset_postdata(); 
	else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; 
}

function article_similaires($limit = '6', $genre_array, $current_post_id){
	/**
	* Récupérer des idées de films similaires à l'article en cours
	* Doc : http://codex.wordpress.org/Function_Reference/query_posts
	* On exclut l'article en cours de lecture des résultats
	* Critère : genre commun, hiérarchisé par la note attribuée
	*/
	
	$type_id = array(2, 3, 4);  
	$args = array(
		'post_type' => 'film',
		'tax_query' => array(
	        array(
	            'taxonomy' => 'genre',
	            'terms' => $genre_array,
	            'field' => 'name',
	            'operator' => 'AND'
	        ),
	        array(
	            'taxonomy' => 'type',
	            'terms' => $type_id,
	            'field' => 'term_id',
	        )
	    ),
		'showposts' => $limit,
		'meta_key' => 'film_date',
		'orderby' => 'meta_value',
		'order' => 'DESC',
		'post__not_in' => $current_post_id
	);

	
	$the_query = new WP_Query( $args ); 
		$nb_resultat = 0;
		//if (  $the_query->have_posts() ) : 
			
			echo '<nav class="article_relative" role="navigation">';
			  echo '<div class="wrap">';
				echo '<h2>Ces films peuvent également vous intéresser </h2>';
					echo '<ul class="category_liste">';
					
					$exclude2 = array();
					array_push($exclude2, $current_post_id[0]);
					
					// résultats les plus pertinents
					while (  $the_query->have_posts() ) : $the_query->the_post(); 
						$nb_resultat++;
						array_push($exclude2, get_the_id());
						article_similaires_render($type_id);
					endwhile; 

					

					if($nb_resultat < $limit){

						$args2 = array(
							'post_type' => 'film',
							'tax_query' => array(
						        array(
						            'taxonomy' => 'genre',
						            'terms' => $genre_array[0],
						            'field' => 'name',
						            'operator' => 'IN'
						        ),
						        array(
						            'taxonomy' => 'type',
						            'terms' => array(2, 3),
						            'field' => 'term_id',
						        )
						    ),
							'showposts' => $limit - $nb_resultat,	
							'meta_query'  => array(        
						        'key'     => 'film_note',  
						        'value'   => 3.5,  
						        'compare' => '>='
						    ),
							'orderby' => 'date',
							'order' => 'DESC',
							'post__not_in' => $exclude2
						);

						
						$the_query2 = new WP_Query( $args2 ); 
						//if (  $the_query2->have_posts() ) :
							
							// résultats un peu moins pertinent pour boucher les trous si peu de résultat trouvés à loop 1
							while (  $the_query2->have_posts() ) : $the_query2->the_post(); 
								
								article_similaires_render($type_id);

							endwhile; 
							
						//endif;	
					}
					else{ }
				echo '</ul>';
			  echo '</div><!-- /.wrap -->';
			echo '</nav><!-- /.article_relative -->';
		//endif;   	
 	wp_reset_postdata(); 
		
}
	//'meta_key' => '', /* Clé d'un Champ personnalisé | Exemple =>  'couleur' */
    //'meta_value' => '', /* Valeur d'un Champ personnalisé | Exemple =>  'bleu' */
    //'meta_compare' => '', /* Comparateur entre meta_key et meta_value | Exemple => '<= | NOT LIKE | BETWEEN | '*/
    //'orderby' => '', /* si on saisit "meta_value_num", l'order se fera en fonction de la valeur saisie de meta_key*/
    //'order' => '', /* Comparateur entre meta_key et meta_value | Exemple => '<= | NOT LIKE | BETWEEN | '*/
function article_similaires_render(){
	
	$thumb_id = get_post_thumbnail_id();
	$medium = wp_get_attachment_image_src($thumb_id,'poster-medium', true);
	$medium_url = $medium[0];
	$large = wp_get_attachment_image_src($thumb_id,'poster', true);
	$large_url = $large[0];


	$terms = get_the_terms($post->ID, 'type');
	//$term_list = wp_get_post_terms($post->ID, 'type', array("fields" => "id"));

	if ( $terms && ! is_wp_error( $terms ) ) : 
		$type = array();
		foreach ( $terms as $term ) { $type[] = $term->term_taxonomy_id; }
		$term_css = "term-$type[0]";
	 endif;	
	
	?>
	<li class="article_flux ">
		
		<div class="article_visuel">
			<a href="<?php echo get_the_permalink(); ?>" class="article_lien">
				<img src="<?php bloginfo('template_url'); ?>/pic/dist/fakeimg_medium.png" data-large="<?php echo $large_url; ?>" data-medium="<?php echo $medium_url; ?>" alt="Lire l'article à propos de <?php the_title(); ?>">
			</a>
			
			<div class="article-meta">
				<h3><a href="<?php echo get_the_permalink(); ?>" class="article_lien"><?php the_title(); ?></a></h3>

				<?php if($type[0] == " 4" || $type[1] == " 4" || $type[2] == " 4"  ){ ?>
					<?php if(get_field('film_date') != ""){ ?>

						<small>Sortie prévue le <strong class="txt_teaser"><?php echo humanify_date(get_field('film_date')); ?></strong><?php echo date_rebours(get_field('film_date')); ?></small>
					<?php } 

					else{
						echo "<small>Date de sortie inconnue</small>";
					} 
				?>
				<?php } else{ ?>
					<small>Publié le <?php the_time('j F Y');  ?></small>
				<?php }?>
			</div>

			<?php if($type[0] == " 4" || $type[1] == " 4" || $type[2] == " 4"  ){ ?> 
				<?php if(get_field('film_teaser_url') != ""){ ?>
					<a href="<?php the_field('film_teaser_url'); ?>" class="lightbox-iframe article_play" title="Visionner la bande-annonce de <?php the_title(); ?>">Bande-annonce</a>
				<?php } ?>
			<?php } 
			else{ ?>
				<div class="article_note"  itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating"><?php the_field('film_note');  ?></div>
			<?php } ?>
		</div>
	</li>
	<?php
}


if ( ! function_exists( 'paging_nav_num' ) ) :
	/**
	 * Displays navigation to next/previous set of posts with numbers.
	 *
	 */
	function paging_nav_num () {
	    global $wp_query;
	    $big = 999999999; // need an unlikely integer
	    $pages = paginate_links( array(
	        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	        'format' => '?paged=%#%',
	        'current' => max( 1, get_query_var('paged') ),
	        'total' => $wp_query->max_num_pages,
	        'prev_next' => false,
	        'type'  => 'array'
	    ) );
	    if( is_array( $pages ) ) {
	        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	        echo '<div class="pagination"><ul class="page-numbers">';
	        //echo '<li><span>'. $paged . ' av ' . $wp_query->max_num_pages .'</span></li>';
	        foreach ( $pages as $page ) {
	                echo "<li>$page</li>";
	        }
	       echo '</ul></div>';
	    }
	}
endif;


/*
============================================================
   * SHORTCODE : Spoiler
   * générer le shortcode en front
============================================================
*/

  /* [FONCTION] spoiler_shortcode()
   * 1 - $atts : > Cela créer [spoiler][/spoiler]
   * 2 - $contenu : correspondant au contenu saisi par l'utilisateur entre [spoiler] et [/spoiler]
  */
  
 function spoiler_shortcode( $attr, $contenu ) {
	return "<span class=\"spoiler\" title=\"Ceci est un spoiler qui risque de vous dévoiler une partie importante de l'intrigue\">$contenu</span>";
  
}
add_shortcode( 'spoiler', 'spoiler_shortcode' );

/*
============================================================
   * SHORTCODE : embed_post
   * Intégre une remontée d'un post au sein du contenu d'un article
============================================================
*/

  
function embed_post_shortcode($attr){
   extract(shortcode_atts(array(
      'id' => 1,
   ), $attr));

   $args = array(
	'post_type' => 'film',
	'p' => $attr['id'],
	'showposts' => 1);
    query_posts( $args ); 
   if ( have_posts() ) : 
      while (  have_posts() ) : the_post(); 

		$terms = get_the_terms($post->ID, 'type');
		$term_list = wp_get_post_terms($post->ID, 'type', array("fields" => "id"));

		if ( $terms && ! is_wp_error( $terms ) ) : 
			$terms_array = array();
			foreach ( $terms as $term ) {
				$terms_array[] = $term->term_taxonomy_id;
			}
		endif;	
		$title = get_the_title(); 
	  	$permalink = get_the_permalink();
	  	$date_sortie = humanify_date(get_field('film_date'), 'court');
	  	$film_realisateur = get_field('film_realisateur');
	  	$film_casting = get_field('film_casting');
	  	$film_teaser = get_field('film_teaser_url');




        $returning_string = "<div class=\"embed_film\"  itemscope itemtype=\"http://schema.org/Movie\">";
        $returning_string .= "<div class=\"embed_film_poster embed_film_col\">";
			$returning_string .= "<a href=\"$permalink\" target=\"_blank\" title=\"Lire l'article à propos de $title\">";
			$returning_string .= article_poster('medium');
			$returning_string .= "</a>";
        $returning_string .= "</div><!-- /.embed_film_poster -->";
        
        $returning_string .= "<div class=\"embed_film_infos embed_film_col\">";
        $returning_string .= "<p class=\"legende\"><small>Lire l'article Cinézine</small> :</p>";
	    $returning_string .= "<a href=\"$permalink\" target=\"_blank\" class=\"embed_title\" itemprop=\"name\" title=\"Lire l'article à propos de $title\">$title</a>";
        $returning_string .= "<ul>";
		
		if (get_field('film_date') != "" && get_field('film_date') != "N/A"){
			$returning_string .= "<li>";
			  if($terms_array[0] == "4" || $terms_array[0] == "4" || $terms_array[0] == "4"   ){ 
			  	$returning_string .= "Sortie : <strong><span >$date_sortie</span></strong>";
			  } else { 
			  	$returning_string .= "Date de sortie : <strong>$date_sortie</strong>";
			  }
			$returning_string .= "</li>";
		} 
		if (get_field('film_realisateur') != ""){
			$returning_string .= "<li itemprop=\"director\" itemscope itemtype=\"http://schema.org/Person\">";
			$returning_string .= "Par : <strong itemprop=\"name\">";
			$returning_string .= $film_realisateur;
			$returning_string .= "</strong>";
			$returning_string .= "</li>";
		} 
		if (get_field('film_casting') != ""){
			$returning_string .= "<li itemprop=\"actors\" itemscope itemtype=\"http://schema.org/Person\">";
			$returning_string .= "Avec : <strong itemprop=\"name\">";
			$returning_string .= $film_casting;
			$returning_string .= "</strong>";
			$returning_string .= "</li>";
		}
		if (get_field('film_teaser') != ""){
			$returning_string .= "<li>";
			$returning_string .= "<strong>";
			$returning_string .= "<a href=\"";
			$returning_string .= $film_teaser;
			$returning_string .= "\" class=\"lightbox-iframe\">Voir la bande-annonce";
			$returning_string .= "</a>";
			$returning_string .= "</strong>";
			$returning_string .= "</li>";
		}

		$returning_string .= "</ul>";
        $returning_string .= "</div><!-- /.embed_film_infos -->";
        $returning_string .= "</div><!-- /.embed_film -->";


      endwhile;
   endif;
   

   wp_reset_query();
   return $returning_string;
}

add_shortcode('film', 'embed_post_shortcode');



// Permet d'ajouter le custom post type "film" au flux RSS principal du site
function rss_feed_upgrade($qv) {
if (isset($qv['feed']) && !isset($qv['post_type']))
    $qv['post_type'] = array('post', 'film');
    return $qv;
}

add_filter('request', 'rss_feed_upgrade');

// Permet d'ajouter l'image à la une au format désiré au flux RSS des articles "Film"
function rss_post_thumbnail($content) {
     global $post;
     if(has_post_thumbnail($post->ID)) {
        $content = '<p>youhou' . get_the_post_thumbnail($post->ID, 'poster') .
                          '</p>' . get_the_excerpt();
     }
     return $content;
}
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');
// END FUNCTION.PHP 
?>