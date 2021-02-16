To add recommendations via Advisor Integration API you need to add a hook that implements RecommendationsHookInterface.
This interface contains two methods:
* getRecommendations - in this method you need to add your recommendations with steps
* applyStep - this method is called by Advisor every time a customer clicks on the apply button of a step

Please, see src/plib/hooks/Advisor.php for more information.
