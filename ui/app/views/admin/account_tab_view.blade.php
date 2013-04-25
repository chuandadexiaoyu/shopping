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
        <tr class="loaded" data-pk="{id}">
            <td>
                <a href="#" class="btn_expand" title="Items charged to this account" data-pk="{{$account->number}}">
                <i class="icon-chevron-down"></i></a>
            </td>
            <td>
                <a href="" class="ed" data-name="number" data-pk="{{$account->number}}">
                    {{$account->number ?: str_repeat('&nbsp;',20) }}</a>
            </td>
            <td>
                <a href="" class="ed" data-name="name" data-pk="{{$account->number}}">
                    {{$account->name ?: str_repeat('&nbsp;',20) }}</a>
            </td>
            <td>
                <a href="#" class="btn_del" title="Delete this record"><i class="icon-remove"></i></a>
            </td>
        </tr>
        @endforeach

        <tr class='insertion_point'></tr>
        <tr>
            <td></td>
            <td>{{ Form::text('number',Null, array('class'=>'new fullWidth','placeholder'=>'New Account')) }}</td>
            <td>{{ Form::text('name',Null, array('class'=>'new fullWidth','placeholder'=>'Account Name')) }}</td>
            <td>
                <a href="#" class="btn_add" title="Add an account"><i class="icon-ok"></i></a>&nbsp; &nbsp;
                <a href="#" class="btn_reset" title="Reset fields"><i class="icon-edit"></i></a>
            </td>
        </tr>
    </tbody>
</table>
</form>

<script>
var account_template =
    '<tr class="loaded" data-pk="{id}">' +
            '<td><a href="#" class="ed" data-name="id" data-pk="{id}">{id}</a></td>' +
            '<td><a href="#" class="ed" data-name="name" data-pk="{id}">{name}</a></td>' +
            '<td><a href="#" class="btn_delete" title="Delete this record" data-pk="{id}"><i class="icon-remove"></i></td></tr>';
</script>