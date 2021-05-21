<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Juntos Database Logout</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/') }}/favicon.ico">
    <link rel="icon" type="image/x-icon" href="{{ asset('/') }}/favicon.ico">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="{{asset('/css/dashboard.css')}}" rel="stylesheet" />
</head>
<body>
    <div class="jumbotron-white jumbotron-fluid" style="padding-bottom: 750px; margin-top:150px;">
        <div class="container">
            <h1 class="display-4" style="color:#CC0000">YOU HAVE LOGGED OUT THE JUNTOS DATABASE APPLICATION</h1>
            <p class="lead" style="color: #000000; text-align: center">
            <br/>
            <br/>
            <h3>YOU WILL BE LOGGED OUT OF GOOGLE IN 10 SECONDS.</h3>
                <br/>
                <br/>
                <h3>Please close your browser to complete the logout process.</h3>
                <br/>
                <meta http-equiv="refresh" content="10;url=https://accounts.google.com/Logout" />
                <iframe src="https://shib.ncsu.edu/idp/profile/Logout" style="display:none" title="IDP Logout">
                </iframe>
        </div>
    </div>
</body>
</html>


