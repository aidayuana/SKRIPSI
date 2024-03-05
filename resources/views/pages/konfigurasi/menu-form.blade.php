<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form id="form_action" action="{{ $action }}" method="post">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                        </div>
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
                        <label class="form-label d-block mb-2">Level menu</label>
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="level_menu"
                                    id="inlineRadio1" value="main_menu">
                                <label class="form-check-label" for="inlineRadio1">Main menu</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="level_menu"
                                    id="inlineRadio2" value="sub_menu">
                                <label class="form-check-label" for="inlineRadio2">Sub menu</label>
                            </div>
                        </div>
                    </div>
                    <div id="main_menu_wrapper" class="col-md-6 d-none">
                        <div class="mb-3">
                            <label for="" class="form-label">Main menu</label>
                            <select class="form-select form-select-sm mb-3" name="main_menu" aria-label="Default select example">
                                <option selected>Pilih main menu</option>
                                @foreach ($mainMenus as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
    </form>
    </div>
</div>