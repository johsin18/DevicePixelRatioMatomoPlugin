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
        $dataTable = $archive->getDataTable(Archiver::DEVICEPIXELRATIO_ARCHIVE_RECORD);
        $dataTable->queueFilter('ReplaceColumnNames');
        $dataTable->queueFilter('ReplaceSummaryRowLabel');
        $dataTable->filter('AddSegmentValue');
        return $dataTable;
    }
}
