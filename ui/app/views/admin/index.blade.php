@extends('templates/pages')

@section('pageContent')

<div id="admin_form">

<div class="tabbable"> <!-- Only required for left/right tabs -->
    <h2>Administration</h2>
    <ul class="nav nav-tabs">
        <li><a href="#tabDates" data-toggle="tab">Shopping Dates</a></li>
        <li><a href="#tabItems" data-toggle="tab">Items</a></li>
        <li><a href="#tabVendors" data-toggle="tab">Vendors</a></li>
        <li><a href="#tabAccounts" data-toggle="tab">Accounts</a></li>
        <li><a href="#tabUsers" data-toggle="tab">Users</a></li>
        <li><a href="#tabAdmin" data-toggle="tab">Admin</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="tabDates">
            @include('admin/date_tab_view')
        </div><!-- tabDates -->


        <div class="tab-pane" id="tabAdmin">
            <h3>Admin</h3>
            <p>This section is for other administrative tasks.</p>
        </div><!-- tabAdmin -->

        <div class="tab-pane" id="tabItems">
            @include('admin/item_tab_view')
        </div><!-- tabItems -->

        <div class="tab-pane" id="tabVendors">
            @include('admin/vendor_tab_view')
        </div><!-- tabVendors -->

        <div class="tab-pane" id="tabAccounts">
            @include('admin/account_tab_view')
        </div><!-- tabAccounts -->

        <div class="tab-pane" id="tabUsers">
            @include('admin/user_tab_view')
        </div><!-- tabUsers -->

    </div><!-- tab-content -->
</div><!-- tabbable -->

</div><!-- admin_form -->

@stop