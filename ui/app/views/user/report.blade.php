@extends('templates/pages')

@section('pageContent')

<div id="report_form">
    <h3>Shopping list for <a href="#" class="">{{$date ?: 'this week'}}</a></h3>
    <form id="report_form" accept-charset="utf-8">
    <table class="table" id="report_table" style="width: 98%" >
        <thead>
            <tr>
                <th style="width:20%">Item</th>
                <th style="width:40%">Description</th>
                <th style="width:15%">For</th>
                <th style="width:5%">Quantity</th>
                <th style="width:10%">Est. Price</th>
                <th style="width:10%">Est. Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr class='insertion_point'></tr>
            <tr>
                <td>
                    <a href="#" class="btn_add" title="Add this new user"><i class="icon-ok"></i></a>
                    <a href="#" class="btn_reset" title="Reset fields"><i class="icon-edit"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
    </form>


</div><!-- #report_form -->

@stop
