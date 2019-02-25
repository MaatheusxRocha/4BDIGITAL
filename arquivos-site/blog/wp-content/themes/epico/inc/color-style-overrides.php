<?php

/* Sobrescrevendo opcoes de cores a partir do customizer */
add_action( 'wp_enqueue_scripts', 'epico_main_color_override', 10 );

/* Cor de fundo da landing page */
add_action( 'wp_enqueue_scripts', 'epico_landing_page_background_color', 10 );

/* Imagem de fundo da landing page */
add_action( 'wp_enqueue_scripts', 'epico_landing_page_background_image', 10 );

/* Ajustes no CSS do botoes de compartilhamento de acordo com as opcoes ativadas  */
add_action( 'wp_enqueue_scripts', 'epico_social_total_parcial', 10 );


/**
 * Funcao auxiliar - Altera o brilho da cor informada
 *
 * $diff deve ser negativo para cor mais escura e positivo para claro
 * o valor e subtraido do valor decimal da cor (0-255)
 *
 * @version 1.0.0
 * @since   1.0.0
 * @param   string $hex  cor a ser modificada
 * @param   string $diff quantidade a ser alterada
 * @return  string cor   hexadecimal
 */

function epico_hex_color_mod($hex, $diff) {
  $rgb = str_split(trim($hex, '# '), 2);

  foreach ($rgb as &$hex) {
    $dec = hexdec($hex);
    if ($diff >= 0) {
      $dec += $diff;
    }
    else {
      $dec -= abs($diff);
    }
    $dec = max(0, min(255, $dec));
    $hex = str_pad(dechex($dec), 2, '0', STR_PAD_LEFT);
  }

  return '#'.implode($rgb);
}

/**
 * Sobrescrevendo opcoes de cores a partir do customizer
 *
 * @since   1.0.0
 * @version 1.0.1
 * @return  string
 */
