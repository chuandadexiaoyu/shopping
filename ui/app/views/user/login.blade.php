@extends('templates/site')

@section('siteContent')
<div id="login_dialog" class="modal show" role="dialog">
    <div class="modal-header">
        <h3>Please Log In</h3>
        <p>Please log in using your credentials</p>
    </div>

    <div class="modal-body">
        {{-- check for login error flash var --}}
        @if (Session::has('flash_error'))
            <div class="alert alert-error">{{ Session::get('flash_error') }}</div>
        @endif

        {{ Form::open(array('login')) }}
        <ul>
            <li>
                {{ Form::label('username', 'Username:') }}
                {{ Form::text('username', Null, 
                    array('placeholder'=>'Username', 'class'=>'fullWidth')) }}            
            </li>
            <li>
                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', 
                    array('placeholder'=>'Password', 'class'=>'fullWidth')) }}            
            </li>

            <li>
                {{ Form::submit('log in', array('class'=>'btn btn-primary')) }}
            </li>
        </ul>
        {{ Form::close() }}
    </div>

    <div class="modal-footer">
    </div>

</div><!-- #login_dialog -->

<script>
$(function(){
    $('#username').select();
});
</script>
@stop

