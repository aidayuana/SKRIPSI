<x-form.modal title="Form Modal">
    @if ($data->id)
        @method('put')
    @endif
    <div class="row">
        <div class="col-md-6">
            <x-form.input name="name" value="{{ $data->name }}" label="Name" />
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Url</label>
                <input type="text" name="url" value="{{ $data->url }}" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" value="{{ $data->category }}" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Icon</label>
                <input type="text" name="icon" value="{{ $data->icon }}" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Orders</label>
                <input type="text" name="orders" value="{{ $data->orders }}" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-form.radio label="Level menu" inline="true" name="level_menu" :options="['Main menu' => 'main_menu', 'Sub menu' => 'sub_menu']" />
                {{-- <label class="form-label d-block mb-2">Level menu</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ !$data->main_menu_id ? 'checked' : '' }} type="radio" name="level_menu"
                        id="inlineRadio1" value="main_menu">
                    <label class="form-check-label" for="inlineRadio1">Main menu</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" {{ $data->main_menu_id ? 'checked' : '' }} type="radio" name="level_menu"
                        id="inlineRadio2" value="sub_menu">
                    <label class="form-check-label" for="inlineRadio2">Sub menu</label>
                </div> --}}
            </div>
        </div>
        <div id="main_menu_wrapper" class="col-md-6 {{ !$data->main_menu_id ? 'd-none' : '' }}">
            <div class="mb-3">
                <label for="" class="form-label">Main menu</label>
                <select class="form-select form-select-sm mb-3" name="main_menu" aria-label="Default select example">
                    <option selected value="">Pilih main menu</option>
                    @foreach ($mainMenus as $item)
                        <option value="{{ $item->id }}" @selected($data->main_menu_id == $item->id)>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
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