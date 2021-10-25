<?php

/**
 * Plugin Name:       Vue Wordpress test
 * Description:       Vue Wordpress plugin starter template by Laravel Mix.
 * Version:           1.0.0
 * Author:            Naeem Haque
 * License:           GPL v2 or later
 * Text Domain:       plugin-template
 */



final class VueWordpressTest
{

    /**
     * Define Plugin Version
     */
    const VERSION = '1.0.0';

    /**
     * Construct Function
     */
    public function __construct()
    {
        register_activation_hook(__FILE__, [$this, 'activate']);
        register_deactivation_hook(__FILE__, [$this, 'deactivate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);
        define('PLUGIN_TEST_URL', trailingslashit(plugins_url('', __FILE__)));
        define('PLUGIN_TEST_ASSETS', PLUGIN_TEST_URL . 'assets/');

        add_action('admin_enqueue_scripts', [$this, 'register_assets']);
        add_action('admin_menu', [$this, 'admin_menu']);

    }

    public function register_assets()
    {

            wp_enqueue_script('main-script-test', PLUGIN_TEST_ASSETS . 'js/index.js', '', 1.0, true);

    }

    public function admin_menu()
    {
        $parent_slug = 'plugin-menu-test';
        $capability = 'manage_options';
        add_menu_page(
            __('Vue Test', ' plugin-template'),
            __('Vue Test', ' plugin-template'),
            $capability,
            $parent_slug,
            [$this, 'plugin_page'],
            'dashicons-menu',
            115
        );


    }

    public function plugin_page()
    {
        echo '<div id="app"></div>';
    }


    /**
     * Singletone Instance
     * @since 1.0.0
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * On Plugin Activation
     * @since 1.0.0
     */
    public function activate()
    {
        $is_installed = get_option('plugin_is_installed');

        if (!$is_installed) {
            update_option('plugin_is_installed', time());
        }


        //instance of create table class
        $installer = new Includes\Installer();
        $installer->run();
    }

    /**
     * On Plugin De-actiavtion
     * @since 1.0.0
     */
    public function deactivate()
    {

    }

    /**
     * Init Plugin
     * @since 1.0.0
     */
    public function init_plugin()
    {


    }

}

function vue_wordpress_test()
{
    return new VueWordpressTest();
}

vue_wordpress_test();