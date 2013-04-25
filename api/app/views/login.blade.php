<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Please log in</title>
</head>
<body>
    <h1>Please log in</h1>

    <!-- check for login error flash var -->
    @if (Session::has('flash_error'))
        <div id="flash_error">{{ Session::get('flash_error') }}</div>
    @endif


    {{ Form::open(array('login')) }}
    <ul>
        <li>
            {{ Form::label('username', 'Username:') }}
            {{ Form::input('username', 'username') }}            
        </li>
        <li>
            {{ Form::label('password', 'Password:') }}
            {{ Form::password('password') }}            
        </li>
        <li>
            {{ Form::submit('log in') }}
        </li>
    </ul>
    {{ Form::close() }}
</body>
</html>