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
        <tr class="loaded" data-pk="{{$date->id}}">
            {{ writeDetailControlInCell('Carts on this date', $date->id) }}
            {{ writeDataFieldInCell('shopping_date', $date->shopping_date, $date->id)}}
            {{ writeDeleteButtonInCell() }}
        </tr>
        @endforeach
        <tr class='insertion_point'></tr>
        <tr>
            <td></td>
            {{ writeTextFieldInCell('shopping_date', 'New Shopping Date') }}
            {{ writeNewRecordControlsInCell('Add a new shopping date') }}
        </tr>
    </tbody>
</table>
</form>
