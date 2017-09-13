<!DOCTYPE html>
<html>
<head>
  <title>{{__('Notification')}}</title>
  <meta http-equiv="refresh" content="5;{{ URL::previous() }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
</head>
<body>
  <div class="panel panel-info">
    <div class="panel-heading text-center">
      <h1>{{__('Welcome ')}} {{Auth::user()->username}} {{__('visit our website')}}</h1>
        <h2>{{__('Please wait....')}}</h2>
    </div>
  </div>
</body>
</html>