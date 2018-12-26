<?php 
/** @var \Mautic\LeadBundle\Model\LeadModel $leadModel */
$leadModel = $this->getModel('lead'); // shortcut for lead.lead

/** @var \Mautic\LeadBundle\Model\ListModel $leadListModel */
$leadListModel = $this->getModel('lead.list');

/** @var \MauticPlugin\HelloWorldBundle\Model\ContactModel $contactModel */
$contactModel = $this->getModel('helloworld.contact');


?>