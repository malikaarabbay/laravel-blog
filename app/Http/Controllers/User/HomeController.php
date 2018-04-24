<?php

namespace App\Http\Controllers\User;

use App\Model\user\category;
use App\Model\user\post;
use App\Model\user\tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index(){
        $posts = post::where('is_published', 1)->orderBy('created_at', 'DESC')->limit(5)->get();
        return view('user.index', compact('posts'));
    }

    public function category(category $model){
        $posts = $model->posts();
        return view('user.index', compact('posts'));
    }

    public function tag(tag $model){
        $posts = $model->posts();
        return view('user.index', compact('posts'));
    }

    public function getRegionList(Request $request)
    {
        $regions = DB::table('regions')
            ->where('country_id',$request->country_id)
            ->pluck('title','id');
        return response()->json($regions);
    }

    public function getCityList(Request $request)
    {
        $cities = DB::table('cities')
            ->where('region_id',$request->region_id)
            ->pluck('title','id');
        return response()->json($cities);
    }
}
