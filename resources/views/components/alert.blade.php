<div class="alert {{ is_null($type) ? 'alert-primary' : $type  }} alert-dismissible my-2" role="alert">
    @if($dismissible)
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    @endif
    {{ $message }}
</div>

@if($refreshable)
    <script>
        setTimeout(function () {
            location.reload();
        }, 2500);
    </script>
@endif
