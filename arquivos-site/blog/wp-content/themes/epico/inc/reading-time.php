<?php

/**
 * Funcoes para calcular o tempo de leitura do artigo
 *
 * @package    Epico
 * @subpackage Reading time
 * @version    1.0.0
 * @since      1.0.0
 * @author     Andrew Norcross <andrew@andrewnorcross.com>
 *
 */


/* apresenta o tempo de leitura */
add_filter( 'the_content', 'epico_display_read_time', 10 );

/* armazena o tempo de leitura */
add_action( 'save_post', 'epico_store_read_time' );

/**
 * Calcula o tempo de leitura
 * @param  integer $seconds [description]
 * @return [type]           [description]
 */
function epico_calc_read_time( $seconds = 0 ) {

	// Calculo dos minutos
	$minutes    = floor( $seconds / 60 );

	// Se o tempo for menor que um minuto, retorna
	if ( $minutes < 1 ) {
		return __( 'less than 1 minute', 'epico' );
	} else {
		return sprintf( _n( '%d minute', '%d minutes', $minutes, 'epico' ), $minutes );
	}
}

/**
 * Apresenta o tempo estimado para ler o conteudo
 *
 * @param  [type] $content [description]
 * @return [type]          [description]
 */
function epico_display_read_time( $content ) {

	// Busca o objeto global `post`
	global $post;

	// Atribui uma variavel a opcao do customizer
	$readingtime = get_theme_mod( 'epico_reading_time', 1 );

	// Atribui uma variavel a opcao de excluir paginas no customizer
	$reading_time_exclude = get_theme_mod( 'epico_reading_time_exclude' );

	// Converte o string em um array para o `is_page`

	// Se o checkbox da opcao do customizer esta ativado
	if ( 1 == $readingtime && ! is_page( $reading_time_exclude ) && ! is_page( 9999999 ) && ! is_admin() && ! is_attachment() && ! has_post_format( array( 'aside', 'quote', 'status' ) ) ) {

		// Checagem da chave meta
		$seconds    = get_post_meta( $post->ID, '_seconds_read_time', true );

		// Obtem o calculo
		$readtime   = epico_calc_read_time( $seconds );

		// Cria o prefixo
		$readprfx   = __( 'Reading time:', 'epico' );

		// Cria o involucro
		$readbox    = '<p class="estimated-read-time">' . esc_attr( $readprfx ) . '<small> ' . esc_attr( $readtime ) . '</small></p> ';

		// Devolve ao conteudo
		return $readbox.$content;

	}
		// Caso a opcao do customizer estiver desativada
		// devolva apenas o conteudo padrao
		return $content;
}


/**
 * Armazena o tempo estimado de leitura ao salvar o artigo
 *
 * @param  integer $post_id [description]
 * @return [type]           [description]
 */
function epico_store_read_time( $post_id = 0 ) {

	// Roda varias chegagens para verificar que esta tudo correto
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// Obtem o conteudo do post e a contagem de numero de caracteres
	$content    = get_post_field( 'post_content', $post_id, 'raw' );
	$wordnum    = str_word_count( strip_tags( $content ) );

	// Configura o tempo medio de leitura a 180 palavras por minuto
	$avgtime    = apply_filters( 'epico_estimated_reading_time', 180 );

	// calc the total seconds to read
	$seconds    = floor( (int) $wordnum / (int) $avgtime ) * 60;

	// update the post meta
	update_post_meta( $post_id, '_seconds_read_time', $seconds );

}

