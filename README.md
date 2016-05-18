# CiviCRM TestSite

This is an new extension, in development, designed to be a helper extension for testing CiviCRM sites, especially for testing CiviCRM upgrades.

Do not enable this on a production site, only on a disposable copy. You'll see a new navigation menu item "Test Site" where all the action is.

Here's the original roadmap:

1. Contact data obfuscation
2. Remove live payment processor credentials
3. Disable outgoing mail
4. Environment switching

## Contact data obfuscation

There is prior work on this:

* https://github.com/civicrm/civicrm-core/blob/master/bin/encryptDB.php
* https://github.com/compucorp/civicrmanonymisation/blob/master/readme.md

Contact data obfuscation is an example of a task which might need to happen moving a DB from production to development (local development environments might not need personal data or even a full size DB), but which would not be wanted when moving from production to staging (so review in a live hosting environment can be made accurately and with a complete dataset).

> Current status: there's a new api job 'anonymize' that can be run from a button in the Testsite configuration page. It runs the CiviCRM part of Compucorp's SQL scripts. This script also removes live payment processor credentials.

## Environment switching

This can have two parts:

* Trigger events on environment change (as per `drush env-switch`). This event can be used to perform configuration actions. Examples of configuration actions might be: modify debug settings, disable CiviCRM DB logging, reroute outbound mail,
* Set an environment variable or flag ('environment=development', 'is-testing=true', 'isProductionMode=false') to allow modules to detect the current site environment at runtime.

The latter part (environment variable `isProductionEnvironment`) is already in progress in core, see [CRM-18231](https://issues.civicrm.org/jira/browse/CRM-18231) and 
[Moving CiviCRM from production to staging](https://wiki.civicrm.org/confluence/display/CRMDOC/Moving+CiviCRM+instance+from+production+to+staging).

> Current status: there's now a "Deployment Environment" (string) system setting that can be set from the TestSite configuration page, it has no effect. There's also an annoying CRM.alert reminding you that you're on a test site on every page. What it should do is set the isProductionEnvironment to false whenever you switch away from production, and probably prevent you from setting it back to production.


## Remove live payment processor credentials, disable outgoing mail

These are examples of common tasks which would need to 

