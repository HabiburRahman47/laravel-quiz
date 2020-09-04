<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('core.dashboard.layout.partials.head')
</head>

<body class="c-app flex-row align-items-center">
@yield('content')

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