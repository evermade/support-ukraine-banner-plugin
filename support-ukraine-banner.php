<?php
namespace SupportUkraineBanner;
/*
Plugin Name: Support Ukraine Banner
Plugin URI: https://evermade.fi/
Description: Display a small banner on your website to support Ukraine.
Author: Evermade
Version: 1.0.2
Author URI: https://evermade.fi/
*/


/**
 * Render banner after opening body tag.
 */
add_action('wp_footer', function() {
	$label = get_option_value('label');
	$url = get_option_value('url');
	$placement = get_option_value('placement');
	include(__DIR__ . '/banner.php');
});


/**
 * Add options page.
 */
add_action('admin_menu', 'SupportUkraineBanner\add_menu_item');
function add_menu_item() {
    add_options_page('Support Ukraine', 'Support Ukraine', 'manage_options', 'support-ukraine-banner', 'SupportUkraineBanner\render_settings_page');
}


/**
 * Render settings page.
 */
function render_settings_page() {
    ?>
    <form action="options.php" method="post">
        <?php 
        settings_fields( 'support_ukraine_plugin_options' );
        do_settings_sections( 'support_ukraine_plugin' ); ?>
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
    </form>
    <?php
}


/**
 * Register settings.
 */
add_action( 'admin_init', 'SupportUkraineBanner\register_settings' );
function register_settings() {
    register_setting( 'support_ukraine_plugin_options', 'support_ukraine_plugin_options', 'SupportUkraineBanner\options_validate' );
    add_settings_section( 'api_settings', 'Support Ukraine Banner settings', 'SupportUkraineBanner\section_text', 'support_ukraine_plugin' );
    add_settings_field( 'support_ukraine_setting_label', 'Banner text', 'SupportUkraineBanner\support_ukraine_setting_label', 'support_ukraine_plugin', 'api_settings' );
    add_settings_field( 'support_ukraine_setting_url', 'Url', 'SupportUkraineBanner\support_ukraine_setting_url', 'support_ukraine_plugin', 'api_settings' );
    add_settings_field( 'support_ukraine_setting_placement', 'Banner placement', 'SupportUkraineBanner\support_ukraine_setting_placement', 'support_ukraine_plugin', 'api_settings' );
}

function options_validate( $input ) {
    return $input;
}


/**
 * Render section title. 
 */
function section_text() {
    echo '<p>The plugin displays support banner on your website. You can customize texts and location.</p>';
}


/**
 * Render input for label.
 */
function support_ukraine_setting_label() {
    echo "<input id='support_ukraine_setting_label' name='support_ukraine_plugin_options[label]' type='text' value='" . esc_attr( get_option_value('label') ) . "' />";
}


/**
 * Render input for url.
 */
function support_ukraine_setting_url() {
    echo "<input id='support_ukraine_setting_url' name='support_ukraine_plugin_options[url]' type='text' value='" . esc_attr( get_option_value('url') ) . "' />";
}


/**
 * Render input for placement.
 */
function support_ukraine_setting_placement() {
	$value = get_option_value('placement');
    echo '<select name="support_ukraine_plugin_options[placement]">
		<option ' . ($value == 'left' ? 'selected' : '') . ' value="left">Left</option>
		<option ' . ($value == 'center' ? 'selected' : '') . ' value="center">Center</option>
		<option ' . ($value == 'right' ? 'selected' : '') . ' value="right">Right</option>
	</select>';
}


function get_option_value($key) {

    $options = get_option( 'support_ukraine_plugin_options' );

	$defaults = [
		'label' => 'Support Ukraine!',
		'url' => 'https://www.evermade.fi/support-ukraine/',
		'placement' => 'left',
	];

	// Prefer saved value.
	if (isset($options[$key])) {
		return $options[$key];
	}
	// Fall back to default.
	else if (isset($defaults[$key])) {
		return $defaults[$key];
	} 
	// No default found, return empty string.
	else {
		return '';
	}

}
