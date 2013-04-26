<h3>Accounts</h3>

<form id="account_form" accept-charset="utf-8">
<table class="table" id="account_table" style="width: 98%" >
    <thead>
        <tr>
            <th></th>
            <th style="width: 10%">Number</th>
            <th style="width: 80%">Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accounts as $account)
        <tr class="loaded" data-pk="{{$account->number}}">
            {{ writeDetailControlInCell('Items charged to this account') }}
            {{ writeDataFieldInCell('number', $account->number, $account->number)}}
            {{ writeDataFieldInCell('name', $account->name, $account->number)}}
            {{ writeDeleteButtonInCell() }}
        </tr>
        @endforeach

        <tr class='insertion_point'></tr>
        <tr>
            <td></td>
            {{ writeTextFieldInCell('number', 'New Account') }}
            {{ writeTextFieldInCell('name', 'Account Name') }}
            {{ writeNewRecordControlsInCell('Add a new account') }}
        </tr>
    </tbody>
</table>
</form>
