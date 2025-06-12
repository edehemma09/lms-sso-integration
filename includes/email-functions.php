<?php
// Send email with SSO link after purchase
add_action('woocommerce_order_status_completed', 'send_lms_sso_email');

function send_lms_sso_email($order_id) {
    $order = wc_get_order($order_id);
    $user_email = $order->get_billing_email();
    $items = $order->get_items();

    foreach ($items as $item) {
        $product_id = $item->get_product_id();
        $course_id = get_post_meta($product_id, '_course_id', true);

        if ($course_id) {
            $sso_link = generate_sso_link($user_email, $course_id);
            send_email($user_email, $sso_link);
        }
    }
}

function generate_sso_link($email, $course_id) {
    $base_url = 'https://learn.aicerts.io/enrol/instances.php';
    $sso_link = add_query_arg(array('id' => $course_id), $base_url);

    // Implement your SSO logic here (e.g., JWT, OAuth)
    // For simplicity, we'll just append email and a hashed password
    $password = wp_generate_password(); // Generate a random password
    $hashed_password = wp_hash_password($password);

    $sso_link = add_query_arg(array('email' => $email, 'password' => $hashed_password), $sso_link);

    return $sso_link;
}

function send_email($email, $sso_link) {
    $subject = 'Your LMS Access Details';
    $message = "Here is your LMS access link: $sso_link";
    $headers = array('Content-Type: text/plain; charset=UTF-8');

    wp_mail($email, $subject, $message, $headers);
}