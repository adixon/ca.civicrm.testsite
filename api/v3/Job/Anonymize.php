<?php

/**
 * Job.Anonymize API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_job_Anonymize_spec(&$spec) {
  // $spec['magicword']['api.required'] = 1;
  // todo - allow configuration?
}

/**
 * Job.Anonymize API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_job_Anonymize($params) {
  $file = CRM_Core_Resources::singleton()->getPath('ca.civicrm.testsite').'/sql/anonymize.sql';
  $commands = file($file);
  foreach($commands as $sql) {
    CRM_Core_DAO::executeQuery($sql);
  }
  // $returnValues = print_r($result, TRUE);
  // Spec: civicrm_api3_create_success($values = 1, $params = array(), $entity = NULL, $action = NULL)
  return civicrm_api3_create_success($returnValues, $params);
}

