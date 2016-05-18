(function(angular, $, _) {

  angular.module('testsite').config(function($routeProvider) {
      $routeProvider.when('/testsite', {
        controller: 'TestsiteTestSiteCtrl',
        templateUrl: '~/testsite/TestSiteCtrl.html',

        resolve: {
          myVersion: function(crmApi) {
            return crmApi('System', 'getsingle', {
              return: ['version','uf']
            });
          }
        }
      });
    }
  );

  // The controller uses *injection*. This default injects a few things:
  //   $scope -- This is the set of variables shared between JS and HTML.
  //   crmApi, crmStatus, crmUiHelp -- These are services provided by civicrm-core.
  //   myVersion -- Defined above in config().
  angular.module('testsite').controller('TestsiteTestSiteCtrl', function($scope, crmApi, crmStatus, crmUiHelp, myVersion) {
    // The ts() and hs() functions help load strings for this module.
    var ts = $scope.ts = CRM.ts('testsite');
    var hs = $scope.hs = crmUiHelp({file: 'CRM/testsite/TestSiteCtrl'}); // See: templates/CRM/testsite/TestSiteCtrl.hlp
    // console.log('hello');
    // We have myVersion available in JS. We also want to reference it in HTML.
    $scope.myVersion = myVersion;
    $scope.mySettings = {};
    $scope.data = {};
    // get my allowable option values
    CRM.api3('OptionValue', 'get', {'return': 'label,value', 'option_group_id': 'deployment_environment'}).done(
      function(result) {
        var deployment_options = {};
        $scope.data.deployment_environment_options = [];
        CRM.$.each(result.values, function(index, myOption) {
          $scope.data.deployment_environment_options.push({id: myOption.value, name: myOption.label});
          deployment_options[myOption.value] = myOption.label;
        });
        getDeploymentEnvironment(deployment_options);
      }
    )
    // get my current deployment_environment
    function getDeploymentEnvironment(myOptions) {
      CRM.api3('Setting','getvalue', {'name': 'deployment_environment'}).done(
        function(result) { 
          if (result.is_error == 0) {
            // console.log(result);
            $scope.mySettings.deployment_environment = {
              id : result.result,
              name : myOptions[result.result]
            };
            // console.log($scope.mySettings.deployment_environment);
          }
        }
      );
    }
    $scope.updateEnvironment = function save() {
      // console.log(this.mySettings);
      return crmStatus(
        // Status messages. For defaults, just use "{}"
        {start: ts('Saving...'), success: ts('Saved')},
        // The save action. Note that crmApi() returns a promise.
        crmApi('Setting', 'create', {
          deployment_environment: this.mySettings.deployment_environment.id
        })
      );
    }; 
    $scope.anonymize = function anonymize() {
      // console.log(this.mySettings);
      return crmStatus(
        // Status messages. For defaults, just use "{}"
        {start: ts('Anonymizing...'), success: ts('Anonymized')},
        // The save action. Note that crmApi() returns a promise.
        crmApi('Job', 'anonymize', {})
      );
    }; 
    
  });

})(angular, CRM.$, CRM._);
