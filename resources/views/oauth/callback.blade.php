<html>
<head>
  <meta charset="utf-8">
  <title>{{ config('app.name') }}</title>
  <script>
    window.opener.postMessage({ token: "{{ $token }}" , user: "{{$user}}", roles: "{{$roles}}"}, "{{ url('/test') }}");
    
    window.close()
  </script>
</head>
<body>
  {{$token}}
  {{$user}}
  {{$roles}}
</body>
</html>