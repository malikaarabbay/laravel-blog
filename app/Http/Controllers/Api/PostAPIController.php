<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\APIBaseController as APIBaseController;
use App\Model\user\post;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

class PostAPIController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::where('is_published', 1)->orderBy('created_at', 'DESC')->get();
        $results = $posts->map(function ($post) {
            return  [
                'id' => $post->id,
                'title' => $post->title,
                'subTitle' => $post->sub_title,
                'image' => $post->photo,
                'created' => Carbon::parse($post->created_at)->format('d.m.Y'),
                'shortDescription' => mb_substr(strip_tags($post->description, '<a>'),0, 180, 'UTF-8').'...',
                'slug' => $post->slug
            ];
        });
        return $this->sendResponse($results->toArray(), 'Posts retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post = post::create($input);

        return $this->sendResponse($post->toArray(), 'Data created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::with('tags', 'categories')->find($id);

        if (is_null($post)) {
            return $this->sendError('Data not found.');
        }

        return $this->sendResponse($post->toArray(), 'Data retrieved successfully.');
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
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $post = post::find($id);
        if (is_null($post)) {
            return $this->sendError('Data not found.');
        }

        $post->name = $input['title'];
        $post->description = $input['description'];
        $post->save();

        return $this->sendResponse($post->toArray(), 'Data updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::find($id);

        if (is_null($post)) {
            return $this->sendError('Data not found.');
        }

        $post->delete();

        return $this->sendResponse($id, 'Data deleted successfully.');
    }
}