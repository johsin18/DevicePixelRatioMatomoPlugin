<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\DevicePixelRatio\tests\System;

use Piwik\Plugins\DevicePixelRatio\tests\Fixtures\ManyVisitsWithDifferentDevicePixelRatio;
use Piwik\Tests\Framework\TestCase\SystemTestCase;

/**
 * @group DevicePixelRatio
 * @group Plugins
 */
class ApiTest extends SystemTestCase
{
    /**
     * @var ManyVisitsWithDifferentDevicePixelRatio
     */
    public static $fixture = null; // initialized below class definition

    public static function getOutputPrefix()
    {
        return '';
    }

    public static function getPathToTestDirectory()
    {
        return dirname(__FILE__);
    }

    /**
     * @dataProvider getApiForTesting
     */
    public function testApi($api, $params)
    {
        $this->runApiTests($api, $params);
    }

    public function getApiForTesting()
    {
        $apiToTest[] = array(
            array('DevicePixelRatio'),
            array(
                'idSite'  => self::$fixture->idSite,
                'date'    => self::$fixture->dateTime,
                'periods' => array('day'),
            )
        );

        return $apiToTest;
    }
}

ApiTest::$fixture = new ManyVisitsWithDifferentDevicePixelRatio();
