@if (session()->has('flash_message'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session()->get('flash_message') }}
            </div>
        </div>
    </div>
@endif