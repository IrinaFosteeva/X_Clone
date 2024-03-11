@if(session()->has('success1'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success1')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
