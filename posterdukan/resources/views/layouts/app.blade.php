<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <title>Posterdukan Admin</title>
    @include('layouts.stylesheet')
    @yield('customcss')
  </head>
  <body>
    <div class="container-scroller">
           <!-- partial:partials/_sidebar.html -->
           @include('layouts.sidebar')
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                  <!-- partial:partials/_navbar.html -->
                  @include('layouts.navbar')
                  <!-- partial -->
                  <div class="main-panel">
                  @yield('content')
                  </div>
                  <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @include('layouts.footer')
            <!-- partial -->
            </div>
                  <!-- main-panel ends -->
                  <!-- </div> -->
                  <!-- page-body-wrapper ends -->
    </div>
    @include('layouts.javascript')
    @yield('customjs')
    </body>
</html>