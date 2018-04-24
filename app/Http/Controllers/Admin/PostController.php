<?php

namespace App\Http\Controllers\Admin;

use App\Model\user\category;
use App\Model\user\post;
use App\Model\user\tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = post::all();
        return view('admin.post.index', compact('models'));
    }

    public function search(Request $request)
    {
        $models = post::where('title', 'LIKE', "%". $request['query'] ."%")->get();
        return view('admin.post.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('posts.create')){
            $categories = category::all();
            $tags = tag::all();
            return view('admin.post.create', compact('categories', 'tags'));
        }
        return redirect(route('admin.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'is_published' => 'required',
        ]);

        $photo = null;
        if($request->hasFile('photo')){
            $photo = $request->photo->store('public/images');
        }

        $model = new post();
        $model->photo = $photo;
        $model->title = $request->title;
        $model->description = $request->description;
        $model->is_published = $request->is_published;
        $model->sub_title = $request->sub_title;
        $model->save();

        $model->categories()->sync($request->categories);
        $model->tags()->sync($request->tags);

        $request->session()->flash('alert-success', 'Saved succesfully!');
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->can('posts.update')){
            $model = post::with('tags', 'categories')->where('id', $id)->first();
            $categories = category::all();
            $tags = tag::all();
            return view('admin.post.edit', compact('model', 'tags', 'categories'));
        }
        return redirect(route('admin.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
//            'is_published' => 'required',
        ]);

        $model = post::find($id);
        if($request->hasFile('photo')){
            $photo = $request->photo->store('public/images');
        } else {
            $photo = $model->photo;
        }

        $model->photo = $photo;
        $model->title = $request->title;
        $model->description = $request->description;
        $model->is_published = ($request->is_published == null) ? 0 : 1;
        $model->sub_title = $request->sub_title;
        $model->slug = $request->slug;
        $model->save();

        $model->categories()->sync($request->categories);
        $model->tags()->sync($request->tags);

        $request->session()->flash('alert-success', 'Saved succesfully!');
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        post::where('id', $id)->delete();
        return redirect(route('post.index'));
    }
}
