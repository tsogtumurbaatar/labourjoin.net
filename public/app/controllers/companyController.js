 app.controller("myCompaniesController", function($scope, companyService){

    $scope.statusval = 'adding';
    $scope.itemsPerPageVal = 10;
    getCompaniesCont();

    function getCompaniesCont() {
      companyService.listCompanies()
      .then(function (response) {
        $scope.companies = response.data;
      }, function (error) {
        $scope.status = 'Unable to load customer data: ' + error.message;
      });
    }

    $scope.deleteCompanyCont = function(company){
      var result = confirm("Are you sure delete this record?");
      if (result) {
       companyService.removeCompany(company)
       .then(function(response){ 
        var index=$scope.companies.indexOf(company)
        $scope.companies.splice(index,1);
      });
     };
   };  

   $scope.insertCompanyCont = function() {
     var flag = 1;
     if(!$scope.newcompany.email)
     {
      flag = 0;
      window.alert('The email is not a valid');
     }
      if(!$scope.newcompany.password)
     {
      flag = 0;
      window.alert('The password is not a valid');
     }

     if(flag)
     {
     companyService.addCompany($scope.newcompany)
     .then(function(response){ 
       $scope.statusval = 'success_newworker';
       $scope.companies.push(response.data);
     });
   }
   };

$scope.createCompanyCont = function() {
    $scope.statusval = '';
    $scope.newcompany = {};
   };


 $scope.changeCompanyCont = function(company, index)
   {
 var result = confirm("Are you sure change status of this company?");
      if (result) {
   companyService.changeCompany(company)
     .then(function(response){ 
       $scope.companies[index] = angular.copy(response.data);
     });
   }
  }

  $scope.saveCompanyCont = function(row_index) {
     companyService.saveCompany($scope.editcompany)
     .then(function(response){ 
      $scope.statusval = 'success_editworker';
       $scope.companies[row_index] = angular.copy($scope.editcompany);
     });
   };


   $scope.editCompanyCont = function(company, index)
   {
    $scope.editcompany = angular.copy(company);
    $scope.row_index = index;
  }

  $scope.cancel = function()
  {
    $scope.newbook = {};
    $scope.statusval = 'adding';

  }

  $scope.setPaginateValue = function(selectedvalue){
    if(selectedvalue !='')
      $scope.itemsPerPageVal = selectedvalue;

  }

  $scope.sort = function(sortkey){
    $scope.sortkey = sortkey;
    $scope.reverse = !$scope.reverse;

  }

});