@extends('templates/site')

@section('siteContent')
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <a class="brand" href="/">KDB Shopping</a>
    <ul class="nav">
        <li><a href="{{ URL::route('entry') }}">
            <i class="icon-pencil"></i> Entry</a></li>
        <li><a href="{{ URL::route('report') }}">
            <i class="icon-shopping-cart"></i> Report</a></li>
        @if( Auth::user()->username == 'admin')
            <li><a href="{{ URL::route('admin') }}">
                <i class="icon-wrench"></i> Administration</a></li>
        @endif
    </ul>
    <ul class="nav pull-right">
        <li><a href="{{ URL::route('logout') }}">
            <i class="icon-user"></i> Log Out {{ Auth::user()->nickname }}</a></li>
    </ul>
  </div>
</div>

<div class="container">
    <div class="row">
    <!-- Main column -->
    <div class="span12">
            <section>
                @if (Session::has('flash_error'))
                    <div class="alert alert-error">{{ Session::get('flash_error') }}</div>
                @endif
                @yield('pageContent')
            </section>
    </div><!-- main column -->
    </div><!-- row -->
    <footer id="bottom" class="footer float-bottom">
        <p>&copy;</p>
    </footer>
</div><!-- container -->

@stop
