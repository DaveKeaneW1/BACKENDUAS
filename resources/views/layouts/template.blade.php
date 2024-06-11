<!DOCTYPE html>
<html lang="zxx" class="no-js">
@include('layouts.head')

<body>

    @if (!request()->is('admin/login*'))
        @include('layouts.menu')
    @endif
    
    @yield('content')

    @if (!request()->is('admin/login*'))
        @include('layouts.footer')
    @endif

    <script src="/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="/js/vendor/bootstrap.min.js"></script>
    <script src="/js/jquery.ajaxchimp.min.js"></script>
    {{-- <script src="/js/jquery.nice-select.min.js"></script> --}}
    <script src="/js/jquery.sticky.js"></script>
    <script src="/js/nouislider.min.js"></script>
    {{-- <script src="/js/countdown.js"></script> --}}
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="/js/gmaps.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/Source/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        toastr.options = {
            closeButton: true, // Show close button
            timeOut: 0, // Set timeOut to 0 to make it sticky until user closes it
            extendedTimeOut: 0 // Set extendedTimeOut to 0 to make it sticky until user closes it
        };

        function showToast(message, type) {
            if (type === "info") {
                toastr.info(message);
            } else if (type === "success") {
                toastr.success(message);
            } else if (type === "error") {
                toastr.error(message);
            } else if (type === "warning") {
                toastr.warning(message);
            }
        }
    </script>

    @if (session('success'))
        <script type="text/javascript">
            showToast(
                "{{ session('success') }}",
                "success"
            );
        </script>
    @endif

    @if (session('error'))
        <script type="text/javascript">
            showToast(
                "{{ session('error') }}",
                "error"
            );
        </script>
    @endif

</body>

</html>
