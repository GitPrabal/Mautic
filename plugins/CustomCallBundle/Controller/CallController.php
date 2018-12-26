<?php 

namespace MauticPlugin\CustomCallBundle\Controller;

use Mautic\CoreBundle\Controller\CommonController;

use Mautic\CampaignBundle\Entity\Campaign;
use Mautic\CampaignBundle\Entity\Event;
use Mautic\CampaignBundle\Entity\LeadEventLogRepository;
use Mautic\CampaignBundle\EventListener\CampaignActionJumpToEventSubscriber;
use Mautic\CampaignBundle\Model\CampaignModel;
use Mautic\CampaignBundle\Model\EventModel;

use Mautic\CoreBundle\Controller\AbstractStandardFormController;

use Mautic\LeadBundle\Controller\EntityContactsTrait;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;



class CallController extends CommonController
{
    /**
     * Display the world view
     *
     * @param string $world
     *
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page='1')
    {

        $model = $this->factory->getModel('customcall.call');

        $this->factory->getSession()->set('customcall.call.page', $page);

        $limit = $this->factory->getSession()->get('customcrm.opportunity.limit', $this->factory->getParameter('default_pagelimit'));

        $start = ($page === 1) ? 0 : (($page-1) * $limit);

        if ($start < 0){
            $start = 0;
        }

        $listFilters = array(
            'filters'      => array(
                'multiple' => true
            ),
        );

        $listFilters['filters']['groups'] = array();

        //retrieve a list of categories
        $listFilters['filters']['groups']['mautic.customcall.call.filter.user'] = array(
            'options'  => array_map(function($user) {
                return array('name' => $user['firstName'] . ' ' . $user['lastName'], 'id' => $user['id']);
            }, $this->factory->getModel('user')->getLookupResults('user', '', 0)),
            'prefix'   => 'user'
        );

        $session = $this->factory->getSession();
        $currentFilters = $session->get('mautic.customcall.call.list_filters', array());
        $updatedFilters = $this->request->get('filters', false);

        if ($updatedFilters) {
            // Filters have been updated

            // Parse the selected values
            $newFilters     = array();
            $updatedFilters = json_decode($updatedFilters, true);

            if ($updatedFilters) {
                foreach ($updatedFilters as $updatedFilter) {
                    list($clmn, $fltr) = explode(':', $updatedFilter);

                    $newFilters[$clmn][] = $fltr;
                }

                $currentFilters = $newFilters;
            } else {
                $currentFilters = array();
            }
        }
        $session->set('mautic.customcall.call.list_filters', $currentFilters);
        $filter = array();
        
        // $items = $model->getEntities(
        //     array(
        //         'start'      => $start,
        //         'limit'      => $limit,
        //         'filter'     => $filter
        //     ));


        //$listIds    = array_keys($items->getIterator()->getArrayCopy());
        //$campaignCounts = (!empty($listIds)) ? $model->getRepository()->getCampaignCount() : array(); 

        // $leadModel = $this->factory->getModel('lead.lead');

        // return $this->delegateView(
        //     array(
        //         'contentTemplate' => 'CustomCallBundle:Call:details.html.php',
        //     )
        // ); 
        
        $items=array(); 

        $parameters = array(
            'items'       => $items,
            'opportunityCounts'  => 30,
            'page'        => $page,
            'limit'       => $limit,
            'tmpl'        => $this->request->isXmlHttpRequest() ? $this->request->get('tmpl', 'index') : 'index',
            'currentUser' => $this->factory->getUser(),
            'filters'     => $listFilters
        );

        return $this->delegateView(array(
            'viewParameters'  => $parameters,
            'contentTemplate' => 'CustomCallBundle:Call:list.html.php',
            'passthroughVars' => array(
                'activeLink'     => '#mautic_customcall_call_index',
                'mauticContent'  => 'call'
            )
        ));
        
        
    }

    public function newAction()
    {

    }


    /**
     * Contact form
     *
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
   


}
?>