<?php
// Copyright 1999-2017. Parallels IP Holdings GmbH. All Rights Reserved.
namespace PleskExt\AdvisorIntegrationExample\Task;

/**
 * Native WordPress installation.
 */
class SetOptionB extends \pm_LongTask_Task
{
    const OPTION_B_TURN_ON_DELAY = 10;
    const OPTION_B = 'optionB';

    public $poolSize = 1;

    /**
     * Process task execution signal
     */
    public function run()
    {
        if ($this->getParam('value')) {
            sleep(static::OPTION_B_TURN_ON_DELAY);
        }
        \pm_Settings::set(static::OPTION_B, $this->getParam('value'));
    }
}
