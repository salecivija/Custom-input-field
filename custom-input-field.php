<?php
/**
 * Plugin Name: Custom Input Field
 * Description: Custom Input Field for WooCommerce orders.
 * Version: 1.0
 * Author: Your Name
 * Text Domain: custom-input-field
 */

add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_input_field' );
function my_custom_input_field( $order ) {
    echo '<div class="form-field form-field-wide">
        <label for="custom_input_field">Custom Input Field:</label>
        <input type="text" id="custom_input_field" name="custom_input_field" value="' . get_post_meta( $order->get_id(), 'custom_input_field', true ) . '" />
    </div>';
}

add_action( 'woocommerce_process_shop_order_meta', 'my_save_custom_input_field', 10, 2 );
function my_save_custom_input_field( $post_id, $post ) {
    update_post_meta( $post_id, 'custom_input_field', $_POST['custom_input_field'] );
}

add_action( 'woocommerce_email_order_meta', 'my_email_order_meta', 10, 4 );
function my_email_order_meta( $order, $sent_to_admin, $plain_text, $email ) {
    echo '<p><strong>Custom Input Field:</strong> ' . get_post_meta( $order->get_id(), 'custom_input_field', true ) . '</p>';
}
