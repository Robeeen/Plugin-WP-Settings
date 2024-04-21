<?php
/*
Plugin Name: WP Settings
Plugin URI: https://shamskhan.xyz
Description: Add new settings fields to WP Settings.
Author: Shams Khan
Version: 1.0.0
Author URI: https://shamskhan.xyz
*/

if( !defined('ABSPATH'))
{
    exit; // Exit if accessed directly.
}

//add sections, fields and settings - 

add_action('admin_init', 'wp_settings_plugin_init');
function wp_settings_plugin_init(){
    //add section to General Settings of default WP admin
    add_settings_section(
        'wp_setting_plugin_section',
        __('Additional Settings - By Plugins', 'wordpress'),
        'wp_settings_section_callback',
        'general' 
    );
    //add a text field
    add_settings_field(
        'wp_setting_field_0',
        __('Company Name', 'wordpress'),
        'wp_settings_field_0_callback',
        'general',
        'wp_setting_plugin_section'
    );
    //add a text field
    add_settings_field(
        'wp_setting_field_1',
        __('Company Address', 'wordpress'),
        'wp_settings_field_1_callback',
        'general',
        'wp_setting_plugin_section'
    );
	//add a checkbox
	add_settings_field( 
		'wp_settings_checkbox_field', 
		__( 'Enable Send Mail', 'wordpress' ), 
		'wp_settings_checkbox_field_render', 
		'general', 
		'wp_setting_plugin_section' 
	);
	//add select field
	add_settings_field( 
		'wp_settings_select_field', 
		__( 'Select Primary Phone', 'wordpress' ), 
		'wp_settings_select_field_callback', 
		'general', 
		'wp_setting_plugin_section' 
	);
    //register the settings
    register_setting('general', 'settings_my_plugin' );

}
//function for first text field
function wp_settings_field_0_callback(){
    $options = get_option('settings_my_plugin');    
    echo "<input id='wp_setting_field_0'
     name='settings_my_plugin[wp_setting_field_0]'
     size='40' type='text' 
     value='{$options['wp_setting_field_0']}' />";
}
//function for second text field
function wp_settings_field_1_callback(){
    $options = get_option('settings_my_plugin');    
    echo "<input id='wp_setting_field_1'
     name='settings_my_plugin[wp_setting_field_1]'
     size='40' type='text' 
     value='{$options['wp_setting_field_1']}' />";
}
//function for checkbox
function wp_settings_checkbox_field_render(){ 
	$options = get_option('settings_my_plugin');
	echo "<input type='checkbox'
    name='settings_my_plugin[wp_settings_checkbox_field]' . checked($options[wp_settings_checkbox_field], 1) .  value='1' />";

}
//function for dropdown menu
function wp_settings_select_field_callback(){
	$options = get_option( 'settings_my_plugin' );
	?>
	<select name='settings_my_plugin[wp_settings_select_field]'>
		<option value='1' <?php selected( $options['wp_settings_select_field'], 1 ); ?>>Primay - 099900222</option>
		<option value='2' <?php selected( $options['wp_settings_select_field'], 2 ); ?>>Secondary - 11110101011</option>
	</select>
<?php
}