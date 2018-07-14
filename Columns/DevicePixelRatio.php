<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\DevicePixelRatio\Columns;

use Piwik\Piwik;
use Piwik\Common;
use Piwik\Plugin\Dimension\VisitDimension;
use Piwik\Plugin\Segment;
use Piwik\Tracker\Request;
use Piwik\Tracker\Visitor;
use Piwik\Tracker\Action;

/**
 * This dimension stores the device pixel ratio for a visit.
 *
 * See {@link http://developer.piwik.org/api-reference/Piwik/Plugin\Dimension\VisitDimension} for more information.
 */
class DevicePixelRatio extends VisitDimension
{
    /**
     * Name of the column in the log_visit table.
     * @var string
     */
    protected $columnName = 'device_pixel_ratio';

    /**
     * Type of the column in the MySQL database.
     * @var string
     */
    protected $columnType = 'DECIMAL(5,2) DEFAULT NULL';

    /**
     * The type of the dimension is automatically detected by the columnType. If the type of the dimension is not
     * detected correctly, you may want to adjust the type manually. The configured type will affect how the dimension
     * is formatted in the UI.
     * @var string
     */
    // protected $type = self::TYPE_NUMBER;

    /**
     * The name of the dimension which will be visible for instance in the UI of a related report and in the mobile app.
     * @return string
     */
    protected $nameSingular = 'DevicePixelRatio_DevicePixelRatio';

    /**
     * By defining a segment a user will be able to filter their visitors by this column. For instance
     * show all reports only considering users having more than 10 achievement points. If you do not want to define a
     * segment for this dimension, simply leave the name empty.
     */
    protected $segmentName = 'devicePixelRatio';

    protected $acceptValues = 'Any number with two decimals';

    /**
     * The onNewVisit method is triggered when a new visitor is detected. This means here you can define an initial
     * value for this user. By returning boolean false no value will be saved. Once the user makes another action the
     * event "onExistingVisit" is executed. That means for each visitor this method is executed once. If you do not want
     * to perform any action on a new visit you can just remove this method.
     *
     * @param Request $request
     * @param Visitor $visitor
     * @param Action|null $action
     * @return mixed|false
     */
    public function onNewVisit(Request $request, Visitor $visitor, $action)
    {
        $devicePixelRatio = Common::getRequestVar('devicePixelRatio', false, 'string', $request->getParams());
        if (preg_match('/^\d+\.?\d*$/', $devicePixelRatio) === 0)
            return false;
        return $devicePixelRatio; // database will round to two decimals

        // you could also easily save any custom tracking url parameters
        // return Common::getRequestVar('myCustomTrackingParam', 'default', 'string', $request->getParams());
        // return Common::getRequestVar('linuxversion', false, 'string', $request->getParams());
    }

    /**
     * The onExistingVisit method is triggered when a visitor was recognized meaning it is not a new visitor.
     * If you want you can overwrite any previous value set by the event onNewVisit. By returning boolean false no value
     * will be updated. If you do not want to perform any action on a new visit you can just remove this method.
     *
     * @param Request $request
     * @param Visitor $visitor
     * @param Action|null $action
     *
     * @return mixed|false
     */
    public function onExistingVisit(Request $request, Visitor $visitor, $action)
    {
        return false;
    }
}
