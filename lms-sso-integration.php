<?php
/*
Plugin Name: LMS SSO Integration
Description: Integrates WooCommerce with LMS via SSO.
Version: 1.0
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/sso-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/email-functions.php';