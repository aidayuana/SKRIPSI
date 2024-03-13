<x-master-layout>
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Role</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @can('create konfigurasi/roles')
                                <a class="mb-3 btn btn-primary add" href="{{ route('konfigurasi.roles.create') }}">Add</a>
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
                
            </div>
        </div>
    </div>
    @push('js')
    {!! $dataTable->scripts() !!}

    <script>
        const datatable = 'role-table';
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

            function initFormSubmitHandler() {
                $('#form_action').submit(function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize();
                    
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                        },
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

            // Ensure the ID matches the DataTable ID
            $('#' + datatable).on('click', '.action', function(e) {
                e.preventDefault();
                showModal($(this).attr('href'));
            });
        });
    </script>
    @endpush
</x-master-layout>
