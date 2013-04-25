<h3>Shopping Dates</h3>
<form id="dates_form" accept-charset="utf-8">
<table class="table" id="dates_table" style="width: 98%" >
    <thead>
        <tr>
            <th></th>
            <th style="width: 95%">Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dates as $date)
        <tr class="loaded" data-pk="{id}">
            <td>
                <a href="#" class="btn_expand" title="Carts on this date" data-pk="{{$date->id}}">
                <i class="icon-chevron-down"></i></a>
            </td>
            <td>
                <a href="" class="ed" data-name="shopping_date" data-pk="{{$date->id}}">
                    {{$date->shopping_date ?: str_repeat('&nbsp;',20) }}</a>
            </td>
            <td>
                <a href="#" class="btn_del" title="Delete this record"><i class="icon-remove"></i></a>
            </td>
        </tr>
        @endforeach
        <tr class='insertion_point'></tr>
        <tr>
            <td></td>
            <td>
                {{ Form::text('name',Null, 
                    array('class'=>'new fullWidth','placeholder'=>'New Shopping Date')) }}</td>
            <td>
                <a href="#" class="btn_add" title="Add a new shopping date"><i class="icon-ok"></i></a>
                <a href="#" class="btn_reset" title="Reset fields"><i class="icon-edit"></i></a>
            </td>
        </tr>
    </tbody>
</table>
</form>
