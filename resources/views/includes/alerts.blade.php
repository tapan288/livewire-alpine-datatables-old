@if (session()->has('success'))
    <div class="alert alert-success alert-block">
        <strong>{{ session('success') }}</strong>
    </div>
@endif


@if (session()->has('error'))
    <div class="alert alert-danger alert-block">
        <strong>{{ session('error') }}</strong>
    </div>
@endif


@if (session()->has('warning'))
    <div class="alert alert-warning alert-block">
        <strong>{{ session('warning') }}</strong>
    </div>
@endif


@if (session()->has('info'))
    <div class="alert alert-info alert-block">
        <strong>{{ session('info') }}</strong>
    </div>
@endif


@if ($errors->any())
    <div class="alert alert-danger">
        Please check the form below for errors
    </div>
@endif
