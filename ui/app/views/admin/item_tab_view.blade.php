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
        <tr class="loaded" data-pk="{id}">
            <td>
                <a href="#" class="btn_expand" title="Vendors for this item" data-pk="{{$item->id}}">
                <i class="icon-chevron-down"></i></a>
            </td>
            <td>
                <a href="" class="ed" data-name="sku" data-pk="{{$item->id}}">
                    {{$item->sku ?: str_repeat('&nbsp;',20) }}</a>
            </td>
            <td>
                <a href="" class="ed" data-name="name" data-pk="{{$item->id}}">
                    {{$item->name ?: str_repeat('&nbsp;',20) }}</a>
            </td>
            <td>
                <a href="" class="ed" data-name="details" data-pk="{{$item->id}}">
                    {{$item->details ?: str_repeat('&nbsp;',20) }}</a>
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
                {{ Form::text('sku',Null, 
                    array('class'=>'new fullWidth','placeholder'=>'New SKU')) }}
            </td>
            <td>
                {{ Form::text('name',Null, 
                    array('class'=>'new fullWidth','placeholder'=>'New Item')) }}
            </td>
            <td>
                {{ Form::text('details',Null, 
                    array('class'=>'new fullWidth','placeholder'=>'New Item Description')) }}
            </td>
            <td>
                <a href="#" class="btn_add" title="Add an account"><i class="icon-ok"></i></a>
                <a href="#" class="btn_reset" title="Reset fields"><i class="icon-edit"></i></a>
            </td>
        </tr>
    </tbody>
</table>
</form>

