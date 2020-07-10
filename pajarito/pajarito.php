<?php

/*
Plugin Name: Pajarito
Description: Crea el shortcode [pajarito] para twittear frases dentro del post.
Version: 1.2
Author: Boeja González
Author URI: http://bgon.es
*/

add_shortcode('pajarito', 'pajarito_shortcode');
add_action('admin_menu', 'pajarito_add_main_options');
add_action( 'wp_head', 'pajarito_style' );

// Shortcode
function pajarito_shortcode($atts, $content = '')
{

	// El hashtag por defecto es el indicado en el menú de opciones de plugin
	extract(
		shortcode_atts(
			array(
				// Puede especificarse en el shortcode uno o varios hastags diferentes
				'hashtag' => get_option('pajarito-hashtag'),
			),
			$atts,
			'pajarito'
		)
	);

	// En cualquier otro caso, el hashtag será el nombre del sitio
	if (!$hashtag) {
		$hashtag = get_bloginfo('name');
	}

	// Si se especifica más de un hashtag, deben ir separados por espacios
	$hashtag = '+%23' . str_replace(' ','+%23',$hashtag);
	$link = wp_get_shortlink();
	$tweet = str_replace(array(' ',' ','\t','\n','\r','\0','\x0B'),'+',strip_tags($content));
	
	// Cálculo de caracteres restantes por si hubiera que cortar el contenido
	$charsLeft = 280 - (strlen(str_replace('%23', '#', $hashtag)) + min(strlen($link), 22) );
	if (strlen($tweet) > $charsLeft) {
		$tweet = substr($tweet, 0, $charsLeft - 3).'...';
	}

	// Enlace generado con la info del tweet
	return sprintf(
		'<a class="pajarito" href="%s" target="_blank">%s<i class="fa fa-twitter"></i></a>',
		"https://twitter.com/intent/tweet?text=$tweet$hashtag+$link",
		$content
	);
}

// Página de opciones
function pajarito_main_options() {
	echo '<div class="wrapper pajarito-opciones">
		<h1>Pajarito - '._('Opciones').'</h1>
        <form method="post" action="options.php">
            '.wp_nonce_field('update-options').'
            <p><strong>'._('Hashtag: ').'</strong><br />
                <input type="text" name="pajarito-hashtag" size="45" value="'.get_option('pajarito-hashtag').'" />
            </p>
            <p><input type="submit" class="button button-primary button-large" value="'._('Guardar').'" /></p>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="pajarito-hashtag" />
        </form>
    </div>';
}

// Opciones en el menú
function pajarito_add_main_options() {
	add_menu_page('Pajarito', 'Pajarito', 'publish_pages', 'pajarito', 'pajarito_main_options');
}

// Estilos
function pajarito_style() {
	echo '
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    	<link href="'.plugins_url( 'style/', __FILE__ ).'style.css" rel="stylesheet" type="text/css">';
}
