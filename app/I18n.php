<?php

namespace Otomaties\ShareButtons;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 */

class I18n
{


    /**
     * Load the plugin text domain for translation.
     *
     */
    public function loadTextdomain()
    {
        load_plugin_textdomain('otomaties-share-buttons', false, dirname(plugin_basename(__FILE__), 2) . '/languages/');
    }
}
