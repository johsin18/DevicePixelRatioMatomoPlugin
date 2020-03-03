<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DevicePixelRatio;

class DevicePixelRatio extends \Piwik\Plugin
{
    public function isTrackerPlugin()
    {
        // declare that this plugin's tracker(.min).js should be included in the JavaScript tracker code
        return true;
    }
}
