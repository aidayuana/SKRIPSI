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
                            <a class="btn btn-primary mb-3 add" href="{{ route('konfigurasi.menu.create') }}">Tambah</a>
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
                // Request AJAX untuk mengambil form
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        // Tampilkan form di dalam modal
                        $('#modalContainer .modal-content').html(response);
                        $('#modalContainer').modal('show');

                        // Setelah form ditampilkan, inisialisasi event handler untuk form submission
                        initFormSubmitHandler();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memuat form.');
                    }
                });
            }

            function initFormSubmitHandler() {
                // Ini mungkin perlu diubah sesuai dengan ID form Anda yang sebenarnya
                $('#form_action').submit(function(e) {
                    e.preventDefault();
                    var formData = $(this).serialize(); // Pastikan form memiliki ID yang sesuai

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Pastikan server mengembalikan JSON dengan format { status: "success" }
                            if(response.status === 'success') {
                                $('#modalContainer').modal('hide');
                                // Opsi untuk reload atau update UI
                            } else {
                                // Handle jika response bukan success
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                });
            }

            // Handler untuk tombol tambah
            $('.add').on('click', function(e) {
                e.preventDefault();
                showModal($(this).attr('href'));
            });

            // Handler untuk tombol aksi di tabel
            $('#menu-table').on('click', '.action', function(e) {
                e.preventDefault();
                showModal($(this).attr('href'));
            });
        });
    </script>
@endpush
</x-master-layout>
