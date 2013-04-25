<h3>Users</h3>
<form id="user_form" accept-charset="utf-8">
<table class="table" id="user_table" style="width: 98%" >
    <thead>
        <tr>
            <th></th>
            <th style="width: 30%">Name</th>
            <th style="width: 30%">Username</th>
            <th style="width: 5%">Homepage</th>
            <th style="width: 15%">Password</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr class="loaded" data-pk="{id}">
            <td>
                <a href="#" class="btn_expand" title="Items requested by this user" data-pk="{{$user->id}}">
                <i class="icon-chevron-down"></i></a>
            </td>
            <td><a href="" class="ed" data-name="nickname" data-pk="{{$user->id}}">
                {{$user->nickname ?: str_repeat('&nbsp;',20) }}</a></td>
            <td><a href="" class="ed" data-name="username" data-pk="{{$user->id}}">
                {{$user->username ?: str_repeat('&nbsp;',20) }}</a></td>
            <td><a href="" class="ed" data-name="homepage" data-pk="{{$user->id}}">
                {{$user->homepage?: str_repeat('&nbsp;',20) }}</a></td>
            <td>{{ Form::password('password', 
                array('class'=>'new fullWidth','placeholder'=>'Reset Password')) }}</td>
            <td>
                <a href="#" class="btn_del" title="Delete this record"><i class="icon-remove"></i></a>
            </td>

        </tr>
        @endforeach

        <tr class='insertion_point'></tr>
        <tr>
            <td></td>
            <td>{{ Form::text('nickname', Null, 
                array('class'=>'new fullWidth','placeholder'=>'New User')) }}</td>
            <td>{{ Form::text('username', Null, 
                array('class'=>'new fullWidth','placeholder'=>'Unique Username')) }}</td>
            <td>{{ Form::text('homepage', 'entry', array('class'=>'new hp')) }}</td>
            <td>{{ Form::password('password', array('class'=>'new fullWidth','placeholder'=>'Password')) }}</td>
            <td>
                <a href="#" class="btn_add" title="Add this new user"><i class="icon-ok"></i></a>
                <a href="#" class="btn_reset" title="Reset fields"><i class="icon-edit"></i></a>
            </td>
        </tr>
    </tbody>
</table>
</form>
