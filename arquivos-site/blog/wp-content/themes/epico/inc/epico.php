<?php
/**
 *
 * Configuracao de filtros e acoes para o tema
 *
 * @package		Epico
 * @subpackage  Epico (functions)
 * @author		Uberfacil <contato@uberfacil.com>
 * @copyright	Copyright (c) 2014, Uberfacil
 * @author		Justin Tadlock
 * @copyright	Copyright (c) 2014, Justin Tadlock
 * @link		http://temas.uberfacil.com/Epico
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Calculo de apresentacao do tempo de leitura do post. */
require_once( trailingslashit( get_template_directory() ) . 'inc/reading-time.php' );

/* Insere a classe com funcoes para calcular a cor personalizada, caso ativada. */
require_once( trailingslashit( get_template_directory() ) . 'inc/color-style-overrides.php' );

/* Especifica dimensões dos thumbnails. */
add_action( 'switch_theme', 'epico_enforce_image_size_options' );

/* Registra novas opções de thumbnails. */
add_action( 'init', 'epico_register_image_sizes', 5 );

/* Registra menus personalizados. */
add_action( 'init', 'epico_register_menus', 5 );

/* Registra areas de widget. */
add_action( 'widgets_init', 'epico_register_sidebars', 5 );

/* Remove o filtro padrao do resumo do artigo */
remove_filter('get_the_excerpt', 'wp_trim_excerpt');

/* Adiciona novo filtro para remover o texto do tempo de leitura */
add_filter('get_the_excerpt', 'epico_filter_excerpt');

/* Adiciona configuracoes personalizadas para o editor visual. */
add_filter( 'tiny_mce_before_init', 'epico_tiny_mce_before_init' );

/* Filtra o output do calendario. */
add_filter( 'get_calendar', 'epico_get_calendar' );

/* Adiciona atributos customizados para as areas de widgets auxiliares. */
add_filter( 'hybrid_attr_sidebar', 'epico_extra_sidebar_class', 10, 2 );

/* Adiciona scripts personalizados. */
add_action( 'wp_enqueue_scripts', 'epico_enqueue_scripts' );

/* Adiciona estilos personalizados. */
add_action( 'wp_enqueue_scripts', 'epico_enqueue_styles', 0 );

/* Registra estilos personalizados para o frontend. */
add_action( 'wp_enqueue_scripts', 'epico_register_color_styles', 1 );

/* Registra estilos personalizados para o frontend. */
add_action( 'wp_enqueue_scripts', 'epico_register_fonts', 2 );

/* Registra estilos customizados para a area administrativa . */
add_action( 'admin_enqueue_scripts', 'epico_admin_register_styles', 0 );

/* Suporte basico ao IE v8 ou inferior... */
add_action( 'wp_head', 'epico_ie_support' );

/* Filtra o codigo da imagem de destaque. */
add_filter( 'post_thumbnail_html', 'epico_get_featured_image' );

/* Filtra os contadores de artigos na lista de categorias. */
add_filter( 'wp_list_categories', 'epico_cat_count_span' );

/* Filtra os contadores de artigos na lista post por mes. */
add_filter( 'get_archives_link', 'epico_archive_count_span' );

/* Remove opcoes default do customizer */
add_action( 'customize_register', 'epico_customizer_remove' );

/* Classes da tag body */
add_filter( 'body_class', 'epico_body_classes' );

/* Adicionando icone no botao de enviar comentarios */
add_filter( 'comment_form_defaults', 'epico_comment_form_defaults' );

/* Adiciona uma classe personalizada na listagem de artigos para reduzir css */
add_filter( 'hybrid_attr_post', 'epico_post_listings_class' );

/*  Filtra o numero de comentarios */
add_filter( 'comments_number', 'epico_disqus_override', 10, 2 );

/* Integracao com Google Tag Manager */
add_filter( 'uberfacil_after_body', 'epico_google_tag_manager' );

