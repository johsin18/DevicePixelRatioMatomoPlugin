<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\DevicePixelRatio\tests\Fixtures;

use Piwik\Date;
use Piwik\Tests\Framework\Fixture;

class ManyVisitsWithDifferentDevicePixelRatio extends Fixture
{
    public $idSite = 1;
    public $dateTime = '2018-07-03 07:00:00';

    public $devicePixelRatios = array('1.00', '1.25', '1', '1.50', '2.', '3.0', '2.00', '1.00', '1.0', '1.33333333333', '', 'attack');

    public function setUp(): void
    {
        $this->setUpWebsitesAndGoals();
        $this->trackVisitsInTimespan();
        $this->trackLaterVisits();
    }

    private function setUpWebsitesAndGoals()
    {
        if (!self::siteCreated($idSite = 1)) {
            self::createWebsite($this->dateTime, 0, "Site 1");
        }
    }

    private function trackVisitsInTimespan()
    {
        static $calledCounter = 0;
        $calledCounter++;

        $dateTime = $this->dateTime;
        $idSite = $this->idSite;

        $t = self::getTracker($idSite, $dateTime);
        $t->setTokenAuth(self::getTokenAuth());
        for ($i = 0; $i < count($this->devicePixelRatios); ++$i) {
            $t->setVisitorId(substr(md5($i + $calledCounter * 1000), 0, $t::LENGTH_VISITOR_ID));
            $t->setIp("1.2.4.$i");

            // first visit
            $date = Date::factory($dateTime)->addHour($i);
            $t->setForceVisitDateTime($date->getDatetime());
            $t->setUrl("http://piwik.net/grue/lair");

            if ($this->devicePixelRatios[$i] != '')
                $t->setCustomTrackingParameter('devicePixelRatio', $this->devicePixelRatios[$i]);
            // else unknown device pixel ratio

            $r = $t->doTrackPageView('Page tracked on day');
            self::checkResponse($r);
        }
    }

    private function trackLaterVisits()
    {
        $dateTime = $this->dateTime;
        $idSite = $this->idSite;

        $t = self::getTracker($idSite, $dateTime, $defaultInit = true);
        $t->setTokenAuth(self::getTokenAuth());
        $t->setForceVisitDateTime(Date::factory($dateTime)->addDay(20)->getDatetime());
        $t->setIp('194.57.91.215');
        $t->setUserId('userid.email@example.org');
        $t->setCustomTrackingParameter('devicePixelRatio', '1.0');
        $t->setUrl("http://piwik.net/grue/lair");
        self::checkResponse($t->doTrackPageView('Page tracked later'));
    }
}
