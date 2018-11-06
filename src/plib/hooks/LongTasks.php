<?php
// Copyright 1999-2017. Parallels IP Holdings GmbH. All Rights Reserved.

use PleskExt\AdvisorIntegrationExample\Task;

class Modules_AdvisorIntegrationExample_LongTasks extends pm_Hook_LongTasks
{
    public function getLongTasks()
    {
        return [
            new Task\SetOptionB()
        ];
    }
}
