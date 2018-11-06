<?php

namespace PleskExt\AdvisorIntegrationExample;

class Entity
{
    const OPTION_E = 'optionE';
    const OPTION_F = 'optionF';

    /**
     * @var \pm_Domain
     */
    private $domain;

    /**
     * @param \pm_Domain $domain
     */
    public function __construct(\pm_Domain $domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->domain->getId();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->domain->getDisplayName();
    }

    /**
     * @return bool
     */
    public function getOptionE()
    {
        return 'true' == $this->getOption(static::OPTION_E, false);
    }

    /**
     * @return bool
     */
    public function getOptionF()
    {
        return 'true' == $this->getOption(static::OPTION_F, false);
    }

    /**
     * @param bool $value
     */
    public function setOptionE($value)
    {
        $this->setOption(static::OPTION_E, boolval($value));
    }

    /**
     * @param bool $value
     */
    public function setOptionF($value)
    {
        $this->setOption(static::OPTION_F, boolval($value));
    }

    private function getOption($name, $defaultValue = null)
    {
        return $this->domain->getSetting($name, $defaultValue);
    }

    private function setOption($name, $value)
    {
        $this->domain->setSetting($name, $value);
    }
}
