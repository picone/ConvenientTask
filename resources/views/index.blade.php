<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>放心接</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app"></div>
    <script>
        @if($user)
            window['user']={uid:{{ $user->id }},username:'{{ $user->username }}'};
        @else
            window['user']={uid:0,username:''};
        @endif
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
