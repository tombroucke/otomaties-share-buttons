<?php

namespace Otomaties\ShareButtons;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @subpackage ShareButtons/public
 */

class Frontend
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
     * @param      string    $pluginName       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($pluginName, $version)
    {

        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script($this->pluginName, Assets::find('js/main.js'), [], null, true);
        wp_localize_script($this->pluginName, 'otomaties_share_buttons_vars', [
            'popup_width' => get_option('otomaties_share_buttons_popup_width') ?: 600,
            'popup_height' => get_option('otomaties_share_buttons_popup_height') ?: 400,
            'display_copy_alert' => get_option('otomaties_share_buttons_copy_alert'),
            'strings' => [
                'copied_link' => apply_filters('otomaties_share_buttons_string_copied_link', __('Copied link to clipboard', 'otomaties-share-buttons')),
                'copy_link_error' => apply_filters('otomaties_share_buttons_string_copy_link_error', __('An error occured while copying the link to your clipboard', 'otomaties-share-buttons')),
            ]
        ]);
    }

    public function renderButtons(string $content = '', bool $echo = false)
    {
        $supportedPostTypes =  array_filter((array)get_option('otomaties_share_buttons_post_type'));
        $postType = get_post_type();

        if (!array_key_exists($postType, $supportedPostTypes)) {
            return $content;
        }

        if (!is_singular($postType) && !get_option('otomaties_share_buttons_show_in_overview')) {
            return $content;
        }

        if (!empty(get_option('otomaties_share_buttons'))) {
            $content .= sprintf('<div class="%s">', apply_filters('otomaties_share_buttons_container_class', 'share-buttons'));
            foreach (get_option('otomaties_share_buttons') as $socialMediaName => $value) {
                $content .= $this->button($socialMediaName);
            }
            $content .= '</div>';
            $content = apply_filters('otomaties_share_buttons_output', $content);

            if ($echo) {
                echo $content;
            } else {
                return $content;
            }
        }
    }

    private function button($type)
    {
        $mapping = [
            'facebook'  => [
                'icon' => '<i class="fab fa-facebook"></i>',
                'link' => 'http://www.facebook.com/sharer/sharer.php?u=%s',
                'title' => __('Share on facebook', 'otomaties-share-buttons'),
                'popup' => true,
            ],
            'linkedin'  => [
                'icon' => '<i class="fab fa-linkedin"></i>',
                'link' => 'https://www.linkedin.com/cws/share?url=%s',
                'title' => __('Share on linkedin', 'otomaties-share-buttons'),
                'popup' => true,
            ],
            'x'   => [
                'icon' => '<i class="fab fa-x"></i>',
                'link' => 'https://x.com/intent/post?text=%25s',
                'title' => __('Share on x', 'otomaties-share-buttons'),
                'popup' => true,
            ],
            'pinterest' => [
                'icon' => '<i class="fab fa-pinterest"></i>',
                'link' => 'http://pinterest.com/pin/create/button/?url=%s',
                'title' => __('Share on pinterest', 'otomaties-share-buttons'),
                'popup' => true,
            ],
            'email'     => [
                'icon' => '<i class="fa fa-envelope"></i>',
                'link' => 'mailto:?body=%s"',
                'title' => __('Share on email', 'otomaties-share-buttons'),
                'popup' => false,
            ],
            'whatsapp'     => [
                'icon' => '<i class="fa fa-whastapp"></i>',
                'link' => 'whatsapp://send?text=%s',
                'title' => __('Share over WhatsApp', 'otomaties-share-buttons'),
                'popup' => false,
            ],
            'copy_link'     => [
                'icon' => '<i class="fa fa-link"></i>',
                'link' => '%s',
                'title' => __('Copy link', 'otomaties-share-buttons'),
                'popup' => false,
            ],
        ];

        if (!array_key_exists($type, $mapping)) {
            return false;
        }
        
        $class = apply_filters('otomaties_share_buttons_button_class', sprintf('share-buttons__button share-buttons__button-%1$s', $type), $type);
        $button = sprintf('<div class="%s"><a href="%s" class="%s">%s</a></div>', $class, sprintf($mapping[$type]['link'], get_permalink()), $mapping[$type]['popup'] ? 'js-share-buttons__popup' : '', apply_filters('otomaties_share_buttons_button_icon', $mapping[$type]['icon'], $type));
        return apply_filters('otomaties_share_buttons_button', $button);
    }
}
