<?php

namespace MatthiasWeb\RealMediaLibrary\lite\folder;

use MatthiasWeb\RealMediaLibrary\exception\OnlyInProVersionException;
// @codeCoverageIgnoreStart
\defined('ABSPATH') or die('No script kiddies please!');
// Avoid direct file request
// @codeCoverageIgnoreEnd
trait Creatable
{
    // Documented in IFolderActions
    public function resetSubfolderOrder()
    {
        throw new \MatthiasWeb\RealMediaLibrary\exception\OnlyInProVersionException(__METHOD__);
    }
    // Documented in IFolderActions
    public function orderSubfolders($orderby, $writeMetadata = \true)
    {
        throw new \MatthiasWeb\RealMediaLibrary\exception\OnlyInProVersionException(__METHOD__);
    }
    // Documented in IFolderActions
    protected function applySubfolderOrderBy()
    {
        return \false;
    }
}
