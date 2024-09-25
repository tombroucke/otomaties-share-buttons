<?php

namespace Otomaties\ShareButtons;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @subpackage ShareButtons/admin
 */

class Admin
{

    /**
     * The ID of this plugin.
     *
     * @var      string    $pluginName    The ID of this plugin.
     */
    private $pluginName;

    /**
     * The version of this plugin.
     *
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param      string    $pluginName       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($pluginName, $version)
    {

        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     */
    public function enqueueStyles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        // wp_enqueue_style($this->pluginName, Assets::find('css/admin.css'), array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     */
    public function enqueueScripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        // wp_enqueue_script($this->pluginName, Assets::find('js/admin.js'), [], $this->version, false);
    }
    
    public function addSettingsPage()
    {
        add_options_page(
            __('Share Buttons', 'otomaties-share-buttons'),
            __('Share Buttons', 'otomaties-share-buttons'),
            'manage_options',
            'otomaties-share-buttons',
            array(
                $this,
                'settings'
            )
        );
    }

    public function registerSettings()
    {
        //register our settings
        register_setting('otomaties_share_buttons_settings', 'otomaties_share_buttons');
        register_setting('otomaties_share_buttons_settings', 'otomaties_share_buttons_show_in_overview');
        register_setting('otomaties_share_buttons_settings', 'otomaties_share_buttons_post_type');
        register_setting('otomaties_share_buttons_settings', 'otomaties_share_buttons_hook');
        register_setting('otomaties_share_buttons_settings', 'otomaties_share_buttons_popup_width');
        register_setting('otomaties_share_buttons_settings', 'otomaties_share_buttons_popup_height');
        register_setting('otomaties_share_buttons_settings', 'otomaties_share_buttons_copy_alert');
    }

    public function settings()
    {
        ?>
            <div class="wrap">
                <h1><?php _e('Share Buttons', 'otomaties-share-buttons'); ?></h1>
                <form method="post" action="options.php">
                    <?php settings_fields('otomaties_share_buttons_settings'); ?>
                    <?php do_settings_sections('otomaties_share_buttons_settings'); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e('Social Media Buttons', 'otomaties-share-buttons'); ?></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="otomaties_share_buttons[facebook]" value="1" <?php checked(isset(get_option('otomaties_share_buttons')['facebook'])); ?> /> <?php _e('Facebook', 'otomaties-share-buttons'); ?>
                                </label><br />
                                <label>
                                    <input type="checkbox" name="otomaties_share_buttons[linkedin]" value="1" <?php checked(isset(get_option('otomaties_share_buttons')['linkedin'])); ?> /> <?php _e('Linkedin', 'otomaties-share-buttons'); ?>
                                </label><br />
                                <label>
                                    <input type="checkbox" name="otomaties_share_buttons[x]" value="1" <?php checked(isset(get_option('otomaties_share_buttons')['x'])); ?> /> <?php _e('x', 'otomaties-share-buttons'); ?>
                                </label><br />
                                <label>
                                    <input type="checkbox" name="otomaties_share_buttons[pinterest]" value="1" <?php checked(isset(get_option('otomaties_share_buttons')['pinterest'])); ?> /> <?php _e('Pinterest', 'otomaties-share-buttons'); ?>
                                </label><br />
                                <label>
                                    <input type="checkbox" name="otomaties_share_buttons[email]" value="1" <?php checked(isset(get_option('otomaties_share_buttons')['email'])); ?> /> <?php _e('E-mail', 'otomaties-share-buttons'); ?>
                                </label><br />
                                <label>
                                    <input type="checkbox" name="otomaties_share_buttons[whatsapp]" value="1" <?php checked(isset(get_option('otomaties_share_buttons')['whatsapp'])); ?> /> <?php _e('WhatsApp', 'otomaties-share-buttons'); ?>
                                </label><br />
                                <label>
                                    <input type="checkbox" name="otomaties_share_buttons[copy_link]" value="1" <?php checked(isset(get_option('otomaties_share_buttons')['copy_link'])); ?> /> <?php _e('Copy link', 'otomaties-share-buttons'); ?>
                                </label>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Show buttons in overview', 'otomaties-share-buttons'); ?></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="otomaties_share_buttons_show_in_overview" value="1" <?php checked(get_option('otomaties_share_buttons_show_in_overview')); ?> /> <?php _e('Show in overview', 'otomaties-share-buttons'); ?>
                                </label>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Post Types', 'otomaties-share-buttons'); ?></th>
                            <td>
                            <?php
                            $args = array(
                                'public' => true
                            );
                            $post_types = get_post_types($args);
                            foreach ($post_types as $id => $type) : ?>
                                <label>
                                    <input type="checkbox" name="otomaties_share_buttons_post_type[<?php echo $id; ?>]" value="1" <?php checked(isset(get_option('otomaties_share_buttons_post_type')[$id])); ?> /> <?php echo $type; ?>
                                </label><br />
                            <?php endforeach; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Hook', 'otomaties-share-buttons'); ?></th>
                            <td>
                                <input type="text" name="otomaties_share_buttons_hook" value="<?php echo get_option('otomaties_share_buttons_hook') ?>">
                                <p class="description" id="otomaties_share_buttons_hook-description"><?php _e('Leave empty for default hooks (the_content & the_excerpt)', 'otomaties-share-buttons'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Popup width', 'otomaties-share-buttons'); ?></th>
                            <td>
                                <input type="number" name="otomaties_share_buttons_popup_width" value="<?php echo get_option('otomaties_share_buttons_popup_width'); ?>">
                                <p class="description" id="otomaties_share_buttons_popup_width-description"><?php _e('In px. Defaults to 600', 'otomaties-share-buttons'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Popup height', 'otomaties-share-buttons'); ?></th>
                            <td>
                                <input type="number" name="otomaties_share_buttons_popup_height" value="<?php echo get_option('otomaties_share_buttons_popup_height'); ?>">
                                <p class="description" id="otomaties_share_buttons_popup_height-description"><?php _e('In px. Defaults to 400', 'otomaties-share-buttons'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Display alert after copying link', 'otomaties-share-buttons'); ?></th>
                            <td>
                                <input type="checkbox" name="otomaties_share_buttons_copy_alert" value="1" <?php checked(get_option('otomaties_share_buttons_copy_alert')); ?>>
                            </td>
                        </tr>
                    </table>
                    <?php submit_button(); ?>
                </form>
            </div>
            <?php
    }

    public function addSettingsLink($links)
    {
        $settings_link = '<a href="options-general.php?page=otomaties-share-buttons">' . __('Settings', 'otomaties-share-buttons') . '</a>';
        array_push($links, $settings_link);
        return $links;
    }
}
