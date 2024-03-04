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
                            <button class="btn btn-primary mb-3">Tambah</button>
                        </div>
                    </div>
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
       
    </div>
    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
</x-master-layout>