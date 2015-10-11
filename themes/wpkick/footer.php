<section id="auteur_signature">
    <div class="wrap">
        
        <div id="avatar" class="column">
            <a href="/a-propos/"><img src="<?php bloginfo('template_url'); ?>/pic/dist/avatar.jpg" alt="à Propos de Mathieu Huitric"></a>
        </div>
        <div id="about" class="column">
            <h2><?php if(get_option('biographie_titre') != ""){ echo get_option('biographie_titre'); } ?></h2>
            <?php if(get_option('biographie') != ""){ echo get_option('biographie'); } ?>
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
                
        </div><!-- /#about .column -->
        <div id="twitter" class="column">
            <h2><?php if(get_option('biographie_twitter_titre') != ""){ echo get_option('biographie_twitter_titre'); } ?></h2>
            <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/cinezine_fr" data-widget-id="587762842956201984">Tweets de @cinezine_fr</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            
        </div><!-- /.wrap -->
</section><!-- #auteur_signature -->

<footer>

        <?php $footer = array(
            'theme_location'  => 'Menu_footer',
            'menu'            => 'Menu footer',
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
            'items_wrap'      => '<nav class="secondaire"><div class="wrap"><ul class="%2$s">%3$s</ul></div></nav>',
            'depth'           => 0,
            'walker'          => ''
        ); ?>

        <?php wp_nav_menu($footer); ?>
        
        
        <div id="film_tags">
            <div class="wrap">
                <nav class="tertiaire">
                <?php
                $args = array( 'hide_empty=1' );
                $terms = get_terms( 'genre', $arg);
                //if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                if ( ! is_wp_error( $terms ) ) {
                    $count = count( $terms );
                    $i = 0;
                    $term_list = '<ul class="tagcloud">';
                    foreach ( $terms as $term ) {
                        $i++;
                        $term_list .= '<li><a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'Voir les articles de film appartenant au genre %s', 'my_localization_domain' ), $term->name ) . '">' . $term->name . '</a></li>';
                        if ( $count != $i ) {
                            $term_list .= ' &middot; ';
                        }
                        else {
                            $term_list .= '</ul>';
                        }
                    }
                    echo $term_list;
                } ?>
                </nav>
            </div>
        </div><!-- /#film_tag  -->
    
        <div id="credit">
            <div class="wrap">Tous droits réservés - 2015 - Mathieu Huitric - Site conçu par <a href="http://origarti.fr">Gaëtan Ruiz</a></div>
        </div>
        <?php echo cookies_message(); ?>
    </footer>
</div><!-- #wrapper (englobe absolument tout ) -->

        
        
<?php wp_footer(); ?>
<?php echo google_analytics_render(); ?>
<div id="overlay"></div><!-- /#overlay -->
<script src="<?php bloginfo('template_url'); ?>/js/lightbox/lightbox.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/main.min.js"></script>
    
</body>
</html>
