<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
Dear Juntos,
<br/>
<br/>
<p>
    A new user has just signed on to the database application, please assign an appropriate role and assign a respective site.
</p>
<br/>
<body>

<h4>User Information</h4>
<p>
<ul>
    <li>
        Date Created: {{$user->created_at->format("M-d-Y")}}
    </li>
    <li>
        Name: {{$user->name}}
    </li>
    <li>
        Email Address: {{$user->email}}
    </li>
</ul>

<br/>
<br/>


Thanks,
<br/>
<br/>
Juntos Database Application
<br/>
<br/>
<br/>
</p>
</body>
</html>
