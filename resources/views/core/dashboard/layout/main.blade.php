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
            <div class="container-fluid flash-message-container">
                @include('flash::message')
            </div>

            @yield('content')
        </main>
        @include('core.dashboard.layout.shared.footer')
    </div>
</div>

<!-- CoreUI and necessary plugins-->
<script src="{{ asset('core/dashboard/js/coreui.bundle.min.js') }}"></script>
<script src="{{ asset('core/dashboard/js/coreui-utils.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{--in page js--}}
@stack('javascript')

<script type="text/javascript">
    // $('#flash-overlay-modal').modal();
    var flashOverlayModal = document.getElementById('flash-overlay-modal');
    if (flashOverlayModal) {
        var myModal = new coreui.Modal(flashOverlayModal, {
            keyboard: false
        });
        myModal.show();
    }

    setTimeout(function () {
        dismissNonImportantAlerts();
    }, 3000);

    function dismissNonImportantAlerts() {
        console.log("dismissNonImportantAlerts");
        var alertList = document.querySelectorAll('.flash-message-container > .alert');
        alertList.forEach(function (alert) {
            console.log(alert.classList);
            if (!alert.classList.contains('alert-important')) {
                var nonImportantAlerts = new coreui.Alert(alert)
                nonImportantAlerts.close()
            }
        });
    }

    var tooltipElementList = document.querySelectorAll('[data-toggle="tooltip"]');
    tooltipElementList.forEach(function (tooltipElement) {
        var tooltip = new coreui.Tooltip(tooltipElement, {
            boundary: 'window'
        });
    });


</script>
<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target=".header-top">
    <span class="icon fa fa-angle-up"></span>
</div>
</body>
</html>