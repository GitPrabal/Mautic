<?php

namespace MauticPlugin\CustomCallBundle\Model;

use Mautic\CoreBundle\Model\FormModel;
use MauticPlugin\CustomCallBundle\Entity\Call;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class CallModel extends FormModel
{

    public function getRepository()
    {
        $this->getRepository('CustomCallBundle:Call');
        return;
    }

    public function getPermissionBase()
    {
        echo "Inside Get Repo";die;
        return 'customcrm:opportunity';
    }

    public function getEntity($id = null)
    {
        echo "Inside Get Repo";die;


        if (!$id) {
            return new Opportunity();
        }

        return parent::getEntity($id);
    }

    public function createForm($entity, $formFactory, $action = null, $options = array())
    {
        echo "Inside Get Repo";die;
        if (!$entity instanceof Opportunity) {
            throw new MethodNotAllowedHttpException(array('Opportunity'), 'Entity must be of class Opportunity()');
        }

        if (!empty($action))  {
            $options['action'] = $action;
        }

        return $formFactory->create('customcrm_opportunity', $entity, $options);
    }

    public function saveEntity($entity, $unlock = true)
    {
        echo "Inside Get Repo";die;
        if (!$entity instanceof World) {
            throw new \InvalidArgumentException('entity is not an instance of World Class');
        }

        if (!$entity->getOwnerUser()) {
            $entity->setOwnerUser($this->factory->getUser(true));
        }

        if ($leadId = $this->factory->getRequest()->get('leadId', false)) {
            $entity->setLead($this->factory->getModel('lead')->getEntity($leadId));
        }

        parent::saveEntity($entity);
    }

    public function getStatusList()
    {
        $result = $this->getRepository()->createQueryBuilder('c')
            ->select('c.name as name')
            ->getQuery()->getArrayResult();

            echo  '<pre>';print_r($result);
            die;

        foreach ($result as &$row) {
            $row['name'] = $this->factory->getTranslator()->trans(Call::getStatusLabels($row['id']));
        }

        return $result;
    }

}

/*
// plugins/CallCentreBundle/Model/WorldModel.php











r this variant


tity, ['setVariantHits'], $variantStartDate);







$this->postVariantSaveEntity($entity, $resetVariants, $entity->getRelatedEntityIds(), $variantStartDate);
*/
?>