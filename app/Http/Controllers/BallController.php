<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\Ball;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BallController extends Controller
{
    private $BALL_ROUTE="";

    public function __construct()
	{
		//$this->middleware('auth');
        $this->BALL_ROUTE="/ball";
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ball = Ball::get();
    
            return Datatables::of($ball)
            //edit functionality
            ->addColumn('action', function($row){
                        return "<a href='#' onclick='editBall({$row->id})'><i class='fa fa-pencil' aria-hidden='true'></i></a>
                        <a href='#' onclick='deleteBall({$row->id})'><i class='fa fa-trash' aria-hidden='true'></i></a>    
                        ";
                    })
                    ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
                    }

        return view('balls.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('balls.create');
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

        Ball::create($data);

        return redirect($this->BALL_ROUTE)
            ->with('success', 'Ball created successfully.');
    }

    public function edit($id)
    {
        $ball=Ball::where('id',$id)->first();

        return view('balls.edit',compact('ball'));
    }

    public function update(Request $request, Ball $Ball)
    {
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'volume' => 'required'
        ]);

        $ball_data=Ball::where('id',$request->id)->first();
    
        $ball_data->update($request->all());
    
        return redirect($this->BALL_ROUTE)
                        ->with('success','Ball updated successfully');
    }

    public function delete(Request $request, $id)
    {
        $ball=Ball::where('id', $id)->first();
        $ball->delete();

        return redirect($this->BALL_ROUTE)
                        ->with('success','Ball deleted successfully');
    }

    public function delete_multiple(Request $request)
    {
        foreach ($request->ids as $id){ 
            $ball=Ball::where('id', $id)->first();
            $ball->delete();
        }

        return 1;
    }
}
