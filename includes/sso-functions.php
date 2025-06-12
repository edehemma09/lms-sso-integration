<?php
// Add custom field to WooCommerce product edit page
add_action('woocommerce_product_options_general_product_data', 'add_course_id_field');

function add_course_id_field() {
    woocommerce_wp_text_input(
        array(
            'id' => '_course_id',
            'label' => __('Course ID', 'woocommerce'),
            'placeholder' => 'Enter Course ID',
            'desc_tip' => 'true',
            'description' => __('Enter the Course ID from the LMS.', 'woocommerce')
        )
    );
}

// Save custom field value
add_action('woocommerce_process_product_meta', 'save_course_id_field');

function save_course_id_field($post_id) {
    $course_id = isset($_POST['_course_id']) ? sanitize_text_field($_POST['_course_id']) : '';
    update_post_meta($post_id, '_course_id', $course_id);
}