<?php

	global $wp;

	$current_url = home_url( add_query_arg( array(), $wp->request ) ); // Obtem a URL atual

	echo '<!--[if IE]><div' . ( ( isset( $custom_id ) ) ? ' id="cs-' . esc_attr( $custom_id ) . '" ' : '' ) . ' class="capture-wrap uf-wrap ie"><![endif]--><!--[if !IE]><!--><div' . ( ( isset( $custom_id ) ) ? ' id="cs-' . esc_attr( $custom_id ) . '" ' : '' ) . ' class="capture-wrap uf-wrap sc"><!--<![endif]-->';

		echo '<div class="capture uf">';

			echo '<div class="capture-container uf-container">';

				echo '<div class="capture-container uf-container capture-inner">';

					if(0 == $atts['title_tag']){

						echo '<h4 itemprop="headline"';
					}

					if(1 == $atts['title_tag']){

						echo '<h3 itemprop="headline"';
					}

					if(2 == $atts['title_tag']){

						echo '<p itemprop="text"';
					}

					echo ' class="capture-title uf-title '.((1 == $atts['disable_animation'])?'fadeinleft':'').'">' . esc_html( implode(", ", (array)$atts['title']) );

					if(0 == $atts['title_tag']){

						echo '</h4>';
					}

					if(1 == $atts['title_tag']){

						echo '</h3>';
					}

					if(2 == $atts['title_tag']){

						echo '</p>';
					}

				if ( true == $atts[ 'icon_upload' ] ) {

					echo '<p itemprop="text" class="capture-icon uf-icon"><img src="' . esc_url( implode( ", ", ( array )$atts[ 'icon_upload' ] ) ) . '" class="icon';

						if ( 1 == $atts[ 'disable_animation' ] ){

							if ( 1 == $atts[ 'animation' ] ){

								echo ' fadeindown';
							}

							if ( 2 == $atts[ 'animation' ] ){

								echo ' fadeinup';
							}

							if ( 3 == $atts[ 'animation' ] ){

								echo ' fadein';
							}

							if ( 4 == $atts[ 'animation' ] ){

								echo ' bouncein';
							}

							if ( 5 == $atts[ 'animation' ] ){

								echo ' shake';
							}

							if ( 6 == $atts[ 'animation' ] ){

								echo ' swing';
							}

							if ( 7 == $atts[ 'animation' ] ){

								echo ' rollin';
							}

							if ( 8 == $atts[ 'animation' ] ){

								echo ' rotatein';
							}

						}

					echo '" /></p>';

				} else {

					echo '<p class="capture-icon uf-icon"><i class="' . esc_attr( implode( ", ", ( array )$atts[ 'icon' ] ) );

						if ( 1 == $atts[ 'disable_animation' ] ){

							if ( 1 == $atts[ 'animation' ] ){

								echo ' fadeindown';
							}

							if ( 2 == $atts[ 'animation' ] ){

								echo ' fadeinup';
							}

							if ( 3 == $atts[ 'animation' ] ){

								echo ' fadein';
							}

							if ( 4 == $atts[ 'animation' ] ){

								echo ' bouncein';
							}

							if ( 5 == $atts[ 'animation' ] ){

								echo ' shake';
							}

							if ( 6 == $atts[ 'animation' ] ){

								echo ' swing';
							}

							if ( 7 == $atts[ 'animation' ] ){

								echo ' rollin';
							}

							if ( 8 == $atts[ 'animation' ] ){

								echo ' rotatein';
							}

						}

					echo '"></i></p>';

				}

			echo '<p itemprop="text" class="capture-intro uf-intro ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'fadeinright' : '' ) . '">' . balanceTags( implode( ", ", ( array )$atts[ 'intro_p' ] ) , true ) . '<span class="uf-arrow"><svg fill="' . esc_attr( implode(", ", (array)$atts['arrow_color']) ) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.322 60">><polygon' . ( ( 1 == $atts[ 'override' ] ) ? ' fill="' . esc_attr( implode( ", ", (array)$atts[ 'arrow_color' ] ) ) . '"' : '' ) . ' points="33.831,36.839 23.161,0 12.491,36.839 0,36.839 23.161,60 46.322,36.839"/></svg></span></p>';

			echo '</div>';

		echo '</div>';

		echo '<div class="capture capture-form uf ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'animated' : '' ) . '">';

			echo '<div class="capture-container uf-container">';

				if(1 == $atts['sidebar']) {

					echo '<p itemprop="text" class="capture-notice uf-notice '.((1 == $atts['disable_animation'])?'fadeinleft':'').'">' .balanceTags( implode(", ", (array)$atts['notice']) , true ) . '</p>';
				}

				if(2 == $atts['sidebar']) {

					if(1 == $atts['close_btn']) {

						echo '<div id="cw-' . esc_attr( $custom_id ) . '-close" class="uf-close capture-close">
								<span aria-hidden="true"><i class="fa fa-times-circle '.((1 == $atts['disable_animation'])?'fadein':'').'"></i></span>

							<span class="capture-hide uf-hide" aria-label="' . __('Close') . '">' . __('Close') . '</span>

						</div>';
					}
				}

				// Email marketing services

						if ( 1 == $atts[ 'email_service' ] ) { // MailChimp

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="post" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '" name="mc-embedded-subscribe-form" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="email" value="" name="EMAIL" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" type="submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" name="subscribe" id="mc-embedded-subscribe">

								</span>

							</form>';
						}

						if ( 2 == $atts[ 'email_service' ] ) { // AWeber

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' : '' ) . ' method="post" accept-charset="iso-8859-1" action="http://www.aweber.com/scripts/addlead.pl" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input type="hidden" name="listname" value="' . ( isset( $atts[ 'list_id' ] ) ? esc_attr( $atts[ 'list_id' ] ) : '' ) . '">

								<input type="hidden" name="redirect" value="' . ( isset( $atts[ 'redirect_url' ] ) ? esc_url( $atts[ 'redirect_url' ] ) : '' ) . '" >';

								if( ! empty( $atts[ 'redirect_subscribed_url' ] ) ) {

								echo '<input type="hidden" name="meta_redirect_onlist" value="' . esc_url( $atts[ 'redirect_subscribed_url' ] ) . '" >';
								}

								echo '<input type="hidden" name="meta_message" value="1">

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="email" value="" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

								</span>

							</form>';
						}

						if ( 3 == $atts[ 'email_service' ] ) { // MadMimi


							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="post" accept-charset="UTF-8" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" name="signup[email]" type="text" value="" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" name="uf-submit" type="submit" value="' . ( isset( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '">

								</span>

							</form>';
						}

						if ( 4 == $atts[ 'email_service' ] ) { // Campaign Monitor

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="post" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" name="' . ( isset( $atts[ 'email_field' ] ) ? esc_attr( $atts[ 'email_field' ] ) : '' ) . '" type="email" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

								</span>

							</form>';
						}

						if ( 5 == $atts[ 'email_service' ] ) { // e-Goi

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="post" enctype="multipart/form-data" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input type="hidden" name="lista" value="' . ( isset( $atts[ 'list_id' ] ) ? esc_attr( $atts[ 'list_id' ] ) : '' ) . '">

								<input type="hidden" name="cliente" value="' . esc_attr( $atts[ 'client_number' ] ) . '">

								<input type="hidden" name="lang" id="lang_id" value="br">

								<input type="hidden" name="formid" id="formid" value="' . ( isset( $atts[ 'webform_id' ] ) ? esc_attr( $atts[ 'webform_id' ] ) : '' ) . '">

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="email" name="' . ( isset( $atts[ 'email_field' ] ) ? esc_attr( $atts[ 'email_field' ] ) : '' ) . '" easylabel="E-mail" alt="" id="' . ( isset( $atts[ 'email_field' ] ) ? esc_attr( $atts[ 'email_field' ] ) : '' ) . '" value="" easyvalidation="true" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

								</span>

							</form>';
						}

						if ( 6 == $atts[ 'email_service' ] ) { // Get Response


							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . '  method="post" accept-charset="utf-8" action="https://app.getresponse.com/add_contact_webform.html" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>
								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="email" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

									<span class="capture-wrapicon uf-wrapicon">

										<input class="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit" name="submit">

										<input type="hidden" name="webform_id" value="' . ( isset( $atts[ 'webform_id' ] ) ? esc_attr( $atts[ 'webform_id' ] ) : '' ) . '">

									</span>

							</form>';
						}

						if ( 7 == $atts[ 'email_service' ] ) { // Mailee Me

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="post" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input name="key" type="hidden" value="' . ( isset( $atts[ 'webform_id' ] ) ? esc_attr( $atts[ 'webform_id' ] ) : '' ) . '">

								<input name="list[]" type="hidden" value="' . ( isset( $atts[ 'list_id' ] ) ? esc_attr( $atts[ 'list_id' ] ) : '' ) . '">


								<input type="hidden" name="url_ok" value="' . ( isset( $atts[ 'redirect_url' ] ) ? esc_url( $atts[ 'redirect_url' ] ) : '' ) . '">

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="email" value="" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

								</span>

							</form>';
						}

						if ( 8 == $atts[ 'email_service' ] ) { // Mail Relay

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="post" enctype="application/x-www-form-urlencoded" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input type="hidden" name="name" id="name" value="-" />

								<input type="hidden" name="groups[]" value="' . ( isset( $atts[ 'list_id' ] ) ? esc_attr( $atts[ 'list_id' ] ) : '' ) . '" />

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="email" value="" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

								</span>

							</form>';
						}


						if ( 9 == $atts[ 'email_service' ] ) { // KlickMail

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="post" action="https://www.klickmail.com.br/subscribe.php" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . ' accept-charset="UTF-8" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input type="hidden" name="FormValue_FormID" value="' . ( isset( $atts[ 'webform_id' ] ) ? esc_attr( $atts[ 'webform_id' ] ) : '' ) . '" />

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="FormValue_Fields[EmailAddress]" value="" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" name="FormButton_Subscribe" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

								</span>

							</form>';
						}


						if ( 10 == $atts[ 'email_service' ] ) { // Arpreach

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="post" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" id="email_address" name="email_address" value="" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" type="submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '">

								</span>

							</form>';
						}

						if ( 11 == $atts[ 'email_service' ] ) { // Active Campaign

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="post" enctype="multipart/form-data" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '" accept-charset="utf-8" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input type="hidden" name="f" value="' . ( isset( $atts[ 'webform_id' ] ) ? esc_attr( $atts[ 'webform_id' ] ) : '' ) . '">

								<input type="hidden" name="s" value="">

								<input type="hidden" name="c" value="0">

								<input type="hidden" name="m" value="0">

								<input type="hidden" name="act" value="sub">

								<input type="hidden" name="nlbox[]" value="' . ( isset( $atts[ 'list_id' ] ) ? esc_attr( $atts[ 'list_id' ] ) : '' ) . '">

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="email" name="email" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

								</span>

							</form>';
						}

						if ( 12 == $atts[ 'email_service' ] ) { // RD Station

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="POST" action="https://www.rdstation.com.br/api/1.2/conversions" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input type="hidden" name="token_rdstation" value="' . ( isset( $atts[ 'token' ] ) ? esc_attr( $atts[ 'token' ] ) : '' ) . '">

								<input type="hidden" name="identificador" value="' . ( isset( $custom_id ) ? esc_attr( $custom_id ) : '' ) . '">

								<input type="hidden" name="redirect_to" value="' . ( isset( $atts[ 'redirect_url' ] ) ? esc_url( $atts[ 'redirect_url' ] ) : '' ) . '">

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="email" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<input type="hidden" name="c_utmz" id="c_utmz" value="" />

								<script type="text/javascript">
									function read_cookie(a){var b=a+"=";var c=document.cookie.split(";");for(var d=0;d<c.length;d++){var e=c[d];while(e.charAt(0)==" ")e=e.substring(1,e.length);if(e.indexOf(b)==0){return e.substring(b.length,e.length)}}return null}try{document.getElementById("c_utmz").value=read_cookie("__utmz")}catch(err){}
								</script>

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

								</span>

							</form>';
						}

						if ( 13 == $atts[ 'email_service' ] ) { // Lead Lovers

								echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" ' : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="post" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

									<input type="hidden" name="id" value="' . ( isset( $atts[ 'webform_id' ] ) ? esc_attr( $atts[ 'webform_id' ] ) : '' ) . '">

									<input name="pid" type="hidden" value="' . ( isset( $atts[ 'webform_id_alt' ] ) ? esc_attr( $atts[ 'webform_id_alt' ] ) : '' ) . '" />

									<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="email" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

									<input type="hidden" name="source" value="' . $current_url . '" />

									<span class="capture-wrapicon uf-wrapicon">

										<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

									</span>

								</form>';
							}

						if ( 14 == $atts[ 'email_service' ] ) { // Sendy

								echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" ' : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="POST" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '/subscribe" accept-charset="utf-8" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

									<input type="hidden" name="list" value="' . ( isset( $atts[ 'list_id' ] ) ? esc_attr( $atts[ 'list_id' ] ) : '' ) . '">

									<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="email" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

									<span class="capture-wrapicon uf-wrapicon">

										<input class="uf-submit" name="sub-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

									</span>

								</form>';
							}

						if ( 15 == $atts[ 'email_service' ] ) { // Benchmark

								echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" ' : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="POST" action="https://lb.benchmarkemail.com//code/lbform" accept-charset="UTF-8" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

									<input type="hidden" name="successurl" value="' . ( isset( $atts[ 'redirect_url' ] ) ? esc_url( $atts[ 'redirect_url' ] ) : '' ) . '" >

									<input type="hidden" name="token" value="' . ( isset( $atts[ 'token' ] ) ? esc_attr( $atts[ 'token' ] ) : '' ) . '">

									<input type="hidden" name="doubleoptin" value="" />

									<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="fldEmail" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

									<span class="capture-wrapicon uf-wrapicon">

										<input class="uf-submit" krydebug="1751" name="submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

									</span>

								</form>';
							}

						if ( 16 == $atts[ 'email_service' ] ) { // Mail2Easy - Dinamize

								echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" ' : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="POST" action="' . ( ( 1 == $atts[ 'optin' ] ) ? 'http://cache.mail2easy.com.br/integracao' : 'http://cache.mail2easy.com.br/double-optin' ) . '" accept-charset="UTF-8" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

									<input type="hidden" name="CON_ID" value="' . ( isset( $atts[ 'webform_id' ] ) ? esc_attr( $atts[ 'webform_id' ] ) : '' ) . '">

									<input type="hidden" name="DESTINO" value="' . ( isset( $atts[ 'redirect_url' ] ) ? esc_url( $atts[ 'redirect_url' ] ) : '' ) . '" >

									<input type="hidden" name="GRUPOS_CADASTRAR" value="' . ( isset( $atts[ 'list_id' ] ) ? esc_attr( $atts[ 'group_id' ] ) : '' ) . '" />

									<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="SMT_email" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

									<span class="capture-wrapicon uf-wrapicon">

										<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

									</span>

								</form>';
							}

						if ( 17 == $atts[ 'email_service' ] ) { // MyMail

								echo '<form action="' . get_site_url() . '/wp-admin/admin-ajax.php" method="post" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

									<input name="_extern" type="hidden" value="1">

									<input name="action" type="hidden" value="mymail_form_submit">

									<input name="formid" type="hidden" value="' . ( ! empty( $atts[ 'webform_id' ] ) ? esc_attr( $atts[ 'webform_id' ] ) : '0' ) . '">

									<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="userdata[email]" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

									<span class="capture-wrapicon uf-wrapicon">

										<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

									</span>

								</form>';
							}

						if ( 18 == $atts[ 'email_service' ] ) { // Trafficwave

								echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" ' : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . 'name="TRWVLCPForm" method="POST" action="http://www.trafficwave.net/cgi-bin/autoresp/inforeq.cgi" accept-charset="UTF-8" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

									<input type="hidden" name="trwvid" value="' . ( isset( $atts[ 'client_number' ] ) ? esc_attr( $atts[ 'client_number' ] ) : '' ) . '">

									<input type="hidden" name="series" value="' . ( isset( $atts[ 'campaign_id' ] ) ? esc_attr( $atts[ 'campaign_id' ] ) : '' ) . '">

									<input type="hidden" name="subscrLandingURL" value="' . ( isset( $atts[ 'redirect_url' ] ) ? esc_url( $atts[ 'redirect_url' ] ) : '' ) . '" >

									<input type="hidden" name="confirmLandingURL" value="' . ( isset( $atts[ 'redirect_confirm_url' ] ) ? esc_url( $atts[ 'redirect_confirm_url' ] ) : '' ) . '" >

									<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="text" name="da_email" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

									<span class="capture-wrapicon uf-wrapicon">

										<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

									</span>

								</form>';
							}

						if ( 19 == $atts[ 'email_service' ] ) { // InfusionSoft

							echo '<form ' . ( isset( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '" '  : '' ) . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="POST" action="' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '" accept-charset="UTF-8" ' . ( ( 1 == $atts[ 'new_window' ] ) ? 'target="_blank"' : '' ) . '>

								<input type="hidden" name="inf_form_xid" value="' . ( isset( $atts[ 'webform_id' ] ) ? esc_attr( $atts[ 'webform_id' ] ) : '' ) . '">

								<input name="infusionsoft_version" type="hidden" value="1.44.0.49" />

								<input id="inf_field_FirstName" name="inf_field_FirstName" type="hidden" value="&nbsp;" />

								<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="email" name="inf_field_Email" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

								</span>

							</form>

							' . ( ! empty( $atts[ 'tracking_code' ] ) ? '<script type="text/javascript" src="' . esc_url( $atts[ 'tracking_code' ] ) . '"></script>' : '' );
						}

						if ( 20 == $atts[ 'email_service' ] ) { // Google Planilhas

							echo '<form id="uf-input-form" ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' method="POST" action="" accept-charset="UTF-8" target="no-target-'  . esc_attr( $custom_id ) . '" onsubmit="submitted=true;">

								<input id="uf-input-email" class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="email" name="email" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

								<span class="capture-wrapicon uf-wrapicon">

									<input id="uf-form-submit" class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

								</span>

							</form>

							<iframe src="#" id="no-target-'  . esc_attr( $custom_id ) . '" name="no-target-'  . esc_attr( $custom_id ) . '" style="visibility:hidden;display:none" onload="if(submitted){';

                                if ( 1 == $atts[ 'new_window' ] ) {

                                    echo 'window.location=\'' . ( isset( $atts[ 'redirect_url' ] ) ? esc_url( $atts[ 'redirect_url' ] ) : esc_url( $current_url ) ) . '\'';

                                } else {

                                    echo 'window.open(\'' . ( isset( $atts[ 'redirect_url' ] ) ? esc_url( $atts[ 'redirect_url' ] ) : esc_url( $current_url ) ) . '\', \'_blank\')';

                                }

                                echo ';}"></iframe>

							<script type="text/javascript">var submitted = false;</script>

							<script type="text/javascript">
								(function($) {
									$(\'#uf-input-form\').one(\'submit\', function() {
										var inputName = encodeURIComponent($(\'#uf-input-email\').val());
										var baseURL = \'' . ( isset( $atts[ 'form_action' ] ) ? esc_url( $atts[ 'form_action' ] ) : '' ) . '?' . ( isset( $atts[ 'email_field' ] ) ? esc_attr( $atts[ 'email_field' ] ) : '' ) . '=\';
										var submitRef = \'&submit=Submit\';
										var submitURL = (baseURL + inputName + submitRef);
										$(this)[0].action = submitURL;
									});
								})( jQuery );
							</script>
							';
						}

						if ( 21 == $atts[ 'email_service' ] ) { // Mail Poet

							echo '<form ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'class="fadeinright"' :'' ) . ' action="#wysija" method="POST" target="no-target-'  . esc_attr( $custom_id ) . '" onsubmit="submitted=true;">

									<input class="uf-email ' . ( ( 1 == $atts[ 'disable_animation' ] ) ? 'pulse' : '' ) . '" type="email" name="wysija[user][email]" placeholder="' . ( isset( $atts[ 'placeholder' ] ) ? ' ' . esc_attr( $atts[ 'placeholder' ] ) : '' ) . '">

									<input type="hidden" name="form_id" value="' . ( isset( $atts[ 'webform_id' ] ) ? esc_attr( $atts[ 'webform_id' ] ) : '' ) . '" />

									<input type="hidden" name="action" value="save" />

									<input type="hidden" name="controller" value="subscribers" />

									<input type="hidden" value="1" name="wysija-page" />

									<input type="hidden" name="wysija[user_list][list_ids]" value="' . ( isset( $atts[ 'list_id' ] ) ? esc_attr( $atts[ 'list_id' ] ) : '' ) . '" />

									<span class="capture-wrapicon uf-wrapicon">

										<input id="uf-form-submit" class="uf-submit" name="uf-submit" value="' . ( ! empty( $atts[ 'placeholder_submit' ] ) ? esc_attr( $atts[ 'placeholder_submit' ] ) : __('Subscribe!', 'uf-epico' ) ) . '" type="submit">

									</span>

								</form>

								<script type="text/javascript">
									var submitted = false;
								</script>

								<iframe src="#" id="no-target-'  . esc_attr( $custom_id ) . '" name="no-target-'  . esc_attr( $custom_id ) . '" style="visibility:hidden;display:none" onload="if(submitted){';

                                if ( 1 == $atts[ 'new_window' ] ) {

                                    echo 'window.open(\'' . ( isset( $atts[ 'redirect_url' ] ) ? esc_url( $atts[ 'redirect_url' ] ) : esc_url( $current_url ) ) . '\', \'_blank\')';

                                } else {

                                    echo 'window.location=\'' . ( isset( $atts[ 'redirect_url' ] ) ? esc_url( $atts[ 'redirect_url' ] ) : esc_url( $current_url ) ) . '\'';

                                }

                                echo ';}"></iframe>
							';
						}

				echo '</div>';

			echo '</div>';

		echo '</div>';

	echo '</div>';

?>