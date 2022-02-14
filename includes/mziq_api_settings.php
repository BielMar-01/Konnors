<?php 
/* Integração de APIs Settings Page */
class api_integration_Settings_Page {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
	}
	public function wph_create_settings() {
		$page_title = 'Integração de APIs';
		$menu_title = 'Integração de APIs';
		$capability = 'manage_options';
		$slug = 'api_integration';
		$callback = array($this, 'wph_settings_content');
		add_options_page($page_title, $menu_title, $capability, $slug, $callback);
	}
	public function wph_settings_content() { ?>
		<div class="wrap">
			<h1>Integração de APIs</h1>
			<?php settings_errors(); ?>
			<form method="POST" action="options.php">
				<?php
					settings_fields( 'api_integration' );
					do_settings_sections( 'api_integration' );
					submit_button();
				?>
			</form>
		</div> <?php
	}
	public function wph_setup_sections() {
		add_settings_section( 'api_integration_section', 'Área destinada ao preenchimento de chaves e IDs de conexão', array(), 'api_integration' );
	}
	public function wph_setup_fields() {
		$fields = array(
			array(
				'label' => 'Nome da empresa',
				'id' => 'company_name',
				'type' => 'text',
				'section' => 'api_integration_section',
				'desc' => 'Escreva o nome da empresa',
                'placeholder' => 'Ex: MZ Group'
			),
			array(
				'label' => 'File Manager - Base URI',
				'id' => 'mziq_fm_base_uri',
				'type' => 'text',
				'section' => 'api_integration_section',
				'desc' => 'Preencha com o link de base da API',
			),
			array(
				'label' => 'File Manager - Company ID',
				'id' => 'mziq_fm_company_id',
				'type' => 'text',
				'section' => 'api_integration_section',
				'desc' => 'Preencha com o Company ID da empresa',
			),
			array(
				'label' => 'File Manager - Stockinfo ID',
				'id' => 'prices_key',
				'type' => 'text',
				'section' => 'api_integration_section',
				'desc' => 'Preencha com o ID do Stockinfo para as cotações',
			),
		);
		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'api_integration', $field['section'], $field );
			register_setting( 'api_integration', $field['id'] );
		}
	}
	public function wph_field_callback( $field ) {
		$value = get_option( $field['id'] );
		switch ( $field['type'] ) {
			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$field['placeholder'],
					$value
				);
		}
		if( $desc = $field['desc'] ) {
			printf( '<p class="description">%s </p>', $desc );
		}
	}
}
new api_integration_Settings_Page();