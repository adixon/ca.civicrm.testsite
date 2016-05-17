This is an new extension, in development, designed to be a helper extension for testing CiviCRM sites, especially for testing CiviCRM upgrades.

Here's the original roadmap:
1. faker type obfuscation of existing contacts
2. clear out any payment processor credentials
3. automatically turn of outgoing mail.
4. set a site-wide setting called 'is-testing' that could be used by (e.g. payment processors) to allow some depth of testing. (.e.g. switch to using a sandbox, or whatever is appropriate).

Item 4. is already in progress in core, here: https://wiki.civicrm.org/confluence/display/CRMDOC/Moving+CiviCRM+instance+from+production+to+staging

Item 1. has the beginning of a solution here: https://github.com/compucorp/civicrmanonymisation/blob/master/readme.md
