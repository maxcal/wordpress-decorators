<?php
/**
 * This file is loaded before any tests are run.
 * It should be used to set up the test suite.
 */

// Use Composer to autoload PSR-01 Classes
require_once dirname(__DIR__) . '/vendor/autoload.php';

try {
    Dotenv::load(dirname(__DIR__));
} catch(InvalidArgumentException $e) {
    die($e->getMessage() . ' See .env.example for an example.');
}

if ( ! $wp_test_dir = getenv('WP_TESTS_DIR') ) {
    $wp_test_dir = '/tmp/wordpress-tests';
    if ( ! file_exists($wp_test_dir) || ! file_exists($wp_test_dir . '/tests') ) {
        die("Fatal Error: Could not find the WordPress tests directory.\n");
    }
}
/** Bootstraps the WordPress stack. */
require_once $wp_test_dir . '/tests/phpunit/includes/bootstrap.php';

/** require the WordPress testcase */
require_once $wp_test_dir . '/tests/phpunit/includes/testcase.php';