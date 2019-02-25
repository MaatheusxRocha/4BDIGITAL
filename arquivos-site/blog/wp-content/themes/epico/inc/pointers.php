<?php

/**
 * Tour de ativacao do tema
 *
 * Classe para configurar os pointers do tour.
 * @package    Epico
 * @subpackage Pointers
 * @version    1.0.0
 * @since      1.0.0
 *
 */

class Epico_Theme_Tour {

	private $pointer_close_id = 'epico_tour1320_020'; // altere para reiniciar

	/**
	 * Construtor da classe.
	 *
	 */
	function __construct() {
		global $wp_version;

		// Sem pointers antes do WP 3.3
		if ( version_compare( $wp_version, '3.4', '<' ) )
			return false;

		// Versao mais atual, proceder.
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue' ) );
	}

	/**
	 * Encadeia estilos e JS para os pointers.
	 */
	function enqueue() {
		if ( ! current_user_can('manage_options' ) )
			return;

		// Assume que o pointer nao deve ser apresentado
		$enqueue_pointer_script_style = false;

		// Obtem um lista de pointers que foram dispensados para o usuario atual e os converte em um array
		$dismissed_pointers = explode( ',', get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true ) );

		// Confere se o nosso pointer nao esta entre os dispensados
		if ( !in_array($this->pointer_close_id, $dismissed_pointers ) ) {
			$enqueue_pointer_script_style = true;

			// Adiciona scripts do rodape usando uma funcao de callback
			add_action( 'admin_print_footer_scripts', array($this, 'intro_tour' ) );
		}

