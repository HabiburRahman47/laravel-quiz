<!DOCTYPE html>
<html lang="en">
  <head>
    <title>StrapSwitch</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('core/site/images/Group.ico') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('core/site/vendor/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('core/site/vendor/css/style.css') }}">
    <script src="{{ asset('core/site/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('core/site/vendor/jquery/popper.min.js') }}"></script>
    <script src="{{ asset('core/site/vendor/jquery/bootstrap.min.js') }}"></script>
    <style>
        p{
          padding: 20px 0px 20px 24px;
        }
        footer {
      background-color: #f2f2f2;
      padding: 25px;
    }

    .carousel-inner img {
      width: 100%; /* Set width to 100% */
      min-height: 200px;
    }

    /* Hide the carousel text when the screen is less than 600 pixels wide */
    @media (max-width: 600px) {
      .carousel-caption {
        display: none; 
      }
    }
    </style>
  </head>
  <body>

    @yield('content')

    @stack('javascript')

  </body>
</html>
