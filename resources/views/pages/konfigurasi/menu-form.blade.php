<x-form.modal title="Form Modal">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-form.input name="name" value="{{ $data->name }}" label="Name" />
        </div>
        <div class="col-md-6">
            <x-form.input name="url" value="{{ $data->url }}" label="Url" />
        </div>
        <div class="col-md-6">
            <x-form.input name="category" value="{{ $data->category }}" label="Category" />
        </div>
        <div class="col-md-6">
            <x-form.input name="icon" value="{{ $data->icon }}" label="Icon" />
        </div>
        <div class="col-md-6">
            <x-form.input name="orders" value="{{ $data->orders }}" label="Orders" />
        </div>
        <div class="col-md-6">
            <x-form.radio label="Level menu" inline="true" value="{{ $data->main_menu_id ? 'sub_menu' : 'main_menu' }}" name="level_menu" :options="['Main menu' => 'main_menu', 'Sub menu' => 'sub_menu']" />
        </div>
        <div id="main_menu_wrapper" class="col-md-6 {{ !$data->main_menu_id ? 'd-none' : '' }}">
            <x-form.select id="main_menu" name="main_menu" value="{{ $data->main_menu_id }}" label="Main menu" placeholder="Pilih main menu" 
                :options="$mainMenus"
                />
        </div>
        <div class="col-12">
            <div class="mb-3">
                <label for="" class="form-label d-block mb-2">Permission</label>
                @foreach (['create', 'read', 'update', 'delete'] as $item)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="permission[]" type="checkbox" id="inlineCheckbox1{{ $item }}"
                            value="{{ $item }}">
                        <label class="form-check-label" for="inlineCheckbox1{{ $item }}">{{ $item }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-form.modal>