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
                            <label for="form-label">Name</label>
                            <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="form-label">Url</label>
                            <input type="text" name="url" value="{{ $data->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="form-label">Category</label>
                            <input type="text" name="category" value="{{ $data->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="form-label">Icon</label>
                            <input type="text" name="icon" value="{{ $data->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="form-label">Orders</label>
                            <input type="text" name="orders" value="{{ $data->name }}" class="form-control">
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