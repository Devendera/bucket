@extends('layouts.app')
 
@section('content')
<style>
    
    .w-5{
        display:none;
    }

    .flex > div{
  display:inline-block;
    }
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Suggestions</h2>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

   <div class="container">
        <div class="row">
        @foreach($balls as $ball)
                <div class="col-6">
                <div class="col-4">{{ $ball->name }} <input type="hidden" id="{{ $ball->id }}" name="{{ $ball->id }}" value="{{ $ball->id }}"></div>
                <div class="col-8"> <input type="text" name="{{ $ball->name }}" id="{{ $ball->name }}" class="form-control" /> </div>
                </div>
            @endforeach
        </div>
        <br>
        <div class="">
               <button class="btn btn-success">
               <a class="btn btn-success" onclick="suggestion()" href="#">Place Balls in Bucket</a>
               </button>
            </div>
   </div>
    <br />
   <div id="result" class="container">
        
    </div>
  

    <script>
        $(function () {
    
           
        });

    function editBall(id){
        
        var routeName="{{ url('ball/edit') }}/" +id;
            window.location.href=routeName;

    };

    function suggestion()
    {
        $('#result').empty();
        var arr = [];
        var balls = <?php echo json_encode($balls); ?>;
        for ( var key in balls ) {
            var ball = balls[key];
            var id= $('#'+ ball.id).val();
            var qty = $('#'+ ball.name).val();
        
             arr.push({
                id: id,
                qty: qty,
            });
            
        }

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
           type:'POST',
           url:"{{ route('suggestion.post') }}",
           data:{data: arr},
           success:function(data){
              //alert(data);
              $('#result').append('<p><b>Result:</b></p>');
              $('#result').append('<p>' + data +'</p>');
           }
        });
    }

    </script>

@endsection