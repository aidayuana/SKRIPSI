<x-master-layout>
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Menu</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @can('create konfigurasi/menu')
                                <a class="mb-3 btn btn-primary add" href="{{ route('konfigurasi.menu.create') }}">Add</a>
                            @endcan
                            @can('sort konfigurasi/menu')
                                <a class="mb-3 btn btn-info sort" href="{{ route('konfigurasi.menu.sort') }}">Sort Menu</a>
                            @endcan
                        </div>
                    </div>
                    {!! $dataTable->table(['id'=>'menu-table']) !!}
                </div>
            </div>
        </div>
    </div>
     <!-- Modal Structure -->
     <div class="modal fade" id="modalContainer" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Kode form Anda di sini -->
            </div>
        </div>
    </div>
    @push('js')
    {!! $dataTable->scripts() !!}

    <script>
        $(document).ready(function() {
            function showModal(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#modalContainer .modal-content').html(response);
                        $('#modalContainer').modal('show');
                        initFormSubmitHandler();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memuat form.');
                    }
                });
            }

            function ajaxRequest(url, method, token, onSuccess) {
                $.ajax({
                    url: url,
                    type: method,
                    data: {
                        _token: token // Include CSRF token
                    },
                    success: onSuccess,
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memproses permintaan.');
                    }
                });
            }


            $('.sort').on('click', function(e) {   
                e.preventDefault();
                var url = $(this).attr('href');
                var token = $(this).data('csrf'); // Retrieve CSRF token
                
                ajaxRequest(url, 'PUT', token, function() {
                    window.location.reload();
                });
            });

            function initFormSubmitHandler() {
                $('#form_action').submit(function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if(response.status === 'success') {
                                $('#modalContainer').modal('hide');
                            } else {
                                alert('Terjadi kesalahan.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                });
            }

            $('.add').on('click', function(e) {
                e.preventDefault();
                showModal($(this).attr('href'));
            });

            $('#menu-table').on('click', '.action', function(e) {
                e.preventDefault();
                showModal($(this).attr('href'));
            });
        });
    </script>
    @endpush
</x-master-layout>
