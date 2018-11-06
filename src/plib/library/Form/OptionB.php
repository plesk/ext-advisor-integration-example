<?php

namespace PleskExt\AdvisorIntegrationExample\Form;

use PleskExt\AdvisorIntegrationExample\Backend;

class OptionB extends \pm_Form_Simple
{
    const OPTION_B = 'optionB';

    public function init()
    {
        parent::init();

        $this->addElement('checkbox', 'optionB', [
            'label' => $this->lmsg('setOptionB'),
            'value' => Backend::getOptionB(),
            'description' => $this->lmsg('setOptionBHint'),
        ]);

        $this->addControlButtons();
    }

    public function process()
    {
        parent::process();

        Backend::setOptionB($this->getValue(static::OPTION_B));
    }
}
