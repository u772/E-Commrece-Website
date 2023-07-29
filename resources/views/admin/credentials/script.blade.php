<script src="{{ asset('admin') }}/assets/js/bootstrap.js"></script>
<script src="{{ asset('admin') }}/assets/js/app.js"></script>

<!-- Need: Apexcharts -->
<script src="{{ asset('admin') }}/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('admin') }}/assets/js/pages/dashboard.js"></script>




<script>
    @if (Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>
