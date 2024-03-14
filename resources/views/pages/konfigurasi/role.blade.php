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
                    {!! $dataTable->table(['id' => 'role-table']) !!}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Structure for any dynamic content, not directly related to the deletion but provided for completeness -->
    <div class="modal fade" id="modalContainer" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal content dynamically injected here -->
            </div>
        </div>
    </div>

    @push('js')
        {!! $dataTable->scripts() !!}

        <script>
            $(document).ready(function() {
                // Event listener untuk tombol "Add"
                $('.add').on('click', function(e) {
                    e.preventDefault();
                    let actionUrl = $(this).attr('href'); // Ambil URL dari attribute href

                    // Request ke server untuk mengambil modal content
                    $.ajax({
                        url: actionUrl, // Gunakan URL dari attribute href
                        method: 'GET',
                        success: function(response) {
                            // Isi modal dengan konten dari response
                            $('#modalContainer .modal-content').html(response);
                            // Tampilkan modal
                            $('#modalContainer').modal('show');
                        },
                        error: function() {
                            // Tampilkan pesan error jika terjadi masalah
                            alert('Failed to load modal content. Please try again later.');
                        }
                    });
                });
                
                // Event listener untuk tombol "Detail"
                $('.detail').on('click', function(e) {
                    e.preventDefault();
                    let detailUrl = $(this).data('detail-url'); // Ambil URL detail dari data attribute

                    // Request ke server untuk mengambil konten modal
                    $.ajax({
                        url: detailUrl,
                        method: 'GET',
                        success: function(response) {
                            // Isi modal dengan konten dari response
                            $('#modalContainer .modal-content').html(response);
                            // Tampilkan modal
                            $('#modalContainer').modal('show');
                        },
                        error: function() {
                            // Tampilkan pesan error jika terjadi masalah
                            alert('Failed to load modal content. Please try again later.');
                        }
                    });
                });
                
                // Event listener untuk tombol "Delete" di dalam DataTables
                $('#role-table').on('click', '.delete', function(e) {
                    e.preventDefault();
                    let deleteUrl = $(this).data('delete-url');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: deleteUrl,
                                type: 'POST',
                                data: {
                                    _method: 'DELETE',
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    );
                                    $('#role-table').DataTable().ajax.reload(null, false);
                                },
                                error: function(xhr) {
                                    Swal.fire(
                                        'Error',
                                        'There was an issue deleting the role. Please try again.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-master-layout>
