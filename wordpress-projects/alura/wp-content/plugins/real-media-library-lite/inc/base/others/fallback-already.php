<?php
defined('ABSPATH') or die('No script kiddies please!'); // Avoid direct file request

if (!function_exists('rml_skip_already_admin_notice')) {
    /**
     * Show an admin notice to administrators when the plugin is already active.
     */
    function rml_skip_already_admin_notice() {
        if (current_user_can('install_plugins')) {
            $data = get_plugin_data(RML_FILE, true, false);
            echo '<div class=\'notice notice-error\'>
				<p>Currently multiple versions of the plugin <strong>Real Media Library</strong> are active. Please deactivate all versions except the one you want to use.</p>' .
                '</div>';
        }
    }
}
add_action('admin_notices', 'rml_skip_already_admin_notice');
