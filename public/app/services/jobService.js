app.service('jobService', ['$http', function($http){

    this.listJobs = function(){
      return $http.get("http://localhost/greenstaff/public/api/jobs");
    };

    this.removeJob = function(job){
      return $http.post("http://localhost/greenstaff/public/api/jobsdelete",{
        'jobs_id': job.jobs_id
      });
    };

function myFormatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

    this.addJob = function(newjob){
      window.alert(newjob.jobs_start_date);
     return $http.post("http://localhost/greenstaff/public/api/jobs",{
       'jobs_name' : newjob.jobs_name,
       'jobs_desc' : newjob.jobs_desc,
       'jobs_start_date' : myFormatDate(newjob.jobs_start_date),
       'jobs_finish_date' : myFormatDate(newjob.jobs_finish_date),
       'jobs_location' : newjob.jobs_location
 });
   };

   this.saveWorker = function(newbook){
     return  $http.post("http://localhost/myapp/public/savebook",{
       'book_id': newbook.book_id,
       'book_name': newbook.book_name,
       'book_desc': newbook.book_desc  
     });
   };
 }]); 
