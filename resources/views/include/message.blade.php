@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if(session('message'))
    <div class="alert alert-success">
        {{ is_array(session('message')) ? session('message')['message'] : session('message') }}
    </div>
@endif
