<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name') }} | @yield('title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/vendors/feather/feather.css">
  <link rel="stylesheet" href="/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
  @notifyCss
  <!-- endinject -->



  
  <!-- inject:css -->
  <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/images/gpos_logo_mini.png" />
</head>
<body>
  <div class="container-scroller"> 
    @include('partials.header')
    @include('partials.sidebar')
    
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-sm-12">
                  <div class="home-tab">
                    @yield('container')
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        {{-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
            </div>
          </footer> --}}
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    

    <!-- plugins:js -->
    <script src="/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/vendors/chart.js/Chart.min.js"></script>
    <script src="/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/vendors/progressbar.js/progressbar.min.js"></script>
  
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/js/off-canvas.js"></script>
    <script src="/js/hoverable-collapse.js"></script>
    <script src="/js/template.js"></script>
    <script src="/js/settings.js"></script>
    <script src="/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/js/dashboard.js"></script>
    <script src="/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
    <!-- Validator JS -->
    @notifyJs

    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.8.0/validator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.8.0/validator.js"></script>
    @stack('scripts')
  </body>
  
  </html>