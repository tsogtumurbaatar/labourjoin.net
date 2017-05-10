  <script src="js/core.min.js"></script>
  <script src="js/script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  <script src="http://www.labourjoin.net/js/dirPagination.js"></script>
  <script src="http://www.labourjoin.net/js/ui-bootstrap-tpls-2.4.0.js"></script>
  

  <script type="text/javascript">
    var app = angular.module("myApp",['angularUtils.directives.dirPagination','ui.bootstrap']);
  </script>
  {{-- Controllers --}}
  <script src="app/controllers/workerController.js"></script>
  <script src="app/controllers/companyController.js"></script>
  <script src="app/controllers/jobsController.js"></script>
  <script src="app/controllers/requestController.js"></script>
  <script src="app/controllers/requestControllerFinished.js"></script>
  <script src="app/controllers/homeController.js"></script>


  {{-- Services --}}
  <script src="app/services/workerService.js"></script>
  <script src="app/services/companyService.js"></script>
  <script src="app/services/jobService.js"></script>
  <script src="app/services/requestService.js"></script>

  {{-- Date range picker --}}
  <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script> 
  <script>
    $(function() {
     $('input[name="start_date"]').daterangepicker(
     {
       singleDatePicker: true,
       showDropdowns: true,
       locale: {
        format: 'YYYY-MM-DD'
      }
    });
   });

  $(function() {
     $('input[name="finish_date"]').daterangepicker(
     {
       singleDatePicker: true,
       showDropdowns: true,
       locale: {
        format: 'YYYY-MM-DD'
      }
    });
   });

 </script>

