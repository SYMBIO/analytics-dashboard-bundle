<?php
/**
 * This file is part of the PrestaGoogleAnalyticsDashboardBundle
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Symbio\OrangeGate\AnalyticsBundle\Controller;
use Symbio\OrangeGate\AnalyticsBundle\Model\GoogleAnalyticsManager;
use Symbio\OrangeGate\AnalyticsBundle\Controller\BaseController as AdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
/**
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 */
class DefaultController extends AdminController
{
    /**
     * @return GoogleAnalyticsManager
     */
    protected function getManager()
    {
        return $this->get('orangegate_analytics.manager.google_analytics');
    }
    /**
     * @return array
     */
    protected function getDashboardViewParams()
    {
        $manager    = $this->getManager();
        $today      = $manager->getToday();
        $yesterday  = $manager->getYesterday();
        return array(
            'is_dummy' => $manager->isDummy(),
            'today_visit'               => $today->getVisits(),
            'today_page_view'           => $today->getPageViews(),
            'today_page_per_visit'      => $today->getPageViewsPerVisit(),
            'today_avg_time_on_site'    => $today->getAvgTimeOnSite(),
            'today_visit_bounce_rate'   => $today->getVisitBounceRate(),
            'today_new_visit'           => $today->getNewVisits(),
            'yesterday_visit'               => $yesterday->getVisits(),
            'yesterday_page_view'           => $yesterday->getPageViews(),
            'yesterday_page_per_visit'      => $yesterday->getPageViewsPerVisit(),
            'yesterday_avg_time_on_site'    => $yesterday->getAvgTimeOnSite(),
            'yesterday_visit_bounce_rate'   => $yesterday->getVisitBounceRate(),
            'yesterday_new_visit'           => $yesterday->getNewVisits(),
        );
    }
    /**
     * @return Response
     */
    /**
     * @Route("/og-analytics", name="og4_analytics")
     */
    public function indexAction()
    {
        return $this->renderResponse(
            'SymbioOrangeGateAnalyticsBundle:Default:index.html.twig',
            $this->getDashboardViewParams()
        );
    }
}