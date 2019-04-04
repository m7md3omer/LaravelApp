<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}

        <title>{{ config('app.name', 'LaravelApp') }}</title>
    </head>
    <body>
      @include('inc.navbar')
      <div class="container" style="margin-top: 1em;">
        @include('inc.messages')
        @yield('content')
      </div>
      <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
      <script>
          CKEDITOR.replace( 'article-ckeditor' );
      </script>
       <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </body>
</html>
