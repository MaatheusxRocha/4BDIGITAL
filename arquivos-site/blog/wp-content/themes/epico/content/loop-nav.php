	<?php if ( is_home() || is_archive() || is_search() ) : // Se estiver visualizando o blog, um arquivo ou resultados da busca. ?>

		<?php loop_pagination(
			array(
				'prev_text' => _x( '&larr; Previous', 'posts navigation', 'epico' ),
				'next_text' => _x( 'Next &rarr;',     'posts navigation', 'epico' )
			)
		); ?>

	<?php endif; // Finaliza a checagem por tipo de pagina sendo visualizada. ?>