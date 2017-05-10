<html>
<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
<br><br>

<h3>Report company summary </h3>

Report date : from {{$start_date}} to {{$finish_date}}<br>
Worker name : All workers<br><br>

<div class="row">
<div class="col-md-6">
<table class="table table-condensed">
    <thead>
      <tr>
        <th></th>
        <th>Company name</th>
        <th>Worker count</th>
        <th>Worked hours</th>
      </tr>
    </thead>
    <tbody>

@foreach ($days as $day)
<tr>
<td>{{($loop->index) + 1}}</td>
<td>{{$day->name}} </td>
<td class="text-right">{{$day->aaa_worker_count}}</td>
<td class="text-right">{{$day->aaa_total_time}}</td>

</tr>
</tbody>
@endforeach
<tr>
<td colspan="2"> <b>Summary </b></td>
<td class="text-right"> <b>{{$days_workers}}</b>  worker(s)</td>
<td class="text-right"> <b>{{$days_summary}}</b>  hour(s)</td>
</tr>
</table>
</div>
</div>
 
</div>
</body>
</html>