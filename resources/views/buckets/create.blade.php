@extends('layouts.app')
 
@section('content')
<main class="signup-form">
<div class="cotainer">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
<h3 class="card-header text-center">Add Bucket</h3>
<div class="card-body">

@if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="{{ route('bucket.store') }}" id="bucket" method="POST">
@csrf
<div class="form-group mb-3">
    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name">
    @if ($errors->has('name'))
    <span class="text-danger">{{ $errors->first('name') }}</span>
    @endif
</div>

<div class="form-group mb-3">
    <input type="text" class="form-control" value="{{ old('volume') }}" name="volume" placeholder="Enter volume">
    @if ($errors->has('volume'))
    <span class="text-danger">{{ $errors->first('volume') }}</span>
    @endif
</div>



<div class="d-grid mx-auto">
<button type="submit" class="btn btn-success btn-block">Save</button>

</div>
<br />
<div class="d-grid mx-auto">
<a class="btn btn-primary btn-block" href="{{ route('bucket.index') }}">Back</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</main>
@endsection
