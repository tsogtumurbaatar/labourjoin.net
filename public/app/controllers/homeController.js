 app.controller("myHomeController", function($scope, companyService){

   
  
  $scope.getInfoCont = function(requst_id){
      companyService.getInfo(requst_id)
      .then(function (response) {
        $scope.info = response.data;
      }, function (error) {
        $scope.status = 'Unable to load customer data: ' + error.message;
      });
    }


 


 

});