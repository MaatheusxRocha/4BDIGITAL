        <div class="wrap">
            <h2><?php echo __( 'Epico plugin – Global assets ', 'uf-epico'); ?></h2>
            <?php
            	if( !empty( $_GET['settings-updated'] ) && $screen->parent_base != 'options-general' ){
					echo '<div class="updated settings-error" id="setting-error-settings_updated">';
					echo '<p><strong>' . __('Settings saved.', 'uf-epico') . '</strong></p></div>';
				}
            ?>            
            <p><?php echo __("Global plugin asset management","uf-epico"); ?></p>
            <form method="post" action="options.php" class="uf-epico-options-form">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'epico_global_assets' );
                do_settings_sections( 'epico_global_assets' );
