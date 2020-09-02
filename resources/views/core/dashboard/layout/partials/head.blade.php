<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

{{--{!! MetaTag::tag('robots') !!}--}}
<!-- Place favicon.ico in the root directory -->
<link rel="shortcut icon" type="image/png" href="{!! asset('/site/minified/ico/favicon.png') !!}">
<link rel="apple-touch-icon" type="image/png" href="{!! asset('/site/minified/ico/favicon.png') !!}">
<link rel="apple-touch-icon" type="image/png"
      href="{!! asset('/site/minified/ico/apple-touch-icon-57-precomposed.png') !!}" size="57x57">
<link rel="apple-touch-icon" type="image/png"
      href="{!! asset('/site/minified/ico/apple-touch-icon-72-precomposed.png') !!}" size="72x72">
<link rel="apple-touch-icon" type="image/png"
      href="{!! asset('/site/minified/ico/apple-touch-icon-114-precomposed.png') !!}" size="114x114">
<link rel="apple-touch-icon" type="image/png"
      href="{!! asset('/site/minified/ico/apple-touch-icon-144-precomposed.png') !!}" size="144x144">


<link href="{{ asset('core/dashboard/css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
<link href="{{ asset('core/dashboard/css/flag-icon.min.css') }}" rel="stylesheet"> <!-- icons -->
<!-- Main styles for this application-->
<link href="{{ asset('core/dashboard/css/style.css') }}" rel="stylesheet">

@yield('css')

<link href="{{ asset('core/dashboard/css/coreui-chartjs.css') }}" rel="stylesheet">