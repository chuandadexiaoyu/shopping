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
        <tr class="loaded" data-pk="{{$user->id}}">
            {{ writeDetailControlInCell('Items requested by this user') }}
            {{ writeDataFieldInCell('nickname', $user->nickname, $user->id)}}
            {{ writeDataFieldInCell('username', $user->username, $user->id)}}
            {{ writeDataFieldInCell('homepage', $user->homepage, $user->id)}}
            <td>{{ Form::password('password', 
                array('class'=>'new fullWidth','placeholder'=>'Reset Password')) }}</td>
            {{ writeDeleteButtonInCell() }}
        </tr>
        @endforeach

        <tr class='insertion_point'></tr>

        <tr>
            <td></td>
            {{ writeTextFieldInCell('nickname', 'New User') }}
            {{ writeTextFieldInCell('username', 'Unique Username') }}
            <td>{{ Form::text('homepage', 'entry', array('class'=>'new hp')) }}</td>
            <td>{{ Form::password('password', array('class'=>'new fullWidth','placeholder'=>'Password')) }}</td>
            {{ writeNewRecordControlsInCell('Add a new user') }}
        </tr>
    </tbody>
</table>
</form>
