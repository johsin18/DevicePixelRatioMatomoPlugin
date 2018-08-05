<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\DevicePixelRatio;

use Piwik\Piwik;
use Piwik\Plugins\Live\VisitorDetailsAbstract;

/** Adds the device pixel ratio to the tooltip shown when hovering over the device type icon in the visitor log. */
class VisitorDetails extends VisitorDetailsAbstract
{
    public function extendVisitorDetails(&$visitor)
    {
        $devicePixelRatio = $this->getDevicePixelRatio();
        if ($devicePixelRatio) {
            $visitor['devicePixelRatio'] = $devicePixelRatio; // unfortunately, this is not used by any other component yet
            $devicePixelRatioAcronym = Piwik::translate('DevicePixelRatio_DevicePixelRatioAcronym');

            // HACK depends on whether the Screen Resolution plugin or us handles this first, but I cannot change Live/templates/_visitorLogIcons.twig
            $visitor['resolution'] = $visitor['resolution'].' ('.$devicePixelRatioAcronym.' '.$devicePixelRatio.')';
        }
    }

    protected function getDevicePixelRatio()
    {
        if (!array_key_exists('device_pixel_ratio', $this->details)) {
            return null;
        }

        return $this->details['device_pixel_ratio'];
    }
}
