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
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Balls</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('ball.create') }}"> Add Ball</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered data-table">
    <thead>
    <tr>
            <th>No</th>
            <th>Name</th>
            <th>Volume</th>
            <th width="100px">Action</th>
        </tr>
        </thead>
    </table>
  

    <script>
        $(function () {
    
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ball.index') }}",
                columns: [
                    {data: 'id', name: 'id', "render": function ( data, type, row ) {
                        return row.DT_RowIndex;
                    }},
                    {data: 'name', name: 'name'},
                    {data: 'volume', name: 'volume'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            fixedHeader: {
                header: true,
                footer: true,
            }
            });
            
        });


    function deleteBall(id){
        
        var result = confirm('Are you sure, you want to delete ?');
        if(result){
            var routeName="{{ url('ball/delete') }}/" +id;
            window.location.href=routeName;
        }

    };

    function editBall(id){
        
        var routeName="{{ url('ball/edit') }}/" +id;
            window.location.href=routeName;

    };

    </script>

@endsection