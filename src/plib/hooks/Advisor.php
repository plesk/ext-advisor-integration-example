<?php
// Copyright 1999-2018. Parallels IP Holdings GmbH. All Rights Reserved.

use PleskExt\AdvisorIntegrationExample\Backend;
use PleskExt\Advisor\Api\{
    RecommendationInterface,
    RecommendationsHookInterface,
    RecommendationsCollectionInterface,
    ApplyInterface
};

class Modules_AdvisorIntegrationExample_Advisor implements RecommendationsHookInterface
{
    const RECOMMENDATION_1_CODE = 'recommendation-1';
    const RECOMMENDATION_1_STEP_1_CODE = 'step-1';
    const RECOMMENDATION_1_ICON = 'images/recommendation-1.png';
    const RECOMMENDATION_2_CODE = 'recommendation-2';
    const RECOMMENDATION_2_STEP_1_CODE = 'step-1';
    const RECOMMENDATION_2_ICON = 'images/recommendation-2.png';
    const RECOMMENDATION_3_CODE = 'recommendation-3';
    const RECOMMENDATION_3_STEP_1_CODE = 'step-1';
    const RECOMMENDATION_3_STEP_2_CODE = 'step-2';
    const RECOMMENDATION_3_ICON = 'images/recommendation-3.png';
    const RECOMMENDATION_4_CODE = 'recommendation-4';
    const RECOMMENDATION_4_STEP_1_CODE = 'step-1';
    const RECOMMENDATION_4_STEP_2_CODE = 'step-2';
    const RECOMMENDATION_4_STEP_3_CODE = 'step-3';
    const RECOMMENDATION_4_TABLE_COLUMN_NAME = 'name';
    const RECOMMENDATION_4_TABLE_COLUMN_OPTION_E = 'optionE';
    const RECOMMENDATION_4_TABLE_COLUMN_OPTION_F = 'optionF';
    const RECOMMENDATION_4_ICON = 'images/recommendation-4.png';

