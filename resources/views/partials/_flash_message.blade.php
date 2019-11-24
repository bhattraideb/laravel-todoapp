<div class="col-md-12">
    @if( Session::has('success') )
        <div class="alert notify-message alert-success text-center" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Success: </strong>{{ Session::get('success') }}
        </div>
    @endif
    @if( Session::has('failed') )
        <div class="alert notify-message alert-danger" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong>Failed: </strong>{{ Session::get('failed') }}
        </div>
    @endif
</div>

