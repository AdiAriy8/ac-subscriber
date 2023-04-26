<?php
// Create Form Shortcode
function my_ac_form_shortcode($atts) {
    ob_start();

    // Get List ID
    $list_id = isset($atts['list']) ? intval($atts['list']) : '';

    // Check if List ID is not empty
    if (!empty($list_id)) {
        $api_key = get_option('my_ac_api_key');
        $api_url = get_option('my_ac_api_url');

        // Get ActiveCampaign List Fields
        $fields = get_activecampaign_list_fields($api_key, $api_url, $list_id);

        // Get Form Data
        if (isset($_POST['my_ac_form_submit'])) {
            $full_name = sanitize_text_field($_POST['my_ac_form_full_name']);
            $email = sanitize_email($_POST['my_ac_form_email']);

            // Create Subscriber in ActiveCampaign
            $subscriber = create_activecampaign_subscriber($api_key, $api_url, $list_id, $full_name, $email);

            // Insert Subscriber to Custom Post Type
            $post_args = array(
                'post_type' => 'my_ac_subscriber',
                'post_title' => $full_name,
                'post_status' => 'publish',
                'meta_input' => array(
                    'my_ac_subscriber_email' => $email,
                    'my_ac_subscriber_list_id' => $list_id,
                    'my_ac_subscriber_id' => $subscriber['subscriber_id']
                )
            );

            $post_id = wp_insert_post($post_args);

            // Display Success Message
            if ($post_id) {
                echo '<div class="my-ac-form-success">Thank you for subscribing!</div>';
            }
        }

        // Display Form
        ?>
        <form method="post" class="my-ac-form">
            <div class="my-ac-form-group">
                <label for="my_ac_form_full_name">Full Name:</label>
                <input type="text" name="my_ac_form_full_name" id="my_ac_form_full_name" required>
            </div>
            <div class="my-ac-form-group">
                <label for="my_ac_form_email">Email:</label>
                <input type="email" name="my_ac_form_email" id="my_ac_form_email" required>
            </div>
            <input type="hidden" name="my_ac_form_submit" value="1">
            <button type="submit" class="my-ac-form-submit">Subscribe</button>
        </form>
        <?php
    } else {
        // Display Error Message
        echo '<div class="my-ac-form-error">Please specify the list ID.</div>';
    }

    return ob_get_clean();
}

// Register Form Shortcode
add_shortcode('my_ac', 'my_ac_form_shortcode');
