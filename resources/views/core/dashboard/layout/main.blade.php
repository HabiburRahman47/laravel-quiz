<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('core.dashboard.layout.partials.head')
</head>

<body class="c-app">

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    @include('core.dashboard.layout.shared.nav-builder')
</div>
<div class="c-wrapper">
    @include('core.dashboard.layout.shared.header')
    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
        @include('core.dashboard.layout.shared.footer')
    </div>
</div>

<!-- CoreUI and necessary plugins-->
<script src="{{ asset('core/dashboard/js/coreui.bundle.min.js') }}"></script>
<script src="{{ asset('core/dashboard/js/coreui-utils.js') }}"></script>
@yield('javascript')

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target=".header-top">
    <span class="icon fa fa-angle-up"></span>
</div>
</body>
</html>