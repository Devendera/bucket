<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\Ball;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BucketController extends Controller
{
    private $BUCKET_ROUTE="";

    public function __construct()
	{
		//$this->middleware('auth');
        $this->BUCKET_ROUTE="/bucket";
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bucket = Bucket::get();
    
            return Datatables::of($bucket)
            //edit functionality
            ->addColumn('action', function($row){
                        return "<a href='#' onclick='editBucket({$row->id})'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                        <a href='#' onclick='deleteBucket({$row->id})'><i class='fa fa-trash' aria-hidden='true'></i></a>    
                        ";
                    })
                    ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
                    }

        return view('buckets.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buckets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'volume' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->with('errors', $validator->errors())
                ->withInput();
        }

        Bucket::create($data);

        return redirect($this->BUCKET_ROUTE)
            ->with('success', 'Bucket created successfully.');
    }

    public function edit($id)
    {
        $bucket=Bucket::where('id',$id)->first();

        return view('buckets.edit',compact('bucket'));
    }

    public function update(Request $request, Bucket $bucket)
    {
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'volume' => 'required'
        ]);

        $bucket_data=Bucket::where('id',$request->id)->first();
    
        $bucket_data->update($request->all());
    
        return redirect($this->BUCKET_ROUTE)
                        ->with('success','Bucket updated successfully');
    }

    public function delete(Request $request, $id)
    {
        $bucket=Bucket::where('id', $id)->first();
        $bucket->delete();

        return redirect($this->BUCKET_ROUTE)
                        ->with('success','Bucket deleted successfully');
    }

    public function delete_multiple(Request $request)
    {
        foreach ($request->ids as $id){ 
            $bucket=Bucket::where('id', $id)->first();
            $bucket->delete();
        }

        return 1;
    }
}
