app.controller("myRequestController", function($scope, requestService, workerService,$timeout){

  $scope.statusval = 'adding';
  $scope.itemsPerPageVal = 10;
  var workersVal = {};

   

  // window.alert($location.path());

  getRequestCont();
  getRequestForAgentCont();


  getWorkersTimeCont = function(request_id) {
    requestService.listRequestTimeForWorker(request_id)
    .then(function (response) {
      $scope.workertimes = response.data;
    }, function (error) {
      $scope.status = 'Unable to load customer data: ' + error.message;
    });
  }

  getWorkersCont = function(val_date) {
    workerService.listWorkersForAgent(val_date)
    .then(function (response) {
        $scope.workers = response.data;
    }, function (error) {
      $scope.status = 'Unable to load customer data: ' + error.message;
    });
  }
  
  function getRequestCont() {
    requestService.listRequest()
    .then(function (response) {
      $scope.workrequests = response.data;
    }, function (error) {
      $scope.status = 'Unable to load customer data: ' + error.message;
    });
  }

  function getRequestForAgentCont() {
    requestService.listRequestForAgent()
    .then(function (response) {
      $scope.workrequestsa = response.data;
    }, function (error) {
      $scope.status = 'Unable to load customer data: ' + error.message;
    });
  }

  $scope.changeRequestCont = function(request_id)
   {
 var result = confirm("Are you sure change status of this request?");
      if (result) {
   requestService.changeRequest(request_id)
     .then(function(response){ 
       
        if($scope.modal_request_finished == 1 )
    {$scope.modal_request_status  = 'Not completed';
    $scope.modal_request_finished = 0;
    }
    else
    {$scope.modal_request_status  = 'Completed';
     $scope.modal_request_finished = 1;     
    }   
  
     });
   }
  }


  $scope.showModalAssign = function(workrequesta){
    $scope.modal_id = workrequesta.request_id;
    $scope.modal_name = workrequesta.jobs_name;
    $scope.modal_date = workrequesta.request_start_date;
    getWorkersCont(workrequesta.request_start_date);
   
 
  };  

  $scope.getRequestInfoCont = function(workrequesta){
    $scope.modal_id_info = workrequesta.request_id;
    $scope.modal_name_info = workrequesta.jobs_name;
    $scope.modal_date_info = workrequesta.request_start_date;
    $scope.modal_company_info = workrequesta.company_name;
    $scope.modal_worker_count  = workrequesta.request_worker_count;   
    getWorkersTimeCont(workrequesta.request_id);
  };  

  $scope.getRequestInfoCompanyCont = function(workrequesta){
    $scope.modal_id_info = workrequesta.request_id;
    $scope.modal_name_info = workrequesta.jobs_name;
    $scope.modal_date_info = workrequesta.request_start_date;
    $scope.modal_worker_count  = workrequesta.request_worker_count;   
    
    if(workrequesta.request_finished == 0 )
    {$scope.modal_request_status  = 'Not completed';
    $scope.modal_request_finished = 0;
    }
    else
    {$scope.modal_request_status  = 'Completed';
     $scope.modal_request_finished = 1;     
    }   
    
    getWorkersTimeCont(workrequesta.request_id);
    var total_hours = 0;
    angular.forEach($scope.workertimes, function(workertime){
     
      total_hours = (+total_hours) + (+workertime.action_total_time);
    })

    $scope.total_hours1 = total_hours;

  };  

  $scope.getRowStatus = function(workrequesta){
    if(workrequesta.request_worker_count <= workrequesta.too)
        return "success";
      else
        if(workrequesta.request_worker_count <= workrequesta.too1)
          return "info";
          else
            return "danger";
  };

  $scope.getRowStatus1 = function(workrequesta){
    if(workrequesta.request_worker_count <= workrequesta.too)
        return "";
      else
        if(workrequesta.request_worker_count <= workrequesta.too1)
          return "";
          else
            return "color:white;";
  };


  $scope.calculateTheTime = function()
  {
    var diff, a1, b1, total_hours = 0;
    angular.forEach($scope.workertimes, function(workertime){
     diff = ( new Date("1970-1-1 " + workertime.action_finish_time) - new Date("1970-1-1 " + workertime.action_start_time)) / 1000 / 60 / 60;
     
     a1 = workertime.action_break_time.split(':'); 
     b1 = (+a1[0]) * 60 + (+a1[1])  / 60
     diff = diff - b1; 

      //window.alert(diff);
      workertime.action_total_time = diff;
      total_hours = (+total_hours) + (+diff);
    })

    $scope.total_hours1 = total_hours;
  }

  $scope.refreshContentCont = function()
  {
     $timeout(function() {
      getWorkersCont($scope.modal_date);
    }, 1000);
  }

  $scope.refreshContentRequestsCont = function()
  {
     $timeout(function() {
      getRequestCont();
    }, 1000);
  }

  $scope.refreshContentRequestsAgentCont = function()
  {
     $timeout(function() {
      getRequestForAgentCont();
    }, 1000);
  }


  
  $scope.saveTheWorkerTimes = function()
  {
    angular.forEach($scope.workertimes, function(workertime){
      requestService.saveWorkerTime(workertime);
    })
  }

  $scope.addAgentSentRequestCont = function(){

    angular.forEach($scope.workers, function(worker){
      if (!!worker.selected) requestService.addAgentSentRequest(worker.id, $scope.modal_date,$scope.modal_id);
    });

  $timeout(function() {
      getWorkersCont($scope.modal_date);
    }, 1000);

  // getWorkersCont($scope.modal_date);
  // _.defer(function(){$scope.$apply();});

  };  

  $scope.addAgentAssignCont = function(){

    angular.forEach($scope.workers, function(worker){
      if (!!worker.selected) requestService.addAgentAssign(worker.id, $scope.modal_date,$scope.modal_id);
    });
  
  $timeout(function() {
    getWorkersCont($scope.modal_date);
    }, 1000);

// getWorkersCont($scope.modal_date);
//   _.defer(function(){$scope.$apply();});
     
  };  

  $scope.deleteRequestCont = function(workrequest){
    var result = confirm("Are you sure delete this record?");
    if (result) {
     requestService.removeRequest(workrequest)
     .then(function(response){ 
      var index=$scope.workrequests.indexOf(workrequest)
      $scope.workrequests.splice(index,1);
    });
   };
 };  

 $scope.insertJobCont = function() {
   jobService.addJob($scope.newjob)
   .then(function(response){ 
     $scope.statusval = 'success_newjob';
     $scope.jobs.push(response.data);
   });
 };


 $scope.saveWorkerCont = function(row_index) {
   workerService.saveWorker($scope.newbook)
   .then(function(response){ 
     $scope.books[row_index] = angular.copy($scope.newbook);
   });
 };


 $scope.editWorkerCont = function(worker, index)
 {
  $scope.editworker = angular.copy(worker);
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