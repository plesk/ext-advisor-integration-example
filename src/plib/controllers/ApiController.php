<?php

use \PleskExt\AdvisorIntegrationExample\Backend;
use \PleskExt\AdvisorIntegrationExample\Entity;

class ApiController extends pm_Controller_Action
{
    const ENTITY_OPTION_ACTION_ACTIVATE = 'activate';

    public function toggleOptionAAction()
    {
        Backend::setOptionA(!Backend::getOptionA());
        $this->_helper->json(Backend::getOptionA());
    }

    public function getOptionAAction()
    {
        $this->_helper->json(Backend::getOptionA());
    }

    public function toggleOptionBAction()
    {
        Backend::setOptionB(!Backend::getOptionB());
        $this->_helper->json(Backend::getOptionB());
    }

    public function getOptionBAction()
    {
        $this->_helper->json(Backend::getOptionB());
    }

    public function isOptionBScheduledAction()
    {
        $this->_helper->json(Backend::isOptionBScheduled());
    }

    public function toggleOptionCAction()
    {
        Backend::setOptionC(!Backend::getOptionC());
        $this->_helper->json(Backend::getOptionC());
    }

    public function getOptionCAction()
    {
        $this->_helper->json(Backend::getOptionC());
    }

    public function toggleOptionDAction()
    {
        Backend::setOptionD(!Backend::getOptionD());
        $this->_helper->json(Backend::getOptionD());
    }

    public function getOptionDAction()
    {
        $this->_helper->json(Backend::getOptionD());
    }

    public function toggleOptionEAction()
    {
        Backend::setOptionE(!Backend::getOptionE());
        $this->_helper->json(Backend::getOptionE());
    }

    public function getOptionEAction()
    {
        $this->_helper->json(Backend::getOptionE());
    }

    public function toggleOptionFAction()
    {
        Backend::setOptionF(!Backend::getOptionF());
        $this->_helper->json(Backend::getOptionF());
    }

    public function getOptionFAction()
    {
        $this->_helper->json(Backend::getOptionF());
    }

    public function getEntitiesAction()
    {
        $this->_helper->json(array_values(array_map(function (Entity $entity) {
            return [
                'id' => $entity->getId(),
                'name' => $entity->getName(),
                'optionE' => $entity->getOptionE(),
                'optionF' => $entity->getOptionF(),
            ];
        }, Backend::getEntities())));
    }

    public function toggleEntityOptionEAction()
    {
        $data = json_decode($this->getRequest()->getRawBody());
        foreach ($data->selection as $entityId) {
            $entity = Backend::getEntityById($entityId);
            $entity->setOptionE(static::ENTITY_OPTION_ACTION_ACTIVATE == $data->action);
        }
        $this->_forward('get-entities');
    }

    public function toggleEntityOptionFAction()
    {
        $data = json_decode($this->getRequest()->getRawBody());
        foreach ($data->selection as $entityId) {
            $entity = Backend::getEntityById($entityId);
            $entity->setOptionF(static::ENTITY_OPTION_ACTION_ACTIVATE == $data->action);
        }
        $this->_forward('get-entities');
    }
}
