
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
    @yield('title')
  </title>
  <!-- favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}panel/assets/img/logo/favicon.png" />

  <!-- swiper css -->
  <link rel="stylesheet" href="{{ asset('/') }}panel/assets/plugin/swiperjs/swiper-bundle.min.css" />

  <!-- icon  -->
  <script src="{{ asset('/') }}panel/assets/plugin/iconify/iconify-icon.min.js"></script>

  <!-- bootstrap -->
  <link rel="stylesheet" href="{{ asset('/') }}panel/assets/css/fontawesome-all.min.css" />
  <!-- font awsome -->

  <link rel="stylesheet" href="{{ asset('/') }}panel/assets/plugin/select-two/select2.min.css" />

  <link rel="stylesheet" href="{{ asset('/') }}panel/assets/plugin/summernote/summernote.min.css" />

  <link rel="stylesheet" href="{{ asset('/') }}panel/assets/plugin/bootstrap/css/bootstrap.min.css" />


  <!-- css -->
  <link rel="stylesheet" href="{{ asset('/') }}panel/assets/css/main.css" />

  {{-- toastr --}}
  <!-- jquery  -->
  <script src="{{ asset('/') }}panel/assets/plugin/jquery/jquery-3.7.1.min.js"></script>
  <link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- line awesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"/>

    {{-- sweet alert 2 cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">
    </script>

    {{-- data table css --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">
</head>

<body>
  <!-- preloader -->
  <div id="loading">
    <div id="loading-center">
      <div id="loading-center-absolute">
        <span class="loader"></span>
      </div>
    </div>
  </div>
  <!-- / preloader -->

  <main class="main">
    @include('panel.partials.sidebar')

    <!-- /side bar  -->

   {{-- maint content start --}}
   @yield('content')
   {{-- maint content end --}}
  </main>



  <!-- bootstrap -->
  <script src="{{ asset('/') }}panel/assets/plugin/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="{{ asset('/') }}panel/assets/plugin/summernote/summernote.min.js"></script>

  <script src="{{ asset('/') }}panel/assets/plugin/select-two/select2.min.js"></script>

  <!-- js  -->
  <script src="{{ asset('/') }}panel/assets/js/script.js"></script>

  {{-- ck editor cdn --}}


  {{-- toastr start --}}
  <script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>
  {{-- toastr end --}}

  {{-- sweet alert start --}}
  <script>
    function confirmation(ev)
    {

        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');

            swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this  file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.location.href=urlToRedirect;
            }
            });


    }
</script>

  {{-- sweet alert end --}}

  {{-- data table start --}}

<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
  <script>
    new DataTable('#example', {
responsive: true
});
</script>
  {{-- data table end --}}


  {{-- ajax setup --}}
  <script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  </script>
  {{-- ajax setup end --}}
</body>

</html>
