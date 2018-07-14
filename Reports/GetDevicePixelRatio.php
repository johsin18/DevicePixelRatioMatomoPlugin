<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DevicePixelRatio\Reports;

use Piwik\Piwik;
use Piwik\Plugin\Report;
use Piwik\Plugin\ViewDataTable;
use Piwik\Plugins\DevicePixelRatio\Columns\DevicePixelRatio;
use Piwik\View;

/**
 * This class defines the report for the device pixel ratios.
 *
 * See {@link http://developer.piwik.org/api-reference/Piwik/Plugin/Report} for more information.
 */
class GetDevicePixelRatio extends Base
{
    protected function init()
    {
        parent::init();

        $this->name          = Piwik::translate('DevicePixelRatio_DevicePixelRatio');
        $this->dimension     = new DevicePixelRatio();
        $this->documentation = Piwik::translate('');

        // This defines in which order your report appears in the mobile app, in the menu and in the list of widgets
        $this->order = 10; // after Screen Resolution
    }

    /**
     * @param ViewDataTable $view
     */
    public function configureView(ViewDataTable $view)
    {
        if (!empty($this->dimension)) {
            $view->config->addTranslations(array('label' => $this->dimension->getName()));
        }

        // $view->config->show_search = false;
        // $view->requestConfig->filter_sort_column = 'nb_visits';
        // $view->requestConfig->filter_limit = 10';

        $view->config->columns_to_display = array_merge(array('label'), $this->metrics);
    }

    /**
     * @return \Piwik\Plugin\Report[]
     */
    public function getRelatedReports()
    {
        return array(); // eg return array(new XyzReport());
    }

}
