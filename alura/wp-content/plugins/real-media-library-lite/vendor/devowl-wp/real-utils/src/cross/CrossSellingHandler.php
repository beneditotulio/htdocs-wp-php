<?php

namespace MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\cross;

use MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\UtilsProvider;
use MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\Core;
use MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\TransientHandler;
use MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\view\Options;
// @codeCoverageIgnoreStart
\defined('ABSPATH') or die('No script kiddies please!');
// Avoid direct file request
// @codeCoverageIgnoreEnd
/**
 * Cross-selling handler.
 */
class CrossSellingHandler
{
    use UtilsProvider;
    const PRO_VERSIONS = ['real-thumbnail-generator/index.php', \MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\cross\CrossRealCategoryLibrary::FILE_PRO, \MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\cross\CrossRealPhysicalMedia::FILE_PRO, \MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\cross\CrossRealMediaLibrary::FILE_PRO];
    /**
     * C'tor.
     *
     * @codeCoverageIgnore
     */
    private function __construct()
    {
        // Silence is golden.
    }
    /**
     * Check if cross-selling pointers can be shown.
     */
    public function canBeShown()
    {
        if (!\MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\view\Options::isCrossSellingActive()) {
            return \false;
        }
        $ts = \intval(\MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\TransientHandler::get(\MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\TransientHandler::TRANSIENT_INITIATOR_CROSS, \MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\TransientHandler::TRANSIENT_NEXT_CROSS_SELLING, 0));
        // Set initial value
        if ($ts === 0) {
            $ts = \strtotime('+7 days');
            \MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\TransientHandler::set(\MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\TransientHandler::TRANSIENT_INITIATOR_CROSS, \MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\TransientHandler::TRANSIENT_NEXT_CROSS_SELLING, $ts);
        }
        return \time() >= $ts;
    }
    /**
     * Check if a plugin is installed (not depending on active status).
     *
     * @param string $file Main plugin file, e. g. real-media-library/index.php
     */
    public function isInstalled($file)
    {
        $plugins = get_plugins();
        return isset($plugins[$file]);
    }
    /**
     * Check if any pro version of us is installed.
     */
    public function isAnyProInstalled()
    {
        foreach (self::PRO_VERSIONS as $file) {
            if ($this->isInstalled($file)) {
                return \true;
            }
        }
        return \false;
    }
    /**
     * Localize frontend only when needed.
     */
    public function getAvailable()
    {
        if (!$this->canBeShown()) {
            return [];
        }
        $result = [];
        foreach (\array_values(\MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\Core::getInstance()->getCrossSellings()) as $product) {
            if (!$product->skip()) {
                $meta = $product->getMeta();
                // Append dismissed count so the "Never show again" checkbox can be shown
                foreach ($meta as $action => &$value) {
                    // Check if this action is skipped and should not be showed again
                    if ($product->forceHide($action)) {
                        unset($meta[$action]);
                        continue;
                    }
                    $value['link'] = add_query_arg('feature', $action, $value['link']);
                    $value['dismissed'] = $product->actionCounter($action);
                }
                if (\count($meta) > 0) {
                    $result[$product->getSlug()] = $meta;
                }
            }
        }
        return $result;
    }
    /**
     * New instance.
     *
     * @codeCoverageIgnore
     */
    public static function instance()
    {
        return new \MatthiasWeb\RealMediaLibrary\Vendor\DevOwl\RealUtils\cross\CrossSellingHandler();
    }
}
