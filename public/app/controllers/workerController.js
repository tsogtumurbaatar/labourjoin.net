 app.controller("myWorkersController", function($scope, workerService){

    $scope.statusval = 'adding';
    $scope.itemsPerPageVal = 10;
    getWorkersCont();

    function getWorkersCont() {
      workerService.listWorkers()
      .then(function (response) {
        $scope.workers = response.data;
      }, function (error) {
        $scope.status = 'Unable to load customer data: ' + error.message;
      });
    }

    $scope.deleteWorkerCont = function(worker){
      var result = confirm("Are you sure delete this record?");
      if (result) {
       workerService.removeWorker(worker)
       .then(function(response){ 
        var index=$scope.workers.indexOf(worker)
        $scope.workers.splice(index,1);
      });
     };
   };  

   $scope.insertWorkerCont = function() {
     var flag = 1;
     if(!$scope.newworker.email)
     {
      flag = 0;
      window.alert('The email is not a valid');
     }
      if(!$scope.newworker.password)
     {
      flag = 0;
      window.alert('The password is not a valid');
     }

     if(flag)
     {
     workerService.addWorker($scope.newworker)
     .then(function(response){ 
       $scope.statusval = 'success_newworker';
       $scope.workers.push(response.data);
     });
    }
   };

  $scope.createWorkerCont = function() {
    $scope.statusval = '';
    $scope.newworker = {};
   };



  $scope.saveWorkerCont = function(row_index) {
     workerService.saveWorker($scope.editworker)
     .then(function(response){ 
       $scope.workers[row_index] = angular.copy($scope.editworker);
     });
   };


   $scope.editWorkerCont = function(worker, index)
   {
    $scope.editworker = angular.copy(worker);
    $scope.row_index = index;
  }

  $scope.changeWorkerCont = function(worker, index)
   {
 var result = confirm("Are you sure change status of this worker?");
      if (result) {
   workerService.changeWorker(worker)
     .then(function(response){ 
       $scope.workers[index] = angular.copy(response.data);
     });
   }
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