		// Encadeia CSS e JS do pointer, se necessario
		if ( $enqueue_pointer_script_style ) {
			wp_enqueue_style( 'wp-pointer' );
			wp_enqueue_script( 'wp-pointer' );
		}

	}



	/**
	 * Carrega o tour de introducao
	 */
	function intro_tour() {

		$adminpages = array(

			// Nome do array = ID da tela @see: http://codex.wordpress.org/Function_Reference/get_current_screen
			'themes' => array(
				'content' => "<h3>" . __("Epico successfully activated!", 'epico') . "</h3>"
					. "<p>" . __( "Before customizing it, we recommend that you install the Epico plugin and configure at least one navigation menu.<br/><br/>. It's a simple process that will take just <strong>four steps</strong>.", 'epico' ) . "</p>", //Content for this pointer
				'id' => 'epico-name', //ID of element where the pointer will point
				'position' => array(
					'edge' => 'left', //Arrow position; change depending on where the element is located
					'align' => 'center' //Alignment of Pointer
				),
				'button2' => __('Start theme configuration', 'epico'), // Texto para o botao
				'function' => 'window.location="' . admin_url('plugin-install.php?tab=upload&welcome_tour=1') . '";' // Link para onde o botao apontara
			),
			'plugin-install' => array(
				'content' => '<h3>' . __("Plugin install (Step 1/4)", 'epico') . '</h3><p>' . __("To make the most of your theme, install the plugin that came with it. Click <strong>Choose file</strong> above and upload the plugin's zip file.<br/><br/>After the upload, click <strong>Install now</strong>. If the plugin is already installed, please click the button below to skip this step.", 'epico') . '</p>',
				'id' => 'install-plugin-submit',
				'position' => array(
					'edge' => 'top',
					'align' => 'center'
				),
				'button2' => __('Skip this step', 'epico'),
				'function' => 'window.location="' . admin_url('nav-menus.php?welcome_tour=2') . '";'
			),
			'update' => array(
				'content' => '<h3>' . __("Plugin activation (Step 1/4)", 'epico') . '</h3><p>' . __('Next, click the link <strong>Activate plugin</strong> to finish this step and to wait for the step 2.', 'epico') . '</p>',
				'id' => 'wpbody-content',
				'position' => array(
					'edge' => 'top',
					'align' => 'left'
				),
			),
			'plugins' => array(
				'content' => '<h3>' . __("Plugin activated! (Step 1/4)", 'epico') . '</h3><p>' . __("Great! The plugin is ready to rock! Now, we need to configure our menus. Click the button below to proceed to the step 2.", 'epico') . '</p>',
				'id' => 'menu-appearance',
				'position' => array(
					'edge' => 'left',
					'align' => 'center'
				),
				'button2' => __('Go to the menu settings', 'epico'),
				'function' => 'window.location="' . admin_url('nav-menus.php?welcome_tour=3') . '";'
			),
			'nav-menus' => array(
				'content' => "<h3>" . __("Menu creation (Step 2/4)", 'epico') . "</h3>"
					. "<p>" . __("Here you can add menus, assign them to the theme positions and optionally add icons to the menu items.<br/><br/>Try to keep a low number of menu items, this will garantee a nice presentation of you menu on the theme.<br/><br/>If you need assistance for this step, we have a good tutorial at the <a href='http://minha.uberfacil.com/epico/instalacao-do-tema-epico/#Configurando_menus' target='_blank'>documentation website</a>.", 'epico') . "</p>",
				'id' => 'nav-menu-header',
				'position' => array(
					'edge' => 'top',
					'align' => 'right'
				),
				'button2' => __('Activate your product', 'epico'),
				'function' => 'window.location="' . admin_url('index.php?welcome_tour=4') . '";'
			),
			'dashboard' => array(
				'content' => "<h3>" . __("Activate Epico updates (3/4)", 'epico') . "</h3>"
					. "<p>" . __("To receive automatic updates for your products, enter your Uberfacil's user and  registered email address in the Epico Theme and Plugin Updates dashboard widgets, below.<br><br>You can find your information in your dashboard at the My Uber section of the <a target='_blank' href='http://minha.uberfacil.com/epico/area-exclusiva/' >Uberfacil's website</a><br><br>Just click the Add key button below to reveal the input fields. Fill them and click submit.", 'epico') . "</p>",
				'id' => 'aht_epico_activation_key',
				'position' => array(
					'edge' => 'bottom',
					'align' => 'center'
				),
				'button2' => __('Done! Go to customization', 'epico'),
				'function' => 'window.location="' . admin_url('customize.php?welcome_tour=5') . '";'
			),
			'customize' => array(
				'content' => "<h3>" . __("Theme customization (Step 4/4)", 'epico') . "</h3>"
					. "<p>" . __("Now the last step: the customization happens in this area, where the changes can be visualized in real time.<br /><br/>Start by adding widgets to the widget areas and configuring them to your needs. Then, play with the remaining features to fine tune your theme. Don't forget to save your changes!<br /><br/>Well, that's it! If you need help, watch the video walkthrough on our <a href='http://minha.uberfacil.com/epico/personalize-seu-tema/' target='_blank'>documentation website</a> or get in touch with us <a href='mailto:contato@uberfacil.com?subject=Help with the customization of the Epico Premium WordPress theme&body=Sent from the WordPress Customizer' target='_blank'>by email</a>.<br><br>That's all! We hope you will enjoy your new theme.<br><br>Uberfacil Team", 'epico') . "</p>",
				'id' => 'customize-theme-controls',
				'position' => array(
					'edge' => 'left',
					'align' => 'center'
				)
			),
		);

		$page = '';
		$screen = get_current_screen();


		// Confere em que pagina o usuario esta
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		}
		if (empty($page)) {
			$page = $screen->id;
		}

		$function = '';
		$button2 = '';
		$opt_arr = array();

		if (!empty($adminpages[$page]['id'])) {
			$id = '#' . $adminpages[$page]['id'];
		} else {
			$id = '#' . $screen->id;
		}

		if ('' != $page && in_array($page, array_keys($adminpages))) {
			$align = (is_rtl()) ? 'right' : 'left';
			$opt_arr = array(
				'content' => $adminpages[$page]['content'],
				'position' => array(
					'edge' => (!empty($adminpages[$page]['position']['edge'])) ? $adminpages[$page]['position']['edge'] : 'left',
					'align' => (!empty($adminpages[$page]['position']['align'])) ? $adminpages[$page]['position']['align'] : $align
				),
				'pointerWidth' => 300
			);
			if (isset($adminpages[$page]['button2'])) {
				$button2 = (!empty($adminpages[$page]['button2'])) ? $adminpages[$page]['button2'] : __('Next', 'epico');
			}
			if (isset($adminpages[$page]['function'])) {
				$function = $adminpages[$page]['function'];
			}
		}

		$this->print_scripts($id, $opt_arr, __("Close", 'epico'), $button2, $function);
	}


	/**
	 * Encadeia o script
	 *
	 * @param string $selector         O seletor CSS selector em que o pointer esta atrelado.
	 * @param array $options           Opcoes para o pointer.
	 * @param string $button1          Texto para o botao 1
	 * @param string|bool $button2     Texto para o botao 2 (ou FALSE para nao mostra-lo, padrao e FALSE)
	 * @param string $button2_function A funcao JavaScript para atrelar ao botao 2
	 * @param string $button1_function A funcao JavaScript para atrelar ao botao 1
	 */
	function print_scripts($selector, $options, $button1, $button2 = false, $button2_function = '', $button1_function = '') {
		?>
		<script type="text/javascript">
			//<![CDATA[
			(function ($) {

				var epico_pointer_options = <?php echo json_encode( $options ); ?>, setup;

				epico_pointer_options = $.extend(epico_pointer_options, {
					buttons: function (event, t) {
						button = jQuery('<a id="pointer-close" style="margin-left:5px" class="button-secondary">' + '<?php echo $button1; ?>' + '</a>');
						button.bind('click.pointer', function () {
							t.element.pointer('close');
						});
						return button;
					}
				});

				setup = function () {
					$('<?php echo $selector; ?>').pointer(epico_pointer_options).pointer('open');
					<?php
					if ( $button2 ) { ?>
					jQuery('#pointer-close').after('<a id="pointer-primary" class="button-primary">' + '<?php echo $button2; ?>' + '</a>');
					<?php } ?>
					jQuery('#pointer-primary').click(function () {
						<?php echo $button2_function; ?>
					});
					jQuery('#pointer-close').click(function () {
						<?php if ( $button1_function == '' ) { ?>
						$.post(ajaxurl, {
							pointer: '<?php echo $this->pointer_close_id; ?>', // pointer ID
							action: 'dismiss-wp-pointer'
						});

						<?php } else { ?>
						<?php echo $button1_function; ?>
						<?php } ?>
					});

				};

				if (epico_pointer_options.position && epico_pointer_options.position.defer_loading) {
					$(window).bind('load.wp-pointers', setup);
				} else {

					$(document).ready(setup);
				}

			})(jQuery);
			//]]>
		</script>
	<?php
	}
}

$epico_theme_tour = new Epico_Theme_Tour();