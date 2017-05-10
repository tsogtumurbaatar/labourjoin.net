app.controller("myJobsController", function($scope, jobService, requestService, $timeout){

    $scope.statusval = 'adding';
    $scope.itemsPerPageVal = 10;
    getJobsCont();

// ------------------------------------
 $scope.newjob = {
    jobs_name: '',
    jobs_desc: '',
    jobs_start_date: new Date(),
    jobs_finish_date: new Date(),
    jobs_location:'Input your location' 
  };


   $scope.today = function() {
    $scope.newjob.jobs_start_date = new Date();
  };
  $scope.today();

  $scope.clear = function() {
    $scope.newjob.jobs_start_date = null;
  };

  $scope.inlineOptions = {
    customClass: getDayClass,
    minDate: new Date(),
    showWeeks: true
  };

  $scope.dateOptions = {
    dateDisabled: disabled,
    formatYear: 'yy',
    maxDate: new Date(2020, 5, 22),
    minDate: new Date(),
    startingDay: 1
  };

  // Disable weekend selection
  function disabled(data) {
    var date = data.date,
      mode = data.mode;
    return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
  }

  $scope.toggleMin = function() {
    $scope.inlineOptions.minDate = $scope.inlineOptions.minDate ? null : new Date();
    $scope.dateOptions.minDate = $scope.inlineOptions.minDate;
  };

  $scope.toggleMin();

  $scope.open1 = function() {
    $scope.popup1.opened = true;
  };

  $scope.open2 = function() {
    $scope.popup2.opened = true;
  };

  $scope.setDate = function(year, month, day) {
    $scope.newjob.jobs_start_date = new Date(year, month, day);
  };

  $scope.formats = ['yyyy-MM-dd', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
  $scope.format = $scope.formats[0];
  $scope.altInputFormats = ['M!/d!/yyyy'];

  $scope.popup1 = {
    opened: false
  };

  $scope.popup2 = {
    opened: false
  };

  var tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  var afterTomorrow = new Date();
  afterTomorrow.setDate(tomorrow.getDate() + 1);
  $scope.events = [
    {
      date: tomorrow,
      status: 'full'
    },
    {
      date: afterTomorrow,
      status: 'partially'
    }
  ];

  function getDayClass(data) {
    var date = data.date,
      mode = data.mode;
    if (mode === 'day') {
      var dayToCheck = new Date(date).setHours(0,0,0,0);

      for (var i = 0; i < $scope.events.length; i++) {
        var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

        if (dayToCheck === currentDay) {
          return $scope.events[i].status;
        }
      }
    }

    return '';
  }
// ---------------------------------------

    $scope.createRequestCont = function(job)
    {
      $scope.newlocation = job.jobs_location;
      $scope.request_job_id = job.jobs_id;
      $scope.statusval = '';
    } 

    function getJobsCont() {
      jobService.listJobs()
      .then(function (response) {
        $scope.jobs = response.data;
      }, function (error) {
        $scope.status = 'Unable to load customer data: ' + error.message;
      });
    }

    $scope.deleteJobCont = function(job){
      var result = confirm("Are you sure delete this record?");
      if (result) {
       jobService.removeJob(job)
       .then(function(response){ 
        var index=$scope.jobs.indexOf(job)
        $scope.jobs.splice(index,1);
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

   $scope.insertRequestCont = function() {
     requestService.addRequest($scope.newrequest, $scope.newlocation, $scope.request_job_id)
     .then(function(response){ 
       $scope.statusval = 'success_newrequest';
       $timeout(function() {
       getJobsCont();
    }, 1000);
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

   $scope.refreshContentJobsCont = function()
  {
     $timeout(function() {
       getJobsCont();
    }, 1000);
  }

});