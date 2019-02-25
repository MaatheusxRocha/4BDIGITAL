		<div class="nav-posts">

			<div class="prev resize-me">
				<?php previous_post_link('%link', __( '<span>Previous Post</span> %title', 'epico' ) ); ?>

   				<?php if( ! get_adjacent_post( false, '', true ) ) { echo __( '<a id="no-previous" class="noposts"><span>First post</span>&times; No previous post</a>', 'epico' ); } // Se nao houver artigos anteriores ?>

			</div>

			<div class="next resize-me">

				<?php next_post_link('%link',  __( '<span>Next Post</span> %title', 'epico' ) ); ?>

   				<?php if( ! get_adjacent_post( false, '', false ) ) { echo  __( '<a id="no-next" class="noposts"><span>Last post</span> No post next &times;</a>', 'epico' ); } // Se nao houver artigos posteriores ?>

			</div>

		</div> <!-- .nav-posts -->