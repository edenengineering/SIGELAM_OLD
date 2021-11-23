<!DOCTYPE html>
<html id="ht" lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GELAM - Application</title>
        <link rel="shortcut icon" type="image/png" href="{{ URL::asset('favicon.png') }}"/>
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
        <link href="{{ URL::asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" >
        <link rel="stylesheet" href="{{ URL::asset('css/alertify.min.css') }}"/>
        
        <link rel="stylesheet" href="{{ URL::asset('css/themes/default.min.css') }}"/>

        <link rel="stylesheet" href="{{ URL::asset('css/themes/semantic.min.css') }}"/>
        <link rel="stylesheet" href="{{ URL::asset('css/alertify.rtl.css') }}"/>

        <link rel="stylesheet" href="{{ URL::asset('css/themes/default.rtl.min.css') }}"/>

        <link rel="stylesheet" href="{{ URL::asset('css/themes/semantic.rtl.min.css') }}"/>
        <link rel="stylesheet" href="{{ URL::asset('css/themes/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ URL::asset('css/themes/bootstrap.rtl.min.css') }}"/>
         <link rel="stylesheet" href="{{ URL::asset('css/dataTables.checkboxes.css') }}"/>
         <link rel="stylesheet" href="{{ URL::asset('css/dataTables.min.css') }}"/>
         <link rel="stylesheet" href="{{ URL::asset('css/buttons.dataTables.min.css') }}"/>
         <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-select.css') }}"/>
        @yield('style_sidebar')
    </head>
    <body style="@yield('scroll')"  >
       @yield('en-tete')
       @yield('menu')   

       @yield('Slider')
       
        <footer @yield('style_footer') >
            <div class="container">
                <div class="row">
                    
                    <div class="col-sm-4 col-sm-offset-4">
                        <div class="footer-block text-center">
                            <p class="copyright">
                                © 2017 GELAM,EDEN Software Engeneering.<br/>All rights reserved.
                            </p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </footer >

     <script src="{{ URL::asset('js/jquery.min.js') }}" ></script> 
     <script src="{{ URL::asset('js/table-renderer.js') }}" ></script>  
      <script src="{{ URL::asset('js/alertify.min.js') }}" ></script> 
     <script src="{{ URL::asset('js/typeahead.bundle.min.js') }}" ></script>     
      <script src="{{ URL::asset('js/dataTables.min.js') }}" ></script>   
     <script src="{{ URL::asset('js/buttons.dataTables.min.js') }}" ></script>  
     <script src="{{ URL::asset('js/buttons.flash.min.js') }}" ></script> 
     <script src="{{ URL::asset('js/jszip.min.js') }}" ></script> 
     <script src="{{ URL::asset('js/vfs_fonts.js') }}" ></script>  
     <script src="{{ URL::asset('js/buttons.html5.min.js') }}" ></script>
     <script src="{{ URL::asset('js/buttons.print.min.js') }}" ></script> 
     <script src="{{ URL::asset('js/jquery.sticky.js') }}" ></script>
     <script src="{{ URL::asset('js/blockUI.js') }}" ></script>  
       <script src="{{ URL::asset('js/bootstrap.min.js') }}" ></script>
       <script src="{{ URL::asset('js/bootstrap-select.js') }}" ></script>
       <script src="{{ URL::asset('js/fnFilterClear.js') }}" ></script>
    @yield('sc')
    
    </body>
</html>
