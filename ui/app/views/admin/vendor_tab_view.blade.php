<h3>Vendors</h3>
<form id="vendor_form" accept-charset="utf-8">
<table class="table" id="vendor_table" style="width: 98%" >
    <thead>
        <tr>
            <th></th>
            <th style="width: 95%">Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vendors as $vendor)
        <tr class="loaded" data-pk="{{$vendor->id}}">
            {{ writeDetailControlInCell('Items sold by this vendor') }}
            {{ writeDataFieldInCell('name', $vendor->name, $vendor->id)}}
            {{ writeDeleteButtonInCell() }}
        </tr>
        @endforeach
        <tr class='insertion_point'></tr>
        <tr>
            <td></td>
            {{ writeTextFieldInCell('name', 'New Vendor') }}
            {{ writeNewRecordControlsInCell('Add a new vendor') }}
        </tr>
    </tbody>
</table>
</form>
