<?php if ( function_exists( 'breadcrumb_trail' ) ) : // Checa por suporte a breadcrumbs. ?>

 <div id="breadcrumbs">

	<div class="wrap">

		<?php breadcrumb_trail(
			array(
				'container'     => 'nav',
				'separator'     => ' ',
				'show_browse'   => false,
				'show_on_front' => false,
			)
		); ?>

	</div>

 </div>

 <?php endif; // Finaliza a checagem por suporte a breadcrumbs. ?>