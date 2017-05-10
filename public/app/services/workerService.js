app.service('workerService', ['$http', function($http){

    this.listWorkers = function(){
      return $http.get("http://localhost/greenstaff/public/api/workers");
    };

    this.listWorkersForAgent= function(val_date){
       
      return $http.post("http://localhost/greenstaff/public/api/workersforagent",{
            'id': val_date
        });
    };
    

    this.removeWorker = function(worker){
      return $http.post("http://localhost/greenstaff/public/api/workersdelete",{
        'id': worker.id
      });
    };

    this.addWorker = function(newworker){
     return $http.post("http://localhost/greenstaff/public/api/workers",{
        'name' : newworker.name,
        'worker_lname' : newworker.worker_lname,
        'email' : newworker.email,
        'password' : newworker.password,
        'address' : newworker.address,
        'phone1' : newworker.phone1,
        'phone2' : newworker.phone2,
        'user_info' : newworker.user_info,
            
 });
   };

   this.saveWorker = function(newworker){
     return  $http.post("http://localhost/greenstaff/public/api/workersput",{
        'id' : newworker.id,
        'name' : newworker.name,
        'worker_lname' : newworker.worker_lname,
        'email' : newworker.email,
        'password' : newworker.password,
        'address' : newworker.address,
        'phone1' : newworker.phone1,
        'phone2' : newworker.phone2,
        'user_info' : newworker.user_info,
     });
   };

    this.changeWorker = function(newworker){
     return  $http.post("http://localhost/greenstaff/public/api/workerschange",{
        'id' : newworker.id,
     });
   };
 
 }]);