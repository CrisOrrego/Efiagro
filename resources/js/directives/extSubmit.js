angular.module('extSubmit', []).directive("extSubmit", ['$timeout',function($timeout){
    return {
        link: function($scope, $el, $attr) {
            $scope.$on('makeSubmit', function(event, data){
              if(data.formName === $attr.name) {
                $timeout(function() {
                  $el.triggerHandler('submit');
                }, 0, false);
              }
            })
        }
    };
}]);
