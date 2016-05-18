<?php
/*
 * Settings metadata file
 */

return array(
  'deployment_environment' => array(
    'group_name' => 'Deployment',
    'group' => 'deployment',
    'name' => 'deployment_environment',
    'type' => 'String',
    'html_type' => 'Select',
    'default' => 'production',
    'title' => 'Deployment Environment',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Modify the deployment environment variable',
    'help_text' => 'This setting is used by the TestSite extension',
  ),
);
