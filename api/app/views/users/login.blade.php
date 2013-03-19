<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Please Log In</title>
</head>
<body>
    <h1>Please log in</h1>
    {{ Form::open(array('method' => 'POST')) }}
    {{ Form::token() }}

    <p>
        {{ Form::text('username', Input::old('username'), 
            array(
                "autofocus"=>"True", 
                'placeholder'=>'Username',
                'class' => 'fullwidth'
            )) }}
    </p>
    <p>
        {{ Form::password('password', 
            array(
                'placeholder'=>'Password',
                'class'=>'fullwidth'
            )) }}
    </p>

    @if(Session::has('message'))
        <p id="message">{{ Session::get('message') }}</p>
    @endif

    <p>{{ Form::submit('Login', array('class'=>'btn btn-primary pull-right'))}}</p>

    {{ Form::close() }}

</body>
</html>