/* Forca o idioma do admin para pt_BR */
add_filter( 'locale', 'epico_set_locale' );

/* Remove os estilos de acordo com IDs de paginas (customizer) */
add_action ( 'wp_head','epico_remove_styles_scripts', 0 );

/* Estilos do editor. */
add_action( 'after_setup_theme', 'epico_get_editor_styles' );

/* Remove registro de estilos do framework para garantir compatibilidade com o Optimize Press. */
remove_action( 'wp_enqueue_scripts', 'hybrid_register_styles', 0 );

/* Filtra atributo da tag body para marca-las no padrao como `WebPage` */
add_filter( 'hybrid_attr_body', 'epico_attr_body' );

/**
 * Cria um hook personalizado apos a abertura da tag <body>.
 * Util para snippets JS, como o do Google Tag Manager.
 *
 * @since  1.0.0
 * @return void
 */
function uberfacil_after_body() {
	do_action( 'uberfacil_after_body' );
}

/**
 * Ajusta valores padrao do thumbnail.
 *
 * @since  1.0.0
 * @return void
 */
function epico_enforce_image_size_options() {
	if ( false === get_option( 'thumbnail_crop' ) ) {
		add_option( 'thumbnail_crop', '1' );
	} else {
		update_option( 'thumbnail_crop', '1' );
	}

	update_option( 'thumbnail_size_w', 350  );
	update_option( 'thumbnail_size_h', 230 );
}

/**
 * Cria novos tamanhos de thumbnails para o tema.
 *
 * @since  1.0.0
 * @return void
 */
function epico_register_image_sizes() {

	add_image_size( 'epico-tiny', 350, 230, true );         // Listagem de artigos padrao
	add_image_size( 'epico-small', 380, 249, true );        // Picturefill (mobile)
	add_image_size( 'epico-medium', 650, 427, true );       // Picturefill (tablet)
	add_image_size( 'epico-large', 825, 542, true );        // Picturefill (desktop)
	add_image_size( 'epico-rel-posts', 304, 170, true );    // Artigos relacionados
}

/**
 * Registra posicoes de menu.
 *
 * @since  1.0.0
 * @return void
 */
function epico_register_menus() {
	register_nav_menu( 'primary',   _x( 'Main Navigation', 'nav menu location', 'epico' ) );
	register_nav_menu( 'secondary', _x( 'Footer links',    'nav menu location', 'epico' ) );
}

/**
 * Registra areas de widget.
 *
 * @since  1.0.0
 * @return void
 */
function epico_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'			=> 'primary',
			'name'			=> _x( 'Main sidebar', 'sidebar', 'epico' ),
			'description'	=> __( 'The main widget area, beside the main content.', 'epico' ),

				'before_title'  => '<h4 class="widgettitle">',
				'after_title'   => '</h4>',
		)
	);

	hybrid_register_sidebar(
		array(
			'id'			=> 'promo',
			'name'			=> _x( 'Promocional', 'sidebar', 'epico' ),
			'description'	=> __( 'Area located at the website header. Optimized for the Capture widget.', 'epico' ),
		)
	);

	hybrid_register_sidebar(
		array(
			'id'			=> 'after-primary',
			'name'			=> _x( 'After Main Sidebar', 'sidebar', 'epico' ),
			'description'	=> __( 'Area located right after the main sidebar. Optimized for the Capture widget.', 'epico' ),
		)
	);

	hybrid_register_sidebar(
		array(
			'id'			=> 'before-content',
			'name'			=> _x( 'Before content', 'sidebar', 'epico' ),
			'description'	=> __( 'Area located before the main content.', 'epico' )
		)
	);

	hybrid_register_sidebar(
		array(
			'id'			=> 'after-content',
			'name'			=> _x( 'After posts', 'sidebar', 'epico' ),
			'description'	=> __( 'Area located after post\'s or page\'s content. Optimized for the Capture widget.', 'epico' ),
		)
	);

	hybrid_register_sidebar(
		array(
			'id'			=> 'subsidiary',
			'name'			=> _x( 'Before footer', 'sidebar', 'epico' ),
			'description'	=> __( 'Area located before the website footer. Optimized for one, two or three widgets', 'epico' ),
		)
	);

	hybrid_register_sidebar(
		array(
			'id'			=> 'footer',
			'name'			=> _x( 'Footer', 'sidebar', 'epico' ),
			'description'	=> __( 'Area located at website footer.', 'epico' ),
		)
	);

	hybrid_register_sidebar(
		array(
			'id'			=> 'top',
			'name'			=> _x( 'Site top', 'sidebar', 'epico' ),
			'description'	=> __( 'Auxiliary area located at the top of the website. Optimized for the Notice widget', 'epico' ),
		)
	);

}

