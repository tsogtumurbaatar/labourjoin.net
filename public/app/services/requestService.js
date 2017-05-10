app.service('requestService', ['$http', function($http){

  this.listRequest = function(){
    return $http.get("http://localhost/greenstaff/public/api/requests");
  };

   this.listRequestForAgent = function(){
    return $http.get("http://localhost/greenstaff/public/api/requestsforagenta");
  };

   this.listRequestForAgentFinished = function(){
    return $http.get("http://localhost/greenstaff/public/api/requestsforagentb");
  };


 this.removeRequest = function(workrequest){
    return $http.post("http://localhost/greenstaff/public/api/requestsdelete",{
      'request_id': workrequest.request_id
    });
  };

  this.listRequestTimeForWorker = function(request_id){
    return $http.post("http://localhost/greenstaff/public//api/infofortime",{
      'id': request_id
    });
  };

  this.addRequest = function(newrequest, newlocation, request_job_id){
   return $http.post("http://localhost/greenstaff/public/api/requests",{
    'request_job_id' : request_job_id,
    'request_start_date' : newrequest.request_start_date,
    'request_start_time' : newrequest.request_start_time,
    'request_worker_count' : newrequest.request_worker_count,
    'request_location' : newlocation,
    'request_foreman' : newrequest.request_foreman,
    'request_foreman_contact' : newrequest.request_foreman_contact
  });
 };

 this.saveWorkerTime = function(workertime){
   return $http.post("http://localhost/greenstaff/public/api/saveworkertime",{
    'action_worker_id' : workertime.action_worker_id,
    'action_id' : workertime.action_id,
    'action_start_time' : workertime.action_start_time,
    'action_finish_time' : workertime.action_finish_time,
    'action_break_time' : workertime.action_break_time,
    'action_total_time' : workertime.action_total_time
  });
 };

  this.addAgentSentRequest = function(worker_id, val_date, action_requested){
   return $http.post("http://localhost/greenstaff/public/api/agentsentrequest",{
    'action_worker_id' : worker_id,
    'action_date' : val_date,
    'action_requested' : action_requested
  });
 };

  this.addAgentAssign = function(worker_id, val_date, action_assigned){
   return $http.post("http://localhost/greenstaff/public/api/agentassign",{
    'action_worker_id' : worker_id,
    'action_date' : val_date,
    'action_assigned' : action_assigned
  });
 };


 this.saveRequest = function(newbook){
   return  $http.post("http://localhost/myapp/public/savebook",{
     'book_id': newbook.book_id,
     'book_name': newbook.book_name,
     'book_desc': newbook.book_desc  
   });
 };

 this.changeRequest = function(request_id){
     return  $http.post("http://localhost/greenstaff/public/api/requestchange",{
        'id' : request_id,
     });
   };

}]); 
