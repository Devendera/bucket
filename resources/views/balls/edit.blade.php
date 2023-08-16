@extends('layouts.app')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit ball</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('ball.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
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
  
    <form action="{{ route('ball.update') }}" id="ball" method="POST">
        @csrf
         
        <input type="hidden" name="id" id="id" value="{{$ball->id}}" />
         <div class="row">
            
    <div class="form-group mb-3">
        <input type="text" class="form-control" name="name" value="{{ $ball->name }}" placeholder="Enter Name">
        @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
        </div>
    
    <div class="form-group mb-3">
        <input type="text" class="form-control" value="{{ $ball->volume }}" name="volume" placeholder="Enter volume">
        @if ($errors->has('volume'))
        <span class="text-danger">{{ $errors->first('volume') }}</span>
        @endif
    </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
   
    </form>
@endsection