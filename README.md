To add recommendations via Advisor Integration API, you need to add a hook that implements `RecommendationsHookInterface`.
This interface contains the following methods:

* With the `getRecommendations` method, you add your recommendations with steps. 
  Steps in Advisor Integration API are similar to buttons that apply recommendations in the Plesk interface.
  For example, the "Configure the Plesk Firewall" recommendation has the "Activate" step/button that turns on the Plesk Firewall.
* The `applyStep` method is called by Advisor every time a customer clicks the button in the Plesk interface to apply a recommendation.

For more information, see `src/plib/hooks/Advisor.php`.
