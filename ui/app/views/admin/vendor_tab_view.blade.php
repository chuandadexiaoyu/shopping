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
        <tr class="loaded" data-pk="{id}">
            <td>
                <a href="#" class="btn_expand" title="Items sold by this vendor" data-pk="{{$vendor->id}}">
                <i class="icon-chevron-down"></i></a>
            </td>
            <td>
                <a href="" class="ed" data-name="sku" data-pk="{{$vendor->id}}">
                    {{$vendor->name ?: str_repeat('&nbsp;',20) }}</a>
            </td>
            <td>
                <a href="#" class="btn_del" title="Delete this record"><i class="icon-remove"></i></a>
            </td>
        </tr>
        @endforeach
        <tr class='insertion_point'></tr>
        <tr>
            <td></td>
            <td>{{ Form::text('name',Null, array('class'=>'new fullWidth','placeholder'=>'New Vendor')) }}</td>
            <td>
                <a href="#" class="btn_add" title="Add a new vendor"><i class="icon-ok"></i></a>
                <a href="#" class="btn_reset" title="Reset fields"><i class="icon-edit"></i></a>
            </td>
        </tr>
    </tbody>
</table>
</form>
