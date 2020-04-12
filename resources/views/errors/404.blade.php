<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css')}}">
 
    <link rel="stylesheet" href="{{ asset('css/demo/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('images/Spectrum logo.png')}}" />
</head>

<body>
    <script src="{{ asset('js/preloader.js')}}"></script>
    <div class="body-wrapper">
        <div class="main-wrapper">
          <div class="page-wrapper full-page-wrapper">
            <main class="content-wrapper">
              <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                    <div class="mdc-card p-0">
                      <section class="error-header">
                        <h1 class="mdc-typography--display2 mb-0">404 !</h1>
                      </section>
                      <section class="error-info">
                        <p>Page not found</p>
                        <p class="mb-2">The requested URL /some_url was not found on this server.</p>
                      </section>
                    </div>
                  </div>
                </div>
              </div>
            </main>
          </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js')}}"></script>
</body>

</html>