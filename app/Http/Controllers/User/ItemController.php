<?php
namespace App\Http\Controllers\User;


use App\Model\user\post;
use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $items = post::search($request->input('search'))->toArray();
        }
        return view('user.item.index',compact('items'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $item = new post();
        $item->title = $request->title;
        $item->description = $request->description;
        $item->save();
        $item->addToIndex();

        return redirect()->back();
    }
}
?>