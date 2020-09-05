<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link http://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DevicePixelRatio\Reports;

use Piwik\Piwik;
use Piwik\Plugin\ViewDataTable;
use Piwik\View;
use Piwik\plugin\ReportsProvider;

/**
 * This class defines the report for the device pixel ratios.
 *
 * See {@link http://developer.matomo.org/api-reference/Piwik/Plugin/Report} for more information.
 */
class GetDevicePixelRatio extends Base
{
    protected function init()
    {
        parent::init();

        $this->name          = Piwik::translate('DevicePixelRatio_DevicePixelRatio');

        // This defines in which order your report appears in the mobile app, in the menu and in the list of widgets
        $this->order = 10; // after Screen Resolution
    }

    /**
     * @param ViewDataTable $view
     */
    public function configureView(ViewDataTable $view)
    {
        parent::configureView($view);
    }

    /**
     * @return \Piwik\Plugin\Report[]
     */
    public function getRelatedReports()
    {
        return array(
            ReportsProvider::factory('DevicePixelRatio', 'getDevicePixelRatioRanges'),
        );
    }

}