    /**
     * @param RecommendationsCollectionInterface $ri
     * @return RecommendationsCollectionInterface
     * @throws pm_Exception
     */
    public function getRecommendations(RecommendationsCollectionInterface $ri): RecommendationsCollectionInterface
    {
        // This is the simplest recommendation which do some single action synchronously
        $ri->addRecommendation(static::RECOMMENDATION_1_CODE, \pm_Locale::lmsg('recommendation1'))
            ->setDescription(\pm_Locale::lmsg('recommendation1Hint'))
            ->setIconPath(\pm_Context::getBaseUrl() . static::RECOMMENDATION_1_ICON)
            ->setCategories([RecommendationInterface::CATEGORY_REPUTATION])
            ->setDefaultActionUrl(\pm_Locale::lmsg('recommendationDefaultAction'), '/modules/advisor-integration-example', false)
            ->addStep(static::RECOMMENDATION_1_STEP_1_CODE, \pm_Locale::lmsg(Backend::getOptionA() ? 'recommendation1OptionATurnedOn' : 'recommendation1OptionATurnedOff'))
            ->setDone(Backend::getOptionA())
            ->setAction(\pm_Locale::lmsg('recommendation1TurnOnOptionA'));

        // This recommendation is a little harder: it still do some single action, but works asynchronously:
        // assume this action could take some time and we want to display a progress.
        $ri->addRecommendation(static::RECOMMENDATION_2_CODE, \pm_Locale::lmsg('recommendation2'))
            ->setDescription(\pm_Locale::lmsg('recommendation2Hint'))
            ->setIconPath(\pm_Context::getBaseUrl() . static::RECOMMENDATION_2_ICON)
            ->setCategories([RecommendationInterface::CATEGORY_REPUTATION])
            ->setDefaultActionUrl(\pm_Locale::lmsg('recommendationDefaultAction'), '/modules/advisor-integration-example', false)
            ->addStep(static::RECOMMENDATION_2_STEP_1_CODE, \pm_Locale::lmsg(Backend::getOptionB() ? 'recommendation2OptionBTurnedOn' : 'recommendation2OptionBTurnedOff'))
            ->setDone(Backend::getOptionB())
            ->setTaskRunning(Backend::isOptionBScheduled())
            ->setAction(\pm_Locale::lmsg(Backend::isOptionBScheduled() ?
                'recommendation2TurnOnOptionBProgress' :
                'recommendation2TurnOnOptionB'));

        // This recommendation contains two steps: do one action and then do another action. In this example
        // both actions performed synchronously, but nothing prevents to combine experience of previous
        // example and make one or both steps asynchronous (but still subsequent)
        $recommendation3 = $ri->addRecommendation(
            static::RECOMMENDATION_3_CODE,
            \pm_Locale::lmsg('recommendation3')
        )
            ->setDescription(\pm_Locale::lmsg('recommendation3Hint'))
            ->setIconPath(\pm_Context::getBaseUrl() . static::RECOMMENDATION_3_ICON)
            ->setCategories([RecommendationInterface::CATEGORY_REPUTATION])
            ->setDefaultActionUrl(\pm_Locale::lmsg('recommendationDefaultAction'), '/modules/advisor-integration-example', false);
        $recommendation3
            ->addStep(static::RECOMMENDATION_3_STEP_1_CODE, \pm_Locale::lmsg(Backend::getOptionC() ? 'recommendation3OptionCTurnedOn' : 'recommendation3OptionCTurnedOff'))
            ->setDone(Backend::getOptionC())
            ->setAction(\pm_Locale::lmsg('recommendation3TurnOnOptionC'));
        $recommendation3
            ->addStep(static::RECOMMENDATION_3_STEP_2_CODE, \pm_Locale::lmsg(Backend::getOptionD() ? 'recommendation3OptionDTurnedOn' : 'recommendation3OptionDTurnedOff'))
            ->setDone(Backend::getOptionD())
            ->setAction(\pm_Locale::lmsg('recommendation3TurnOnOptionD'));

        // This is the most complex recommendation which demonstrate how to suggest to apply some stuff for the
        // items in the list. Such recommendation may include one ar multiple (as in this case) steps.
        // All step with table action assigned will be applied to each item separately. All steps
        // with common action assigned must be completed before rest actions become available.
        $recommendation4 = $ri->addRecommendation(
            static::RECOMMENDATION_4_CODE,
            \pm_Locale::lmsg('recommendation4')
        )
            ->setDescription(\pm_Locale::lmsg('recommendation4Hint'))
            ->setIconPath(\pm_Context::getBaseUrl() . static::RECOMMENDATION_4_ICON)
            ->setCategories([RecommendationInterface::CATEGORY_REPUTATION])
            ->setDefaultActionUrl(\pm_Locale::lmsg('recommendationDefaultAction'), '/modules/advisor-integration-example', false);
        $recommendation4
            ->addStep(static::RECOMMENDATION_4_STEP_1_CODE, \pm_Locale::lmsg(Backend::getOptionE() && Backend::getOptionF() ? 'recommendation4OptionsTurnedOn' : 'recommendation4OptionsTurnedOff'))
            ->setDone(Backend::getOptionE() && Backend::getOptionF())
            ->setAction(\pm_Locale::lmsg('recommendation4TurnOnOptionsEF'));
        $recommendation4
            ->addStep(static::RECOMMENDATION_4_STEP_2_CODE, \pm_Locale::lmsg(Backend::getEntitiesOptionE() ? 'recommendation4EntityOptionETurnedOn' : 'recommendation4EntityOptionETurnedOff'))
            ->setTableAction(\pm_Locale::lmsg('recommendation4TurnOnEntityOptionE'))
            ->setProgress(Backend::getEntitiesOptionECount(), Backend::getEntitiesCount());
        $recommendation4
            ->addStep(static::RECOMMENDATION_4_STEP_3_CODE, \pm_Locale::lmsg(Backend::getEntriesOptionF() ? 'recommendation4EntityOptionFTurnedOn' : 'recommendation4EntityOptionFTurnedOff'))
            ->setTableAction(\pm_Locale::lmsg('recommendation4TurnOnEntityOptionF'))
            ->setProgress(Backend::getEntitiesOptionFCount(), Backend::getEntitiesCount());
        $recommendation4Table = $recommendation4->addTable();
        $recommendation4Table->addColumn(static::RECOMMENDATION_4_TABLE_COLUMN_NAME, \pm_Locale::lmsg('recommendation4TableColumnName'));
        $recommendation4Table->addColumn(static::RECOMMENDATION_4_TABLE_COLUMN_OPTION_E, \pm_Locale::lmsg('recommendation4TableColumnOptionE'))->setRating();
        $recommendation4Table->addColumn(static::RECOMMENDATION_4_TABLE_COLUMN_OPTION_F, \pm_Locale::lmsg('recommendation4TableColumnOptionF'))->setRating();
        foreach (Backend::getEntities() as $entity) {
            $optionE = $entity->getOptionE();
            $optionF = $entity->getOptionF();
            $recommendation4Table->addRow($entity->getId())
                ->setData([
                    $entity->getName(),
                    \pm_Locale::lmsg($optionE ? 'recommendation4TableValueOptionTurnedOn' : 'recommendation4TableValueOptionTurnedOff'),
                    \pm_Locale::lmsg($optionF ? 'recommendation4TableValueOptionTurnedOn' : 'recommendation4TableValueOptionTurnedOff'),
                ])
                ->setRatingColumnValues([
                    static::RECOMMENDATION_4_TABLE_COLUMN_OPTION_E => $optionE,
                    static::RECOMMENDATION_4_TABLE_COLUMN_OPTION_F => $optionF,
                ]);
        }

        return $ri;
    }

    public function applyStep(ApplyInterface $apply)
    {
        // Every time customer click on apply button, Advisor call this method and pass a recommendation identity
        // and a step number. For multiple recommendations it also pass a list of selected items and an action
        // identity.
        switch ($apply->getRecommendationId()) {
            case static::RECOMMENDATION_1_CODE:
                Backend::setOptionA(true);
                break;
            case static::RECOMMENDATION_2_CODE:
                Backend::setOptionB(true);
                break;
            case static::RECOMMENDATION_3_CODE:
                switch ($apply->getStepId()) {
                    case static::RECOMMENDATION_3_STEP_1_CODE:
                        Backend::setOptionC(true);
                        break;
                    case static::RECOMMENDATION_3_STEP_2_CODE:
                        Backend::setOptionD(true);
                        break;
                }
                break;
            case static::RECOMMENDATION_4_CODE:
                switch ($apply->getStepId()) {
                    case static::RECOMMENDATION_4_STEP_1_CODE:
                        Backend::setOptionE(true);
                        Backend::setOptionF(true);
                        break;
                    case static::RECOMMENDATION_4_STEP_2_CODE:
                        $entityIds = $apply->getTableSelectedElements();
                        foreach ($entityIds as $entityId) {
                            $entity = Backend::getEntityById($entityId);
                            $entity->setOptionE(true);
                        }
                        break;
                    case static::RECOMMENDATION_4_STEP_3_CODE:
                        $entityIds = $apply->getTableSelectedElements();
                        foreach ($entityIds as $entityId) {
                            $entity = Backend::getEntityById($entityId);
                            $entity->setOptionF(true);
                        }
                        break;
                }
                break;
        }
    }
}
