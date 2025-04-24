<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')

   <base href="{{ url('/') }}/">

   <link rel="stylesheet" href="{{ asset('css/style.css') }}">



  </head>
  <body>
    @include('admin.header')
    

    @include('admin.sidebar')
     
    @include('admin.body')

    @include('admin.footer')
  </body>
</html>