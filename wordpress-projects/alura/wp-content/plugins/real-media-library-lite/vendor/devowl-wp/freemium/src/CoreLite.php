<?php

namespace MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\Freemium;

use MatthiasWeb\RealMediaLibrary\Vendor\MatthiasWeb\Utils\Base;
// @codeCoverageIgnoreStart
\defined('ABSPATH') or die('No script kiddies please!');
// Avoid direct file request
// @codeCoverageIgnoreEnd
trait CoreLite
{
    // Documented in ICore
    public function overrideConstructFreemium()
    {
        /**
         * This trait always needs to be used along with base trait.
         *
         * @var Base
         */
        $base = $this;
        add_filter('plugin_action_links_' . plugin_basename($base->getPluginConstant('FILE')), [$this, 'plugin_action_links'], 10, 2);
    }
    /**
     * Show a "Get PRO!" link.
     *
     * @param string[] $actions
     * @return string[]
     */
    public function plugin_action_links($actions)
    {
        /**
         * This trait always needs to be used along with base trait.
         *
         * @var Base
         */
        $base = $this;
        $link = add_query_arg('feature', 'all-installed-plugins-table', $base->getPluginConstant(\MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\Freemium\FreemiumProvider::$PLUGIN_CONST_PRO_VERSION));
        $actions[] = '<a style="border: 1px solid #0073aa;border-radius: 5px;padding: 0px 7px 2px 7px;" href="' . $link . '" target="_blank">Get PRO!</a>';
        return $actions;
    }
    // Documented in ICore
    public function isLiteNoticeDismissed($set = null)
    {
        /**
         * This trait always needs to be used along with base trait.
         *
         * @var Base
         */
        $base = $this;
        $transient = $base->getPluginConstant('OPT_PREFIX') . '_liteDismissed';
        $value = '1';
        if ($set !== null) {
            if ($set) {
                set_site_transient($transient, $value, 20 * 86400);
            } else {
                delete_site_transient($transient);
            }
        }
        return get_site_transient($transient) === $value;
    }
}
