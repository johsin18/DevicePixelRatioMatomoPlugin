<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\DevicePixelRatio\DataTable\Filter;

use Piwik\DataTable\BaseFilter;
use Piwik\Piwik;

class ReplaceNullByUnknown extends BaseFilter
{
    /**
     * See {@link ReplaceNullByUnknown}.
     *
     * @param DataTable $table
     */
    public function filter($table)
    {
        foreach ($table->getRowsWithoutSummaryRow() as $key => $row) {
            $label = $row->getColumn('label');

            if (empty($label)) {
                $row->setColumn('label', Piwik::translate('General_Unknown'));
            }
        }
    }
}
