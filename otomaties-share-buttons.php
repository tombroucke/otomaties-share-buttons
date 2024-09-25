<?php

namespace Otomaties\ShareButtons;

/**
 * Plugin Name:       Otomaties Share Buttons
 * Description:       Display sharing buttons on posts, pages and custom post types
 * Version:           1.2.0
 * Author:            Tom Broucke
 * Author URI:        https://tombroucke.be/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       otomaties-share-buttons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

// Autoload files
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once realpath(__DIR__ . '/vendor/autoload.php');
}

// Setup / teardown
register_activation_hook(__FILE__, '\\Otomaties\\ShareButtons\\Activator::activate');
register_deactivation_hook(__FILE__, '\\Otomaties\\ShareButtons\\Deactivator::deactivate');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
function init()
{
    if (! function_exists('get_plugin_data')) {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }
    $pluginData = \get_plugin_data(__FILE__);
    $pluginData['pluginName'] = basename(__FILE__, '.php');

    $plugin = new Plugin($pluginData);
    $plugin->run();
}
init();
