@extends('templates/pages')

@section('pageContent')

<div id="entry_form">
    <h3>Your requests for <a href="#" class="">{{$date ?: 'this week'}}</a></h3>
    <form id="entry_form" accept-charset="utf-8">
    <table class="table" id="user_table" style="width: 98%" >
        <thead>
            <tr>
                <th style="width:10%">Account</th>
                <th style="width:30%">Item</th>
                <th style="width:5%">Quantity</th>
                <th style="width:15%">Est. Price</th>
                <th style="width:15%">Est. Total</th>
                <th style="width:20%">Pick-Up Location(s)</th>
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

</div><!-- #entry_form -->

@stop
