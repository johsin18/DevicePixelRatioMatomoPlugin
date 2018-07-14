<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DevicePixelRatio;

use Piwik\DataTable;
use Piwik\Metrics;

/**
 * Class Archiver
 * @package Piwik\Plugins\DevicePixelRatio
 *
 * Archiver is class processing raw data into ready ro read reports.
 * It must implement two methods for aggregating daily reports
 * aggregateDayReport() and other for summing daily reports into periods
 * like week, month, year or custom range aggregateMultipleReports().
 *
 * For more detailed information about Archiver please visit Piwik developer guide
 * http://developer.piwik.org/api-reference/Piwik/Plugin/Archiver
 */
class Archiver extends \Piwik\Plugin\Archiver
{
    const DEVICE_PIXEL_RATIO_DIMENSION = "log_visit.device_pixel_ratio";
    const DEVICEPIXELRATIO_ARCHIVE_RECORD = "DevicePixelRatio_archive_record";

    public function aggregateDayReport()
    {
        $visitorMetrics = $this
             ->getLogAggregator()
             ->getMetricsFromVisitByDimension(self::DEVICE_PIXEL_RATIO_DIMENSION)
             ->asDataTable();
        $this->getProcessor()->insertBlobRecord(self::DEVICEPIXELRATIO_ARCHIVE_RECORD, $visitorMetrics->getSerialized());
    }

    public function aggregateMultipleReports()
    {
         $this->getProcessor()->aggregateDataTableRecords(self::DEVICEPIXELRATIO_ARCHIVE_RECORD);
    }
}
