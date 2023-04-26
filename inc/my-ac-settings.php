<?php
/*
Plugin Name: My ActiveCampaign Plugin
*/

// Register settings
add_action('admin_init', 'my_ac_register_settings');

function my_ac_register_settings() {
    register_setting('my_ac_settings_group', 'my_ac_api_url');
    register_setting('my_ac_settings_group', 'my_ac_api_key');
}

// Add menu item to settings menu
add_action('admin_menu', 'my_ac_settings_page');

function my_ac_settings_page() {
    add_options_page('My ActiveCampaign Settings', 'ActiveCampaign Integration', 'manage_options', 'my-ac-settings', 'my_ac_settings_page_callback');
}

// Settings page callback function
function my_ac_settings_page_callback() {
    ?>
    <div class="wrap">
        <h2>My ActiveCampaign Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('my_ac_settings_group'); ?>
            <?php do_settings_sections('my_ac_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">API URL</th>
                    <td><input type="text" name="my_ac_api_url" value="<?php echo esc_attr(get_option('my_ac_api_url')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">API Key</th>
                    <td><input type="text" name="my_ac_api_key" value="<?php echo esc_attr(get_option('my_ac_api_key')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