function epico_main_color_override() {

	$colorOverrideOption =  get_theme_mod( 'epico_color_override_option', 0);

	$newColorOverride =  get_theme_mod( 'epico_color_override', '#000000' );

	// Se o campo possui um valor definido
	if ( 1 == $colorOverrideOption ) {

		// Define os estilos CSS customizados
		$custom_inline_style = '
	/* Cor principal */
	.epc-ovr[class*="epc-s"] #sidebar-primary section[class*="epico_pages"] a,
	.epc-ovr[class*="epc-s"] #sidebar-primary section[class*="epico_links"] a {
		background: ' . $newColorOverride . ';
		}

	.epc-ovr #footer ::-moz-selection,
	.epc-ovr #sidebar-promo ::-moz-selection,
	.epc-ovr section[class*="pop-id"] ::-moz-selection,
	.epc-ovr .capture-wrap ::-moz-selection {
		background: ' . $newColorOverride . ' !important;
		}

	.epc-ovr #footer ::selection,
	.epc-ovr #sidebar-promo ::selection,
	.epc-ovr section[class*="pop-id"] ::selection,
	.epc-ovr .capture-wrap ::selection {
		background: ' . $newColorOverride . ' !important;
		}
	.epc-ovr .wp-calendar > caption,
	.epc-ovr input[type="submit"],
	.epc-ovr #nav input.search-submit[type="submit"],
	.epc-ovr .not-found input.search-submit[type="submit"],
	.epc-ovr.zen #sidebar-after-content .sb.capture-wrap form .uf-submit,
	.epc-ovr .pagination .page-numbers.current {
		background: ' . $newColorOverride . ' !important;
		}

	.epc-ovr[class*="epc-s"] .uberaviso,
	.epc-ovr[class*="epc-s"] .fw.capture-wrap form .uf-submit,
	.epc-ovr[class*="epc-s"] .sb.capture-wrap form .uf-submit,
	.epc-ovr[class*="epc-s"] .sc.capture-wrap form .uf-submit,
	.epc-ovr[class*="epc-s"] #sidebar-after-content .sb.capture-wrap form .uf-submit,
	.epc-ovr[class*="epc-s"] .widget_epico_author-id a[class*="button"] {
		background: ' . $newColorOverride . ';
		}

	.epc-ovr #credits,
	.epc-ovr #footer .widget_tag_cloud a:hover,
	.epc-ovr .loop-meta,
	.epc-ovr #menu-primary-items .sub-menu li:hover,
	.epc-ovr .epc-button-border-primary,
	.epc-ovr #comments .comment-reply-link,
	.epc-ovr #footer .search-field:hover,
	.epc-ovr #footer .search-field:focus,
	.epc-ovr .author-profile,
	.epc-ovr.page-template-landing {
		border-color: ' . $newColorOverride . ' !important;
		}

	.epc-ovr[class*="epc-s"] #sidebar-primary .widget_epico_pop-id,
	.epc-ovr[class*="epc-s"] #footer .widget_social-id a:hover {
		border-color: ' . $newColorOverride . ';
		}

	.epc-ovr .epc-button-border-primary,
	.epc-ovr #comments .comment-reply-link,
	.epc-ovr #footer .widget_social-id a:hover,
	.epc-ovr #sidebar-top li:hover:before,
	.epc-ovr #menu-primary .sub-menu li:hover:before,
	.epc-ovr #footer li:hover:before,
	.epc-ovr #menu-primary li.menu-item-has-children:hover:before,
	.epc-ovr #menu-secondary li:hover:before,
	.epc-ovr #search-toggle:hover:after,
	.epc-ovr .search-close .search-text,
	.epc-ovr #search-toggle:before,
	.epc-ovr #search-toggle:hover .search-text,
	.epc-ovr .search-text:hover,
	.epc-ovr #zen:hover i,
	.epc-ovr #zen.zen-active i,
	.epc-ovr #zen.zen-active:hover i,
	.epc-ovr.zen #footer a{
		color: ' . epico_hex_color_mod( $newColorOverride, -20 ) . ' !important;
		}

	.epc-ovr #sidebar-primary .widget_epico_pop-id h3[class*="title"]:before,
	.epc-ovr #sidebar-primary section[class*="epico_pages"] h3[class*="title"]:before {
		color: ' . epico_hex_color_mod( $newColorOverride, -20 ) . ';
		}

	.epc-ovr[class*="epc-s"] .fw.capture-wrap .uf-arrow svg polygon,
	.epc-ovr[class*="epc-s"] .sb.capture-wrap .uf-arrow svg polygon,
	.epc-ovr.zen #sidebar-after-content .sb.capture-wrap .uf-arrow svg polygon {
		fill: ' . $newColorOverride . ';
		}

	@media only screen and (max-width: 680px) {
		.epc-ovr #menu-primary > ul > li:hover:before,
		.epc-ovr #menu-primary li:hover:before,
		.epc-ovr #nav-toggle:hover .nav-text,
		.epc-ovr .nav-active #nav-toggle .nav-text {
			color: ' . epico_hex_color_mod( $newColorOverride, -20 ) . ' !important;
			}
		.epc-ovr #menu-primary-items > li:hover {
			border-color: ' . epico_hex_color_mod( $newColorOverride, -20 ) . ' !important;
			}
		.epc-ovr .nav-active #nav-toggle span:before,
		.epc-ovr .nav-active #nav-toggle span:after,
		.epc-ovr #nav-toggle:hover .screen-reader-text,
		.epc-ovr #nav-toggle:hover .screen-reader-text:after,
		.epc-ovr #nav-toggle:hover .screen-reader-text:before {
			background: ' . $newColorOverride . ' !important;
			}
		}
	@media only screen and (min-width: 680px) {
		.epc-ovr #header a {
			color: ' . $newColorOverride . ';
			}
		}
	.epc-ovr #page #sidebar-primary .widget_epico_pop-id h3[class*="title"]:before,
	.epc-ovr #page #sidebar-primary .widget_epico_pop-id li:hover:before,
	.epc-ovr #page #sidebar-primary section[class*="epico_pages"] h3[class*="title"]:before,
	.epc-ovr #main-container a,
	.epc-ovr.plural .format-default .entry-author,
	.epc-ovr #breadcrumbs a,
	.epc-ovr #branding a,
	.epc-ovr #header #nav a:hover,
	.epc-ovr #footer .widget_tag_cloud a:hover:before,
	.epc-ovr #zen.zen-active:hover i,
	.epc-ovr.page-template-landing #footer a,
	.epc-ovr #main-container #sidebar-primary .widget_epico_pop-id a {
		color: ' . $newColorOverride . ';
		}
	.epc-ovr .pagination .page-numbers,
	.epc-ovr[class*="epc-s"].plural .format-default .entry-byline a,
	.epc-ovr[class*="epc-s"].plural .format-default .entry-author,
	.epc-ovr[class*="epc-s"] .widget_epico_author-id a[class*="button"] {
		color: white !important;
	}

	.epc-ovr #footer ::-moz-selection,
	.epc-ovr #sidebar-promo ::-moz-selection,
	.epc-ovr section[class*="pop-id"] ::-moz-selection,
	.epc-ovr .capture-wrap ::-moz-selection,
	.epc-ovr #footer ::selection,
	.epc-ovr #sidebar-promo ::selection,
	.epc-ovr section[class*="pop-id"] ::selection,
	.epc-ovr .capture-wrap ::selection,
	.epc-ovr .widget_social-id a,
	.epc-ovr .widget_epico_author-id a[class*="button"] {
		color: white;
	}

	.epc-ovr.epc-s1 .uf_epicoepico_pop a,
	.epc-ovr.epc-s2 .uf_epicoepico_pop a,
	.epc-ovr.epc-s3 .uf_epicoepico_pop a {
		color: #AEBBC2;
	}
	.epc-ovr #main-container a:hover,
	.epc-ovr.page-template-landing #footer a:hover {
		color: #344146
		}

	.epc-ovr input[type="submit"]:hover,
	.epc-ovr #nav input.search-submit[type="submit"]:hover,
	.epc-ovr .not-found input.search-submit[type="submit"]:hover,
	.epc-ovr #nav input.search-submit[type="submit"]:active,
	.epc-ovr .not-found input.search-submit[type="submit"]:active,
	.epc-ovr.zen #sidebar-after-content .sb.capture-wrap form .uf-submit:hover,
	.epc-ovr .pagination .page-numbers.current:active,
	.epc-ovr .pagination .page-numbers.current:hover {
		background: ' . epico_hex_color_mod( $newColorOverride, -40 ) . ' !important;
		}

	.epc-ovr .fw.capture-wrap form .uf-submit:hover,
	.epc-ovr .sb.capture-wrap form .uf-submit:hover,
	.epc-ovr .sc.capture-wrap form .uf-submit:hover,
	.epc-ovr #sidebar-after-content .sb.capture-wrap form .uf-submit:hover,
	.epc-ovr .widget_epico_author-id a[class*="button"]:hover,
	.epc-ovr[class*="epc-s"] #sidebar-primary section[class*="epico_pages"] a:hover,
	.epc-ovr[class*="epc-s"] #sidebar-primary section[class*="epico_links"] a:hover {
		background: ' . epico_hex_color_mod( $newColorOverride, -40 ) . ';
		}';


    	// Adiciona o estilo inline (depende da folha de estilos principal ter sido carregada)
    	wp_add_inline_style( 'style', $custom_inline_style );
	}
}

