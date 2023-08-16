<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\Ball;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BucketSuggestionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $balls=Ball::all();

        return view('bucket_suggestion.index',compact('balls')); 
    }

    public function postSuggestion(Request $request)
    {
        $buckets=Bucket::all();
        $original_data=$request->data;

        $data=$original_data;
        $result='';
        foreach ($buckets as $bucket) {
            $bucket_volume=$bucket->volume;
            $result = $result. $bucket->name . ' contains ';
            foreach ($data as $key=>$value) {
                $qty=$value['qty'];
                $id=$value['id'];
                if($bucket_volume > 0 && $qty > 0){
                    $ball=Ball::where('id', $id)->first();
                    $ball_volume=$ball->volume * $qty;
                    
                    $pending=$bucket_volume % $ball->volume;
                    $placed=intdiv($bucket_volume , $ball->volume);

                    if($placed > 0)
                    {
                            $actual_placed=$placed>$qty?$qty:$placed;

                        //dd($bucket_volume,$placed,$qty, $actual_placed, $data[$key]);

                        $bucket_volume=$bucket_volume-($ball->volume * $actual_placed);
                        $result = $result. $actual_placed .' '. $ball->name. ' balls, ';
                        $data[$key]['qty']=$qty-$actual_placed;

                    }

                }
            }
            $result = $result. '<br />';

        }
        
        return $result;
    }

}
