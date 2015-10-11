<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js oldie lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js oldie lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js oldie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="5_CZRJBxRKU75CdaT4evn-rJ-I6LgmKI6dcC0JlXg78" />
    <title><?php echo generer_title(); ?></title>
    <meta name="description" content="<?php echo generer_description(); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php //Mobile Internet Explorer allows us to activate ClearType technology for smoothing fonts for easy reading ?>
	<meta http-equiv="cleartype" content="on">
	<meta name="msapplication-TileImage" content="<?php bloginfo('url'); ?>/assets/images/tile144x144.png" />
	<meta name="msapplication-TileColor" content="#e8e8e8" />
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
    <!--[if lt IE 9]>
		<script src="<?php bloginfo('template_url'); ?>/libs/mediaqueries.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/libs/selectivizr.min.js"></script>
	<![endif]-->
    <link rel="icon" type="image/gif" href="<?php bloginfo('template_url'); ?>/favicon.gif" />
    <!--[if IE]>
        <link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
    <![endif]-->
    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
    
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
    <!--  <div id="wrapper_top"> -->
    

    <header id="main_header">
        <div class="wrap">
            
            <div id="header_logo">
                <a href="/"><img src="<?php bloginfo('template_url'); ?>/pic/dist/logo.png" alt="Logo Cinézine"></a><br />
                <small>par Mathieu Huitric</small>
                
                <ul class="reseaux-sociaux">
                    <?php 
                    $icon_fb_64 = "data:image/jpg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAAtAC0DAREAAhEBAxEB/8QAGQABAAMBAQAAAAAAAAAAAAAACAACCQcF/8QAOhAAAAQCBQkGAgsAAAAAAAAAAQIDBAARBQYHEhMICSExM1NyseMUGCJmkqQyQhU4QUNEUWJxgaGz/8QAGwEAAwADAQEAAAAAAAAAAAAAAAUGAQQHAgP/xAAuEQABAQQHBwQDAAAAAAAAAAAAAQMEETECBRITFIHBBiFCYWKh4TI0QXEjUbH/2gAMAwEAAhEDEQA/AOMLrKAuoGIf4h+YfzjsKIkCKKY6m8P6hjMEAmOpvD+oYIIBMdTeH9QwQQCY6m8P6hgggDizaRzHQtEExjG8VH6xn9jmI3aGbLPQd1bx5agdcbdTiHnFkkhIUjIGiOQtZrVhhYyWt7ui2zymHq7gyjxwiCh0kkzCQCEnOQeETDLSIm0zkEoOunhrSeblFgiQ3fZQOLOgjK2qbzgOVplBVLtqomrzWqtGPGCtHuFlFzOmqSIHKYpQLK4Y09Q65Q7qtxbudKkrZUWMPk0Ht4ZtkRKCSDZFCLhx5tDYWicVH8nMRm0M2Weg7q3jy1A+426nEPOLJJCQ9apR6NTrlQJqZAg0OV+3F6CgCJcDELiTANMrs9WmPk2tXdKxOCw+z3QhaS1I1ssrcVDcWcJq1HBqFTxxroNkzkT+IcXwmADa70cveUeEbQb+vd4KtldrQ/H6TP8AysKSshdp1aSsrRYAIC4NSCjJFVPd4YDiAE/n1RcVZRfEtq9x+IRhzjIQPSsFhch6h8aA482hsLROKj+TmIzaGbLPQd1bx5agfcbdTiHnFkkhIUjIGmeRn9VVj+7/AP1Ujndb+/XL+FI5+3TMzMjohNkgAcebQ2FonFR/JzEZtDNlnoO6t48tQPuNupxDziySQkKRkBW2GZZVDWTWQNqnO6uPqQcJdpvOUVyFIOIcxgkAhPRel/ETL7VNN6eFbpTRE3dhowfKLJldqgUophWSABx5tDYWicVH8nMRm0M2Weg7q3jy1ODK5OYmVOI1h0iYfwXUh2j/ANPfwaGH5le7l5h9l1Izj+nv4DD8yd3LzD7LqQY/p7+Aw/Mndy8w+y6kGP6e/gMPzJ3cvMPsupBj+nv4DD8xXZC1nI2fpV1D6R7eDszL7jDuXcf9Qzne/qJiuni/u90IR0Grizu7W/8AR//Z";
                    $icon_twitter_64 = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0AAAAtCAMAAAANxBKoAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABBVBMVEV2ze1tyuyx4vVlx+tjxuuo3/Ss4fSH0/C05PXI6/ip3/R7z+5syex+0O50zO1pyOzJ6/j////7/v+p4PTW8Pri9PtnyOz1+/73/P6T1/Fmx+vo9/zX8PpyzO2P1vHG6viL1fBkxuvd8/vw+v2b2/LC6ff9/v+65va55vbY8fqa2vJryezL7Phxy+34/P7t+f3R7vmr4PSO1vFwy+2W2fL0+/6h3fPy+v34/f5qyezP7vn6/f6F0u+55fZoyOzT7/mc2/J4zu7V8PrE6vdvyu3v+f2Y2fLa8fp1ze2w4vXc8vrz+/77/f6O1vD+//99z+6G0/C95/fB6Pem3vSD0u/S7/kAAABhQ22yAAAAAWJLR0RWCg3piQAAAAlwSFlzAAALEgAACxIB0t1+/AAAASZJREFUSMft1GtPwjAUBuCWHnA4kJXJUIYKU0DxAhMF76jg/Qrq//8rDnTF0Yvji1/kTZa8SZ+cNG0zhHD4RBCB8IkiPIGOTfW/0DNafFYflIRYJ+dGPWVQL+koNuNYrOczFutD7CW7sJjLiTSxaX7puy9TP8ZKgYh00aF0de2rl5guV4h4J+uD1Y3qple3mK7IzmR7Z7heq7u7eaZNibYae/uUS1OiieO0eF2Q7UTjLT3AMn1o87ouv3n96HhcVxXv5OQ0HcStM7km7fHR56CYfVEL4ktQacAdO/tjH121BmiMrvFKB7kuel/i+qbs40wSFPr2zrh/YIMfNe73G5z9VPKP+9nWXgCU2kvq1e31+723dwvgd63OVP+1ngBDE0XcWNiYH5/4NDzSHo5ilwAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxNS0wOC0xOVQwMDoyODoyOCswMjowMPL0CLMAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTUtMDgtMTlUMDA6Mjg6MjgrMDI6MDCDqbAPAAAAAElFTkSuQmCC";
                    //bloginfo('template_url'); /pic/dist/icon_fb.png
                        //bloginfo('template_url'); /pic/dist/icon_twitter.png

                    ?>
                    <?php if(get_option('facebook') != ""){?><li><a href="<?php echo get_option('facebook'); ?>" target="_blank"><img src="<?php echo $icon_fb_64; ?>" alt="Page Facebook de Cinézine.fr"></a></li><?php } ?>
                    <?php if(get_option('twitter') != ""){?><li><a href="https://twitter.com/<?php echo get_option('twitter'); ?>" target="_blank"><img src="<?php echo $icon_twitter_64; ?>" alt="Compte Twitter de Cinezine.fr"></a></li><?php } ?>
                    <?php if(get_option('google_plus') != ""){ ?><li><a href="<?php echo get_option('google_plus'); ?>" target="_blank"> ?><img src="<?php bloginfo('template_url'); ?>/pic/dist/icon_google_plus.png" alt="Compte Google Plus de Cinézine.fr"></a></li> ?><?php } ?>
                </ul>

            </div><!-- #header_logo-->
            <div id="baseline">                          
                 <blockquote><?php baseline_aleatoires(get_option('baseline')); ?></blockquote>

            </div><!-- /#baseline -->
            <?php $defaults = array(
                'theme_location'  => 'Menu_principal',
                'menu'            => 'Menu principal',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'menu-header',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<nav id="menu-principal" class="principale"><ul class="%2$s">%3$s</ul></nav>',
                'depth'           => 0,
                'walker'          => ''
            ); ?>

            <?php wp_nav_menu($defaults); ?>
               
        <br class="clear"/>                
                    
        </div><!-- /.wrap -->       
        <div class="search-zone">
            <div class="wrap">
                

                <?php dynamic_sidebar( 'header-rechercher' ); ?>

            </div>
            <span class="clear"></span>
        </div><!-- /.search-zone -->        

    </header>
    
    
<!--[if lt IE 9]>
    <p>Naviguez sans crainte sur Internet. <a href="http://browsehappy.com/" target="_blank">Mettez votre navigateur à jour dès aujourd'hui!</a></p>
<![endif]-->