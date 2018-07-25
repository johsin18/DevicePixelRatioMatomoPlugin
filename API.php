<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\DevicePixelRatio;

use Piwik\Archive;
use Piwik\DataTable;
use Piwik\DataTable\Row;
use Piwik\Piwik;

/**
 * API for plugin DevicePixelRatio
 *
 * @method static \Piwik\Plugins\DevicePixelRatio\API getInstance()
 */
class API extends \Piwik\Plugin\API
{
    /**
     * @param int    $idSite
     * @param string $period
     * @param string $date
     * @param bool|string $segment
     * @return DataTable
     */
    public function getDevicePixelRatio($idSite, $period, $date, $segment = false)
    {
        Piwik::checkUserHasViewAccess($idSite);
        $archive = Archive::build($idSite, $period, $date, $segment);
        /** @var DataTable|DataTable\Map $dataTable */
        $dataTable = $archive->getDataTable(Archiver::DEVICEPIXELRATIO_ARCHIVE_RECORD);
        $dataTable->queueFilter('ReplaceColumnNames');
        $dataTable->queueFilter('ReplaceSummaryRowLabel');
        $dataTable->filter('Piwik\Plugins\DevicePixelRatio\DataTable\Filter\ReplaceNullByUnknown');
        $dataTable->filter('AddSegmentValue');

        return $dataTable;
    }

    /**
     * @param int    $idSite
     * @param string $period
     * @param string $date
     * @param bool|string $segment
     * @return DataTable
     */
    public function getDevicePixelRatioRanges($idSite, $period, $date, $segment = false)
    {
        $dataTable = $this->getDevicePixelRatio($idSite, $period, $date, $segment);
        $dataTable->filter('GroupBy', array(
                    'label',
                    function ($label) {
                        if (!is_numeric($label))
                            return $label;
                        $f = floatval($label);
                        $c = number_format(ceil($f), 2);
                        return Piwik::translate("DevicePixelRatio_upToX", $c);
                    }
                ));

        return $dataTable;
    }
}
