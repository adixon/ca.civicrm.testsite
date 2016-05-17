# CiviCRM TestSite

This is an new extension, in development, designed to be a helper extension for testing CiviCRM sites, especially for testing CiviCRM upgrades.

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

## Environment switching

This can have two parts:

* Trigger events on environment change (as per `drush env-switch`). This event can be used to perform configuration actions. Examples of configuration actions might be: modify debug settings, disable CiviCRM DB logging, reroute outbound mail,
* Set an environment variable or flag ('environment=development', 'is-testing=true', 'isProductionMode=false') to allow modules to detect the current site environment at runtime.

The latter part (environment variable `isProductionEnvironment`) is already in progress in core, see [CRM-18231](https://issues.civicrm.org/jira/browse/CRM-18231) and 
[Moving CiviCRM from production to staging](https://wiki.civicrm.org/confluence/display/CRMDOC/Moving+CiviCRM+instance+from+production+to+staging).

## Remove live payment processor credentials, disable outgoing mail

These are examples of common tasks which would need to 