/**
 * Ativa a cor de fundo da pagina landing
 *
 * @since   1.2.0
 * @version 1.0.1
 * @return  string
 */
function epico_landing_page_background_color() {

	$landingBkgColor =  get_theme_mod( 'epico_landing_bkg_color', '#FFFFFF' );

	if ( ! empty( $landingBkgColor ) ) {

		$custom_inline_style_landing_color = '
			.page-template-landing[class*="epc-s"] {
				background: '. $landingBkgColor . ';
			}

			.page-template-landing[class*="epc-s"] #page {
				border-top: none !important
			}';

		// Adiciona o estilo inline (depende da folha de estilos principal ter sido carregada)
		wp_add_inline_style( 'style', $custom_inline_style_landing_color );
	}
}

/**
 * Ativa a imagem de fundo da pagina landing
 *
 * @since   1.2.0
 * @version 1.0.1
 * @return  string
 */
function epico_landing_page_background_image() {

	$landingBkgImage =  get_theme_mod( 'epico_landing_bkg_img' );

	if ( ! empty( $landingBkgImage ) ) {

		$custom_inline_style_landing_image = '
			.page-template-landing[class*="epc-s"] {
				background: url("'. $landingBkgImage . '") repeat 0 0;
			}';

		// Adiciona o estilo inline (depende da folha de estilos principal ter sido carregada)
		wp_add_inline_style( 'style', $custom_inline_style_landing_image );
	}
}

