<?php

namespace PleskExt\AdvisorIntegrationExample\Form;

use PleskExt\AdvisorIntegrationExample\Backend;

class OptionA extends \pm_Form_Simple
{
    const OPTION_A = 'optionA';

    public function init()
    {
        parent::init();

        $this->addElement('checkbox', 'optionA', [
            'label' => $this->lmsg('setOptionA'),
            'value' => Backend::getOptionA(),
            'description' => $this->lmsg('setOptionAHint'),
        ]);

        $this->addControlButtons();
    }

    public function process()
    {
        parent::process();

        Backend::setOptionA($this->getValue(static::OPTION_A));
    }
}
