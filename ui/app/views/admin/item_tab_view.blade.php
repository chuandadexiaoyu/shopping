<h3>Items</h3>
<form id="item_form" accept-charset="utf-8">
<table class="table" id="item_table" style="width: 98%" >
    <thead>
        <tr>
            <th></th>
            <th style="width: 10%">SKU</th>
            <th style="width: 20%">Name</th>
            <th style="width: 65%">Details</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr class="loaded" data-pk="{{$item->id}}">
                {{ writeDetailControlInCell('Vendors for this item') }}
                {{ writeDataFieldInCell('sku', $item->sku, $item->id)}}
                {{ writeDataFieldInCell('name', $item->name, $item->id)}}
                {{ writeDataFieldInCell('details', $item->details, $item->id)}}
                {{ writeDeleteButtonInCell() }}
            </tr>
        @endforeach

        <tr class='insertion_point'></tr>
        
        <tr>
            <td></td>
            {{ writeTextFieldInCell('sku', 'New SKU') }}
            {{ writeTextFieldInCell('name', 'New Item') }}
            {{ writeTextFieldInCell('details', 'New Item Description') }}
            {{ writeNewRecordControlsInCell('Add a new item') }}
        </tr>
    </tbody>
</table>
</form>