/**
 * Funcao para adicionar estilos do editor.
 *
 * @since  1.0.0
 * @return array
 */
function epico_get_editor_styles() {

	add_editor_style( 'css/editor-style.css' );
}


/**
 * Adiciona a classe <body> ao editor visual.
 *
 * @since  1.0.0
 * @param  array  $settings
 * @return array
 */
function epico_tiny_mce_before_init( $settings ) {

	$settings['body_class'] = join( ' ', get_body_class() );

	return $settings;
}

/**
 * Filtra o resumo do artigo
 *
 * @since  1.0.0
 * @author Boutros AbiChedid
 * @return string
 */

function epico_filter_excerpt($text) {

	global $post;

	$raw_excerpt = $text;

	if ( '' == $text ) {

		$readingtimetext = array( 'Tempo de leitura:', 'Reading time:', 'Tiempo de lectura:' );

		$text = get_the_content('');

		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);

		$text = str_ireplace( $readingtimetext, '', $text );

		$allowed_tags = '<small>';
		$text = strip_tags($text, $allowed_tags);

		$excerpt_word_count = 85;
		$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);

		$excerpt_text = '<span>' . __( 'Continue', 'epico' ) . '</span>';
		$excerpt_end = '→';
		$excerpt_more = apply_filters('excerpt_more', $excerpt_text . $excerpt_end);

		$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);

		if ( count($words) > $excerpt_length ) {

			array_pop($words);

			$text = implode(' ', $words);

			$text = $text . $excerpt_more;

		} else {

			$text = implode(' ', $words);
		}
	}

	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}


/**
 * Transforma os IDs do calendario em classes.
 *
 * @since  1.0.0
 * @param  string  $calendar
 * @return string
 */
function epico_get_calendar( $calendar ) {
	return preg_replace( '/id=([\'"].*?[\'"])/i', 'class=$1', $calendar );
}


/**
 * Adiciona classes personalizada para as areas de widget, baseado na
 * quantidade de widgets presente, entre 1 e 3 widgets
 *
 * @since	1.0.0
 * @access	public
 * @param	array  $attr
 * @param	string $context
 * @return	array
 */
function epico_extra_sidebar_class( $attr, $context ) {

	if ( 'top' === $context || 'subsidiary' === $context || 'footer' === $context || 'promo' === $context ) {

		$sidebars_widgets = wp_get_sidebars_widgets();

		if ( is_array( $sidebars_widgets ) && ! empty( $sidebars_widgets[ $context ] ) ) {

			$count = count( $sidebars_widgets[ $context ] );

			if ( 1 === $count )
				$attr['class'] .= ' sidebar-col-1';

			elseif ( ! ( $count % 3 ) || $count % 2 )
				$attr['class'] .= ' sidebar-col-3';

			elseif ( ! ( $count % 2 ) )
				$attr['class'] .= ' sidebar-col-2';
		}
	}

	return $attr;
}

/**
 * Retorna `true` se houver mais de uma categoria
 *
 * @since  1.0.0
 */

