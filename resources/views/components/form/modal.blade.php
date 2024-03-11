@props(['size' => 'lg', 'title', 'action' => null])
<div class="modal-dialog modal-{{ $size }}">
    <div class="modal-content">
        <form id="form_action" action="{{ $action }}" method="post">
            @csrf
            
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
    </form>
    </div>
</div>

@stack('jsLibrary')
    <!-- Additional script to handle level menu logic -->
    @push('js')
    <script>
        $(document).ready(function() {
            // Function to toggle the main menu dropdown based on the level menu choice
            function toggleMainMenuSelection() {
                var selectedValue = $('input[name="level_menu"]:checked').val();
                if(selectedValue === 'main_menu') {
                    $('#main_menu_wrapper').addClass('d-none');
                } else if(selectedValue === 'sub_menu') {
                    $('#main_menu_wrapper').removeClass('d-none');
                }
            }


            // Event listener for level menu radio buttons
            $('input[name="level_menu"]').on('change', toggleMainMenuSelection);
            

            // Initialize the form state on document ready or when editing an existing item
            if ($('body').data('page-type') === 'edit-menu' || $('body').data('page-type') === 'create-menu') {
                toggleMainMenuSelection();
            }

            // AJAX form submission with validation feedback
            $('#form_action').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success response, such as redirecting to a new page or refreshing the data table
                    },
                    error: function(response) {
                        // Clear previous errors
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();

                        // Show validation errors
                        let errors = response.responseJSON.errors;
                        for (let key in errors) {
                            let input = $('[name=' + key + ']');
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback">' + errors[key][0] + '</div>');
                        }
                    }
                });
            });
        });
    </script>
    @endpush

    <!-- ... other scripts ... -->
    <script src="{{ asset('') }}assets/js/main.min.js"></script>
    @stack('js')