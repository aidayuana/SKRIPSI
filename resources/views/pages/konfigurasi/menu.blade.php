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
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
       
    </div>
    @push('js')
        {!! $dataTable->scripts() !!}

        <script>
            $('.add').on('click', function(e){
                e.preventDefault();

                $.ajax({
                    url: this.href,
                    method: 'get',
                    beforeSend: function(){
                        showLoading()
                    },
                    complete: function(){
                        showLoading(false)
                    },
                    success: function(res){
                       const modal = $('#modal_action')
                       modal.html(res)
                       modal.modal('show')

                       $('[name="level_menu"]').on('change', function(){
                           console.log(this.value)
                            if(this.value == 'sub_menu'){
                                $('#main_menu_wrapper').removeClass('d-none')
                            }else{
                                $('#main_menu_wrapper').addClass('d-none')
                            }
                       })

                       $('#form_action').on('submit', function(e){
                           e.preventDefault();
                           const _form = this
                           $.ajax({
                                url: this.action,
                                method: this.method,
                                data: new FormData(_form),
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                   $(_form).find('.is-invalid').removeClass('is-invalid')
                                   $(_form).find('.invalid-feedback').remove()
                                   submitLoader().show()
                                },
                                
                                success: function(res){
                                   $('#modal_action').modal('hide')
                                   window.LaravelDataTables['menu-table'].ajax.reload()
                                },
                                complete: function(){
                                    submitLoader().hide()
                                },
                                error: function(err) {
                                   const errors = err.responseJSON?.errors

                                   if(errors){
                                    for (let [key, message] of Object.entries(errors)) {
                                        console.log(key, message);
                                        $(`[name="${key}"]`).addClass('is-invalid')
                                        .parent()
                                        .append(`<div class="invalid-feedback">${message}</div>`)
                                    }
                                   }
                                }
                           })
                       })
                    },
                    error: function(err){
                        console.log(err);
                    }
                })
            })
        </script>
    @endpush
</x-master-layout>