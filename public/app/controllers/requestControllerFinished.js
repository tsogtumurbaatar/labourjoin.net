app.controller("myRequestControllerFinished", function($scope, requestService){

 getRequestForAgentCont();


  function getRequestForAgentCont() {
    requestService.listRequestForAgentFinished()
    .then(function (response) {
      $scope.workrequestsa = response.data;
    }, function (error) {
      $scope.status = 'Unable to load customer data: ' + error.message;
    });
  }

  getWorkersTimeCont = function(request_id) {
    requestService.listRequestTimeForWorker(request_id)
    .then(function (response) {
      $scope.workertimes = response.data;
    }, function (error) {
      $scope.status = 'Unable to load customer data: ' + error.message;
    });
  }

 $scope.getRequestInfoCont = function(workrequesta){
    $scope.modal_id_info = workrequesta.request_id;
    $scope.modal_name_info = workrequesta.jobs_name;
    $scope.modal_date_info = workrequesta.request_start_date;
    $scope.modal_company_info = workrequesta.company_name;
    $scope.modal_worker_count  = workrequesta.request_worker_count;   
    getWorkersTimeCont(workrequesta.request_id);
  };  


});