function epico_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {

		$all_the_cool_cats = get_categories(
			array(
				'hide_empty' => 1,
			)
		);

		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Embute o javascript padrao.
 *
 * @since  1.0.0
 * @return void
 */
function epico_enqueue_scripts() {

	wp_enqueue_script( 'epico', trailingslashit( get_template_directory_uri() ) . 'js/scripts.min.js', array( 'jquery' ), null, true );
}


/**
 * Embute folhas de estilo CSS padrao.
 *
 * @since  1.0.0
 * @return void
 */
function epico_enqueue_styles() {

	$suffix = hybrid_get_min_suffix();

	if ( current_theme_supports( 'cleaner-gallery' ) )
		wp_enqueue_style( 'gallery', trailingslashit( HYBRID_CSS ) . "gallery{$suffix}.css" );

	// Font Awesome
	wp_enqueue_style( 'epico-icons', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', false, '4.3.0' );

	// Caso seja um tema filho, embutir CSS principal com outro slug
	if ( is_child_theme() )
		wp_enqueue_style( 'parent', trailingslashit( get_template_directory_uri() ) . "style{$suffix}.css" );

	// CSS principal
	if ( ! is_admin() ) {
		wp_enqueue_style( 'style', get_stylesheet_uri() );
	}
}


/**
 * Registra folhas de estilos, icones e fontes para o frontend.
 *
 * @since  1.0.0
 * @return void
 */
function epico_register_fonts() {

	// Source Sans Pro
	wp_register_style( 'epico-fonts-sourcesans', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic' );

	// Roboto Slab
	wp_register_style( 'epico-fonts-roboto', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic|Roboto+Slab:300,400' );

	// Raleway
	wp_register_style( 'epico-fonts-raleway', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic|Raleway:300,400' );

	// Obtendo os valores do customizer para a tipografia
	$fontface = get_theme_mod( 'epico_typography', 1 );

	// Enfileirando fontes do tema
	if ( 0 == $fontface ) {
		wp_enqueue_style('epico-fonts-sourcesans');
	} else if ( 1 == $fontface ) {
		wp_enqueue_style('epico-fonts-roboto');
	} else if ( 2 == $fontface ) {
		wp_enqueue_style('epico-fonts-raleway');
	}
}

/**
 * Registra folhas de estilos para as paletas de cor.
 *
 * @since  1.0.0
 * @return void
 */
function epico_register_color_styles() {

	// Estilos de cor 2 a 9
	wp_register_style( 'epico-style-2', trailingslashit( get_template_directory_uri() ) . 'css/color-styles/min/style2.min.css', array('style') );
	wp_register_style( 'epico-style-3', trailingslashit( get_template_directory_uri() ) . 'css/color-styles/min/style3.min.css', array('style') );
	wp_register_style( 'epico-style-4', trailingslashit( get_template_directory_uri() ) . 'css/color-styles/min/style4.min.css', array('style') );
	wp_register_style( 'epico-style-5', trailingslashit( get_template_directory_uri() ) . 'css/color-styles/min/style5.min.css', array('style') );
	wp_register_style( 'epico-style-6', trailingslashit( get_template_directory_uri() ) . 'css/color-styles/min/style6.min.css', array('style') );
	wp_register_style( 'epico-style-7', trailingslashit( get_template_directory_uri() ) . 'css/color-styles/min/style7.min.css', array('style') );
	wp_register_style( 'epico-style-8', trailingslashit( get_template_directory_uri() ) . 'css/color-styles/min/style8.min.css', array('style') );
	wp_register_style( 'epico-style-9', trailingslashit( get_template_directory_uri() ) . 'css/color-styles/min/style9.min.css', array('style') );

	// Obtendo os valores do customizer para as paletas de cor
	$colorStyle = get_theme_mod( 'epico_color_palettes', 0 );

	// Enfileirando os estilos
	if ( 1 == $colorStyle ) {
		wp_enqueue_style('epico-style-2');
	} elseif ( 2 == $colorStyle ) {
		wp_enqueue_style('epico-style-3');
	} elseif ( 3 == $colorStyle ) {
		wp_enqueue_style('epico-style-4');
	} elseif ( 4 == $colorStyle ) {
		wp_enqueue_style('epico-style-5');
	} elseif ( 5 == $colorStyle ) {
		wp_enqueue_style('epico-style-6');
	} elseif ( 6 == $colorStyle ) {
		wp_enqueue_style('epico-style-7');
	} elseif ( 7 == $colorStyle ) {
		wp_enqueue_style('epico-style-8');
	} elseif ( 8 == $colorStyle ) {
		wp_enqueue_style('epico-style-9');
	}
}


/**
 * Suporte basico para versoes antigas do IE
 *
 * @since  1.0.0
 * @return string
 */
function epico_ie_support() {

	global $is_IE;
	// Se estivermos lidando com o Internet Explorer
	if ( $is_IE ) {
		echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
		echo '<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->';
		echo '<!--[if lt IE 9]><script src="//cdn.jsdelivr.net/selectivizr/1.0.3b/selectivizr.min.js"></script><![endif]-->';
		echo '<!--[if lt IE 9]><script src="//cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script><![endif]-->';
	}
}

/**
 * Registra folhas de estilos para uso no admin.
 *
 * @since  1.0.0
 * @return void
 */
function epico_admin_register_styles() {
	wp_register_style( 'epico-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,400italic' );
	wp_register_style( 'epico-admin-custom-header', trailingslashit( get_template_directory_uri() ) . 'css/custom-admin-styles.css' );
}


/**
 * Integra featured images com o script Polyfill
 *
 * @since  1.0.0
 * @return string
 */
function epico_get_featured_image( $html, $aid = false ){
	$sizes = array( 'epico-small', 'epico-medium', 'epico-large' );
	$img   = '<span itemprop="image" itemscope="itemscope" itemtype="http://schema.org/ImageObject" data-picture data-alt="'.get_the_title().'">';
	$ct    = 0;
	$aid   = ( ! $aid ) ? get_post_thumbnail_id() : $aid;

	foreach ( $sizes as $size ) {
		$url   = wp_get_attachment_image_src( $aid, $size );
		$width = ( $ct < sizeof( $sizes ) - 1 ) ? ( $url[1] * 0.7 ) : ( $width / 0.7 ) + 25;
		$img  .= '<span itemprop="contentURL" class="responsive-img img-'. $width .'" data-src="'. $url[0] .'"';
		$img  .= ( $ct > 0 ) ? ' data-media="(min-width: '. $width .'px)"></span>' :'></span>';

		$ct ++;
	}
	$url  = wp_get_attachment_image_src( $aid, $sizes[1] );
	$img .= '<noscript>
					<span itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
						<img itemprop="contentURL" itemprop="image" src="' . $url[0] .'" alt="' . get_the_title() .'">
					</span >
			</noscript>
		</span>';
	return $img;
}

/**
 * Filtra os contadores de artigos na lista de categorias
 *
 * @since  1.0.0
 * @return
 */
function epico_cat_count_span( $links ) {
	$links = str_replace( '</a> (', '</a> <span class="counter"> &raquo; ', $links );
	$links = str_replace( ')', '</span>', $links );
	return $links;
}


/**
 * Filtra os contadores de artigos na lista de categorias
 *
 * @since  1.0.0
 */
function epico_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a> <span class="counter"> &raquo; ', $links );
	$links = str_replace( ')', '</span>', $links );
	return $links;
}

/**
 * Utilitario para adicao de intervalos de data no footer
 *
 * @since 1.0.0
 */
function epico_copyright_footer( $yearFrom, $echoDate = true ) {
	$yearTo = date( 'Y' );
	$text   = $yearFrom . ( ( $yearFrom != $yearTo ) ? $yearTo : '' );
	if ( $echoDate ) echo esc_html( $text );
	return $text;
}

/**
 * Remove e reposiciona opcoes default do customizer
 *
 * @since 1.0.0
 */
function epico_customizer_remove( $wp_customize ) {
	$wp_customize->remove_section( 'title_tagline' );    // Remove a area de titulos padrao
	$wp_customize->remove_section( 'header_image' );     // Remove a area imagens no header
	$wp_customize->remove_section( 'background_image' ); // Remove a area imagens de fundo
	$wp_customize->remove_section( 'colors' );           // Remove a area imagens de fundo
	$wp_customize->remove_section( 'themes' );           // Remove a area de temas

	$static_front_page = wp_list_pages( array( 'echo' => false ) );
	if ( ! empty( $static_front_page ) ) :
		$wp_customize->get_section( 'static_front_page' )->title = __( 'Set Front Page', 'epico' );
		$wp_customize->get_section( 'static_front_page' )->priority   = '10';
	endif;
	$wp_customize->get_control( 'background_color' )->section     = 'layout'; //Altera posicao de controles padrao
	$wp_customize->get_control( 'background_color' )->priority    = '4';
	$wp_customize->get_control( 'background_color' )->description = __( 'Main background colors', 'epico' );
	$wp_customize->get_control( 'background_image' )->section     = 'layout';
	$wp_customize->get_control( 'background_image' )->priority    = '6';
	$wp_customize->get_control( 'background_image' )->description = __( 'Main background image', 'epico' );
	if ( function_exists( 'has_site_icon' ) ) :
		$wp_customize->get_control( 'site_icon' )->section        = 'branding'; //Altera posicao de controles padrao
		$wp_customize->get_control( 'site_icon' )->priority       = '6';
		$wp_customize->get_control( 'site_icon' )->description = __( 'Upload a icon for your blog (AKA Favicon). You can edit your icon image after the upload.', 'epico' );
	endif;
}


/**
 * Adiciona classes ao body
 *
 * @since  1.0.0
 * @return array
 */
function epico_body_classes( $classes ) {

	$layout          = get_theme_mod( 'epico_sidebar_layout', 1 );
	$color_pallete   = get_theme_mod( 'epico_color_palettes', 0 );
	$social_counters = get_theme_mod( 'epico_socialcounter', 1 );
	$font            = get_theme_mod( 'epico_typography', 1 );
	$loop            = get_theme_mod( 'epico_compact_loop', 1 );
	$color_override  = get_theme_mod( 'epico_color_override_option', 0 );
	$mobile_columns  = get_theme_mod( 'epico_mobile_columns_switch', 1 );

	// Layout
	if ( 0 == $layout ) {
		$classes[] = 'epico-sidebar-left';
	} else if ( 1 == $layout ) {
		$classes[] = 'epico-sidebar-right';
	} else if ( 2 == $layout ) {
		$classes[] = 'epico-no-sidebar';
	}

	// Paletas de cor
	if ( 0 == $color_pallete ) {
		$classes[] = 'epc-s1';
	} else if ( 1 == $color_pallete ) {
		$classes[] = 'epc-s2';
	} else if ( 2 == $color_pallete ) {
		$classes[] = 'epc-s3';
	} else if ( 3 == $color_pallete ) {
		$classes[] = 'epc-s4';
	} else if ( 4 == $color_pallete ) {
		$classes[] = 'epc-s5';
	} else if ( 5 == $color_pallete ) {
		$classes[] = 'epc-s6';
	} else if ( 6 == $color_pallete ) {
		$classes[] = 'epc-s7';
	} else if ( 7 == $color_pallete ) {
		$classes[] = 'epc-s8';
	} else if ( 8 == $color_pallete ) {
		$classes[] = 'epc-s9';
	}


	// Contadores sociais parciais
	if ( 0 == $social_counters ) {
		$classes[] = 'epc-nsc'; // Remove numero total de compartilhamentos
	}

	// Tipografia
	if ( 0 == $font ) {
		$classes[] = 'epc-ss'; // Source Sans
	} else if ( 1 == $font ) {
		$classes[] = 'epc-rs'; // Roboto Slab
	} else if ( 2 == $font ) {
		$classes[] = 'epc-rw'; // Raleway
	}

	// Loop
	if ( 0 == $loop ) {
		$classes[] = 'epico-full';
	} else if ( 1 == $loop ) {
		$classes[] = 'epico-compact';
	}

	// Sobrescrever cores padrao
	if ( 1 == $color_override ) {
		$classes[] = 'epc-ovr'; // Adiciona classe para sobrescrever cores
	}

	// Sidebar com uma coluna no mobile
	if ( 0 == $mobile_columns ) {
		$classes[] = 'epc-mobcol'; // Adiciona classe para sobrescrever cores
	}

	return $classes;
}


/**
 * Adicionando um icone ao botao de comentarios
 *
 * @since  1.0.0
 * @return string
 */

function epico_comment_form_defaults( $defaults ) {

	$defaults['label_submit'] = __( 'Post Comment', 'epico' ) . ' ';

	return $defaults;
}

/**
 * Cria um link para o editor de menus caso a area esteja vazia.
 *
 * @since  1.0.0
 * @param  array $args
 * @return string
 */
function epico_link_to_menu_editor( $args ) {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	extract( $args );

	global $wp_version;

	if ( $wp_version <= 4.2 ) {

		$link = $link_before
			. '<a class="fa fa-plus-circle" href="' .admin_url( 'nav-menus.php' ) . '" onclick="return !window.open(this.href);"> ' . $before . __( 'Add a menu to this position', 'epico' ) . $after . '</a>'
			. $link_after;

	} elseif ( $wp_version > 4.2 ) {

		$link = $link_before
			. '<a class="fa fa-plus-circle" href="' .admin_url( 'customize.php?autofocus[panel]=nav_menus' ) . '" onclick="return !window.open(this.href,\'_top\');"> ' . $before . __( 'Add a menu to this position', 'epico' ) . $after . '</a>'
			. $link_after;

	}

	if ( FALSE !== stripos( $items_wrap, '<ul' ) or FALSE !== stripos( $items_wrap, '<ol' ) ) {
		$link = "<li>$link</li>";
	}

	$output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
	if ( ! empty ( $container ) ) {
		$output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
	}

	if ( $echo ) {
		echo $output;
	}

	return $output;
}


/**
 * Adiciona uma classe personalizada na listagem de artigos para reduzir css
 *
 * @since  1.0.0
 * @param  array $attr
 * @return string
 */

function epico_post_listings_class( $attr ) {

	// Verifica se e uma pagina ou o formato de post padrao
	if ( 'page' === get_post_type() || false == get_post_format() ) {

		// Atribui uma nova classe aos tipos selecionados
		$attr['class']  .= ' format-default';

	}
	return $attr;
}


/**
 * Filtra o numero de comentarios (sobrescreve a alteracao padrao do plugin Disqus)
 *
 * @since  1.0.0
 * @param  array $output $number
 * @return string
 */

function epico_disqus_override ( $output, $number ) {

	$compact = get_theme_mod( 'epico_compact_loop', 1 );

	// Se o modo de listagem compacta de artigos estiver ativa
	if ( 1 == $compact && ( is_home() || is_archive() || is_search() ) ) {

		// Retorna apenas o numero, sobrescrevendo a alteracao do Disqus
		return $number;

	// Se o modo de listagem compacta estiva inativa
	} else {

		// Retorna o output normal
		return $output;
	}
}


/**
 * Integracao com o Google Tag Manager
 *
 * @since  1.0.0
 * @return string
 */

function epico_google_tag_manager() {
	$gtm = get_theme_mod( 'epico_gtm', '' );

	if ( ! empty( $gtm ) ) {
		echo '<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=' . sanitize_text_field( $gtm ) . '"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,\'script\',\'dataLayer\',\'' . sanitize_text_field( $gtm ) . '\');</script>
<!-- End Google Tag Manager -->';
	}
}

/**
 * Forca o idioma do admin para Portugues do Brasil
 *
 * @since  1.0.0
 * @return string
 */


function epico_set_locale( $locale ) {
	if ( is_admin() ) {
		return 'pt_BR';
	}

	return $locale;
}


/**
 * Remove estilos e scripts em paginas determinadas pelo admin do blog
 *
 * @since  1.0.2
 * @return void
 */

function epico_remove_styles_scripts() {

	$ignore_pages = get_theme_mod( 'epico_page_ids' );

	if( ! empty( $ignore_pages ) ) {
		if( is_page( $ignore_pages ) ) {
			remove_action( 'wp_enqueue_scripts', 'epico_enqueue_styles', 0 );
			remove_action( 'wp_enqueue_scripts', 'epico_register_color_styles', 1 );
			remove_action( 'wp_enqueue_scripts', 'epico_enqueue_scripts' );
			wp_dequeue_style('epico_global_assets-epico_capture_styles-css');
		}
	}
}



/**
 * Apresenta artigos relacionados ao fim dos artigos
 *
 * @since  1.3.0
 * @return string
 */

function epico_get_related_posts( $post_id, $related_count, $args = array() ) {
	$args = wp_parse_args( (array) $args, array(
		'orderby' => 'rand',
		'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
	) );

	$related_args = array(
		'post_type'      => get_post_type( $post_id ),
		'posts_per_page' => $related_count,
		'post_status'    => 'publish',
		'post__not_in'   => array( $post_id ),
		'orderby'        => $args['orderby'],
		'tax_query'      => array()
	);

	$post       = get_post( $post_id );
	$taxonomies = get_object_taxonomies( $post, 'names' );

	foreach( $taxonomies as $taxonomy ) {
		$terms = get_the_terms( $post_id, $taxonomy );
		if ( empty( $terms ) ) continue;
		$term_list = wp_list_pluck( $terms, 'slug' );
		$related_args['tax_query'][] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $term_list
		);
	}

	if( count( $related_args['tax_query'] ) > 1 ) {
		$related_args['tax_query']['relation'] = 'OR';
	}

	if( $args['return'] == 'query' ) {
		return new WP_Query( $related_args );
	} else {
		return $related_args;
	}
}

/**
 * Obtem metadados adicionais para as imagens para utilizacao na funcao de artigos relacionados
 *
 * @since  1.3.0
 * @return void
 */

function epico_get_thumbnail_field( $field = 'alt', $post_id = null, $suppress_filters = FALSE ) {

	if ( $post_id === null ) {
		global $post;
		$post_id = $post->ID;
	}

	$attachment_id = get_post_thumbnail_id( $post_id );

	if ( $attachment_id ) {

		$data = wp_prepare_attachment_for_js( $attachment_id );

		// Obtendo um campo diferente do padrao
		if ( !isset($field, $data) ) {
			$meta = get_post_meta( $data['id'], $field );
			if ( !count($meta) ) return null; // campo nao encontrado
			$field = ( count($meta) == 1 ) ? maybe_unserialize( $meta ) : $meta ;
		}

		$field = $data[$field];

		if ( $suppress_filters || !is_string($field) ) return $field;

		return apply_filters('epico_get_thumbnail_field', $field);
	}

	return null;
}

/**
 * Filtra atributo da tag body para marca-las no padrao como `WebPage`
 *
 * @since  1.3.0
 * @return void
 */
function epico_attr_body( $attr ) {

	if ( is_singular( 'post' ) || is_home() || is_archive() ) {
		$attr['itemscope'] = '';
		$attr['itemtype']  = 'http://schema.org/WebPage';
	}

	return $attr;
}