/**
 * Corrige espacamentos dos botoes no mobile de acordo com as opcoes ativadas
 *
 * @since   1.5.0
 * @version 1.0.0
 * @return  string
 */
function epico_social_total_parcial() {

	$socialTotal =  get_theme_mod( 'epico_socialcounter', 1 );

	$socialParcial =  get_theme_mod( 'epico_socialpartialcount', 1 );

	$socialBtnFacebook =  get_theme_mod( 'epico_socialfacebook', 1 );

	$socialBtnTwitter =  get_theme_mod( 'epico_socialtwitter', 1 );

	$socialBtnGoogle =  get_theme_mod( 'epico_socialgoogle', 1 );

	$socialBtnPinterest =  get_theme_mod( 'epico_socialpinterest', 1 );

	$socialBtnLinkedin =  get_theme_mod( 'epico_sociallinkedin', 1 );

	$socialBtnWhatsapp =  get_theme_mod( 'epico_socialwhatsapp', 1 );

	// Soma a quantidade de botoes
	$socialButtonSum = $socialBtnFacebook + $socialBtnTwitter + $socialBtnGoogle + $socialBtnPinterest + $socialBtnLinkedin + $socialBtnWhatsapp;

	// Entre 3 e 4 botoes: ajusta espacamentos e mantem contadores parciais
	if ( 0 == $socialTotal && 1 == $socialParcial && $socialButtonSum >= 2 && $socialButtonSum <= 3 ) {

		$custom_inline_style_social_total_parcial = '
			@media screen and (max-width: 420px) {

				.social-bar {
					padding: 1.6rem 0.5rem;
					}

				.social-likes__counter {
					padding: 0 0.4em;
					}

				.social-likes__button,
				.social-likes__icon {
					width: 1.8em;
					}

				.social-total-shares {
					right:-15px
					}

				.social-likes + .social-total-shares {
					margin: 0;
					padding: 0 5px
					}

				#social-bar-sticky #social-close {
					right: -23px;
					position: relative;
					}

				.sticky-active .social-likes {
					position: relative;
					left: -20px;
					}

				.sticky-active .social-total-shares {
					right: 0px;
					}

				.sticky-active #social-bar-sticky #social-close {
					right: 10px;
					}
				}';

		// Adiciona o estilo inline (depende da folha de estilos principal ter sido carregada)
		wp_add_inline_style( 'style', $custom_inline_style_social_total_parcial );

	// Entre 2 e 3 botoes: ajusta espacamentos e mantem contadores parciais + totais
	} else if ( 1 == $socialTotal && 1 == $socialParcial && $socialButtonSum >= 2 && $socialButtonSum <= 3 ) {

		$custom_inline_style_social_total_parcial = '
			@media screen and (max-width: 420px) {

				.social-bar {
					padding: 1.6rem 0.5rem;
					}

				.social-likes__counter {
					padding: 0 0.5em;
					}

				.social-likes__button,
				.social-likes__icon {
					width: 1.5em;
					}

				.social-total-shares {
					right:-15px
					}

				.social-likes + .social-total-shares {
					margin: 0;
					padding: 0 5px
					}

				#social-bar-sticky #social-close {
					right: -23px;
					position: relative;
					}

				.sticky-active .social-likes {
					position: relative;
					left: -20px;
					}

				.sticky-active .social-total-shares {
					right: 0px;
					}

				.sticky-active #social-bar-sticky #social-close {
					right: 5px;
					}
				}';

		// Adiciona o estilo inline (depende da folha de estilos principal ter sido carregada)
		wp_add_inline_style( 'style', $custom_inline_style_social_total_parcial );

	// Remove contadores parciais se houver + de 3 botoes e mantem totais
	} else if ( ( 1 == $socialTotal || 0 == $socialTotal ) && 1 == $socialParcial && $socialButtonSum > 3 ) {

		$custom_inline_style_social_total_parcial = '
			@media screen and (max-width: 420px) {

				.social-likes__counter {
					display: none;
					}

				.sticky-active .social-total-shares {
					right: 0px;
					}

				.sticky-active #social-bar-sticky #social-close {
					right: 5px;
					}
				}';

		// Adiciona o estilo inline (depende da folha de estilos principal ter sido carregada)
		wp_add_inline_style( 'style', $custom_inline_style_social_total_parcial );
	}
}