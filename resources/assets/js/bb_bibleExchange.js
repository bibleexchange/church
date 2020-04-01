var bibleExchange = angular.module('bibleExchange', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});


bibleExchange.run([
      '$rootScope', function($rootScope) {
          $rootScope.facebookAppId = '1529479753993292';
      }
  ]);
  
bibleExchange.controller('socialController', [
      '$scope', function($scope) {
          $scope.myModel = {
              Name: "Bible exchange",
              ImageUrl: 'http://bible.exchange/images/be_logo.png',
              FbLikeUrl: 'http://bible.exchange'
          };
      }
  ]);

bibleExchange.controller('BookmarksController', ['$scope', '$http', '$templateCache',
  
    function($scope, $http, $templateCache) {
    
	$scope.method = 'GET';
    $scope.url = '/user/bookmarks/data';

    $scope.fetch = function() {
      $scope.code = null;
      $scope.response = null;

      $http({method: $scope.method, url: $scope.url, cache: $templateCache}).
        success(function(data, status) {
          $scope.status = status;
          $scope.bookmarks = data;
        }).
        error(function(data, status) {
          $scope.bookmarks = data || "Request failed";
          $scope.status = status;
      });
    };
    
    $scope.fetch();
    
    $scope.updateModel = function(method, url) {
      $scope.method = method;
      $scope.url = url;
    };
  }]);