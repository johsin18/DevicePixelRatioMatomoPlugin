<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DevicePixelRatio\Reports;

use Piwik\Piwik;
use Piwik\Plugin\ViewDataTable;
use Piwik\Plugins\CoreVisualizations\Visualizations\JqplotGraph\Pie;
use Piwik\View;
use Piwik\plugin\ReportsProvider;

/**
 * This class defines the report for the device pixel ratios.
 *
 * See {@link http://developer.piwik.org/api-reference/Piwik/Plugin/Report} for more information.
 */
class GetDevicePixelRatioRanges extends Base
{
    protected function init()
    {
        parent::init();

        $this->name          = Piwik::translate('DevicePixelRatio_DevicePixelRatioRanges');

        // This defines in which order your report appears in the mobile app, in the menu and in the list of widgets
        $this->order = 11; // after Device Pixel Ratio
    }

    /**
     * @param ViewDataTable $view
     */
    public function configureView(ViewDataTable $view)
    {
        parent::configureView($view);
        $view->requestConfig->filter_sort_column = 'label';
        $view->requestConfig->filter_sort_order = 'asc';
        $view->config->max_graph_elements = false; // show all values in pie chart
    }

    public function getDefaultTypeViewDataTable()
    {
        return Pie::ID;
    }

    /**
     * @return \Piwik\Plugin\Report[]
     */
    public function getRelatedReports()
    {
        return array(
            ReportsProvider::factory('DevicePixelRatio', 'getDevicePixelRatio'),
        );
    }

}
