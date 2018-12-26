<?php

namespace MauticPlugin\CustomCallBundle\Entity;

use Mautic\CoreBundle\Entity\CommonRepository;

class CallRepository extends CommonRepository
{
    public function getCampaignCount()
    {
        echo "Inside";die;
        
    }

    public function getEntities($args = array())
    {
        echo " Inside get entities";die;

        // $q = $this->_em
        //     ->createQueryBuilder()
        //     ->select('e')
        //     ->from('CustomCrmBundle:Opportunity', 'e', 'e.id')
        //     ->leftJoin('e.ownerUser', 'o');

        // $args['qb'] = $q;

        // return parent::getEntities($args);
    }
}
