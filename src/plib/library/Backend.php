<?php

namespace PleskExt\AdvisorIntegrationExample;

use PleskExt\AdvisorIntegrationExample\Task;

class Backend
{
    const OPTION_A = 'optionA';
    const OPTION_B = 'optionB';
    const OPTION_C = 'optionC';
    const OPTION_D = 'optionD';
    const OPTION_E = 'optionE';
    const OPTION_F = 'optionF';

    public static function setOptionA($value)
    {
        \pm_Settings::set(static::OPTION_A, $value);
    }

    public static function setOptionB($value)
    {
        $task = new Task\SetOptionB();
        $task->setParams([
            'value' => $value,
        ]);
        $taskManager = new \pm_LongTask_Manager();
        $taskManager->start($task);
    }

    public static function setOptionC($value)
    {
        \pm_Settings::set(static::OPTION_C, $value);
    }

    public static function setOptionD($value)
    {
        \pm_Settings::set(static::OPTION_D, $value);
    }

    public static function setOptionE($value)
    {
        \pm_Settings::set(static::OPTION_E, $value);
    }

    public static function setOptionF($value)
    {
        \pm_Settings::set(static::OPTION_F, $value);
    }

    public static function getOptionA()
    {
        return \pm_Settings::get(static::OPTION_A, false);
    }

    public static function getOptionB()
    {
        return \pm_Settings::get(static::OPTION_B, false);
    }

    public static function getOptionC()
    {
        return \pm_Settings::get(static::OPTION_C, false);
    }

    public static function getOptionD()
    {
        return \pm_Settings::get(static::OPTION_D, false);
    }

    public static function getOptionE()
    {
        return \pm_Settings::get(static::OPTION_E, false);
    }

    public static function getOptionF()
    {
        return \pm_Settings::get(static::OPTION_F, false);
    }

    public static function isOptionBScheduled()
    {
        $taskManager = new \pm_LongTask_Manager();
        $setOptionBTaskId = (new Task\SetOptionB())->getId();
        $runningTasks = array_filter($taskManager->getTasks([$setOptionBTaskId]), function ($task) {
            return \pm_LongTask_Task::STATUS_RUNNING == $task->getStatus();
        });
        return !empty($runningTasks);
    }

    /**
     * @return Entity[]
     */
    public static function getEntities()
    {
        return array_map(function (\pm_Domain $domain) {
            return new Entity($domain);
        }, array_values(\pm_Domain::getAllDomains()));
    }

    public static function getEntitiesCount()
    {
        return count(self::getEntities());
    }

    /**
     * Return true if option E is set for all entities, false otherwise
     *
     * @return bool
     */
    public static function getEntitiesOptionE()
    {
        return empty(array_filter(Backend::getEntities(), function (Entity $entry) {
            return !$entry->getOptionE();
        }));
    }

    public static function getEntitiesOptionECount()
    {
        return count(array_filter(Backend::getEntities(), function (Entity $entry) {
            return $entry->getOptionE();
        }));
    }

    /**
     * Return true if option F is set for all entities, false otherwise
     *
     * @return bool
     */
    public static function getEntriesOptionF()
    {
        return empty(array_filter(Backend::getEntities(), function (Entity $entry) {
            return !$entry->getOptionF();
        }));
    }

    public static function getEntitiesOptionFCount()
    {
        return count(array_filter(Backend::getEntities(), function (Entity $entry) {
            return $entry->getOptionF();
        }));
    }

    public static function isEntriesFine()
    {
        return empty(array_filter(Backend::getEntities(), function (Entity $entry) {
            return !$entry->getOptionE() || !$entry->getOptionF();
        }));
    }

    /**
     * @param int $id
     * @return Entity
     */
    public static function getEntityById($id)
    {
        return new Entity(\pm_Domain::getByDomainId($id));
    }
}
