<?php

require_once 'testsite.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function testsite_civicrm_config(&$config) {
  _testsite_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function testsite_civicrm_xmlMenu(&$files) {
  _testsite_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 *
 * Create a reasonable set of deployment environments if we don't have one already.
 */
function testsite_civicrm_install() {
  _testsite_civix_civicrm_install();
  /* test for and optionally create an option group for deployment environment settings */
  $option_group = array();
  try {
    $option_group = civicrm_api3('OptionGroup', 'getsingle', array('name' => 'deployment_environment'));
  }
  catch (CiviCRM_API3_Exception $e) {
    // $error = $e->getMessage();
  }
  if (empty($option_group['id'])) {
    try {
      $option_group = civicrm_api3('OptionGroup', 'create', array(
        'name' => 'deployment_environment',
        'title' => 'Deployment Environment',
        'active' => 1,
        'description' => 'Production, staging, testing, or development.',
      ));
    }
    catch (CiviCRM_API3_Exception $e) {
      // $error = $e->getMessage();
    }
  }
  if (!empty($option_group['id'])) {
    try {
      $option_value_count = civicrm_api3('OptionValue', 'getcount', array('option_group_id' => 'deployment_environment'));
    }
    catch (CiviCRM_API3_Exception $e) {
      // $error = $e->getMessage();
    }
    if (empty($option_value_count)) {
      foreach(array('production' => 'Production', 'staging' => 'Staging', 'development' => 'Development', 'testing' => 'Testing') as $value => $label) {
        $result = civicrm_api3('OptionValue', 'create', array(
          'option_group_id' => 'deployment_environment',
          'value' => $value,
          'label' => $label,
          'is_default' => ($value == 'production' ? '1' : '0'),
        ));
      }
    }
  }
}
/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function testsite_civicrm_uninstall() {
  _testsite_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function testsite_civicrm_enable() {
  _testsite_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function testsite_civicrm_disable() {
  _testsite_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function testsite_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _testsite_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function testsite_civicrm_managed(&$entities) {
  _testsite_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function testsite_civicrm_caseTypes(&$caseTypes) {
  _testsite_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function testsite_civicrm_angularModules(&$angularModules) {
_testsite_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function testsite_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _testsite_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function testsite_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
 */
function testsite_civicrm_navigationMenu(&$menu) {
  _testsite_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('Test Site', array('domain' => 'ca.civicrm.testsite')),
    'name' => 'Test Site',
    'url' => 'civicrm/a/#/testsite',
    'permission' => 'access CiviCRM',
    'separator' => 0,
  ));
  _testsite_civix_navigationMenu($menu);
} 


/**
 * Implementation of hook_civicrm_check
 *
 * Let the user know that the testsite extension is enabled.
 */
function testsite_civicrm_check(&$messages) {
  $messages[] = new CRM_Utils_Check_Message(
    'testsite_enabled',
    ts('The TestSite extension is enabled.'),
    ts('Site Test'),
    \Psr\Log\LogLevel::CRITICAL,
    'fa-flag'
  );
}

/* add this js on every page */
CRM_Core_Resources::singleton()->addScriptFile('ca.civicrm.testsite', 'js/testsite.js', 10, 'page-footer');
