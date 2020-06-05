<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spectrum Books</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/material.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.material.min.css') }}">
    <!-- plugins:css -->

    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('css/demo/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('images/Spectrum logo.png')}}" />


    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js')}}"></script>

    <style>
        table {
            width: 100%;
        }

    </style>
</head>

<body>
    <script src="{{ asset('js/preloader.js')}}"></script>
    <div class="body-wrapper" id="app">
        @if(Session::has('success'))
        <flash-success message="{{ Session::get('success') }} "></flash-success>
        @endif
        <!-- partial -->



        <!-- dashboard -->

        <div class="page-wrapper mdc-toolbar-fixed-adjust">
            <!-- Sidebar -->
            <vue-progress-bar></vue-progress-bar>
            @include('layouts.partials.sidebar')
            <div class="main-wrapper mdc-drawer-app-content">
                <!-- Header -->
                @include('layouts.partials.header')

                <!-- Page Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js')}}"></script>

    <script src="{{ asset('js/material.js')}}"></script>
    <script src="{{ asset('js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js')}}"></script>
   <!-- End custom js for this page-->
 <script src="{{ asset('js/dataTables.min.js') }}"></script>
 <script src="{{ asset('js/dataTables.material.min.js') }}"></script>

<script>
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        // Specify file name
        filename = filename ? filename + '.xls' : 'excel_data.xls';

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();

            location.reload();
        }
    }

    $(document).ready(function() {
        $("button input").click(function() {
            if ($(this).attr('type') == "submit") {
                $(this).attr('disabled', 'disabled');
                $('form').not('#logout-form').submit();
            }
        });


        // $('table').DataTable({
        //     columnDefs: [{
        //         targets: [0, 1, 2]
        //         , className: 'mdl-data-table__cell--non-numeric'
        //     }]
        // });

        const urlsEqual = (urlProp1, urlProp2) => {
          const urls = new URL(urlProp1);
          if(urlProp2.includes(urls.pathname)) {
            return true;
          }
          return false;
        }
        const urls = [
          '/admin/licenses/used-licenses',
          '/admin/licenses/edit-license',
          '/admin/dashboard'
        ];
         
        if(!urlsEqual(window.location, urls)) {
          $('table').DataTable({
              columnDefs: [{
                  targets: [0, 1, 2]
                  , className: 'mdl-data-table__cell--non-numeric'
              }]
          });
        }

        


        $('.export_btn').click(function() {

            var filename = $(this).attr('title');
            var table_id = $('table').attr('id');

            exportTableToExcel(table_id, filename);
        });
    });
</script>

</body>

</html>
