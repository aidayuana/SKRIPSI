<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link href="{{ asset('vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/izitoast/css/iziToast.min.css') }}">
    @stack('cssLibrary')
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-override.min.css') }}">
    <link rel="stylesheet" id="theme-color" href="{{ asset('assets/css/dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loading.css') }}">
    @stack('css')
</head>
<body>
    <div id="app">
        <div class="shadow-header"></div>
        @include('layouts.header')
        @include('layouts.sidebar')
        <div class="modal fade" id="modal_action" tabindex="-1" aria-labelledby="largeModalLabel" aria-hidden="true"></div>
        {{ $slot }}
        @include('layouts.settings')
        <footer>
            Copyright © 2022 &nbsp; <a href="https://www.youtube.com/c/mulaidarinull" target="_blank" class="ml-1"></a> <span>. All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle"></div>
        <div class="preloader" style="visibility:hidden;">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @stack('jsLibrary')
    <script src="{{ asset('assets/js/main.min.js') }}"></script>
    <script>
        Main.init();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        })
        showLoading();
        $(document).ready(function() {
            showLoading(false);

            $('form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        form.find('.is-invalid').removeClass('is-invalid');
                        form.find('.invalid-feedback').remove();
                    },
                    success: function(response) {
                        showToast('success', 'Data berhasil disimpan.');
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        var errorMsg = 'Terjadi kesalahan. Silakan coba lagi.';
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            for (const key in errors) {
                                const field = form.find(`[name="${key}"]`);
                                field.addClass('is-invalid').after(`<div class="invalid-feedback">${errors[key]}</div>`);
                            }
                            errorMsg = xhr.responseJSON.message || 'Terjadi kesalahan validasi. Silakan periksa form.';
                        } else if(xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        showToast('error', errorMsg);
                    }
                });
            });
        });

        function showLoading(show = true) {
            const preloader = $(".preloader");
            preloader.css({
                opacity: show ? 1 : 0,
                visibility: show ? "visible" : "hidden",
            });
        }

        function showToast(status, message) {
            iziToast[status]({
                title: status.charAt(0).toUpperCase() + status.slice(1),
                message: message,
                position: 'topRight'
            });
        }
    </script>
    @stack('js')
</body>
</html>
