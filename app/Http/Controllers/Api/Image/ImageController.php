<?php

namespace App\Http\Controllers\Api\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Image;

use App\Transformers\ImageTransformer;

class ImageController extends ApiController
{


    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . ImageTransformer::class)->only(['store']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $image = Image::firstOrCreate([
          'name' => $request['name'],
          'src' => $request['src'],
          'description' => $request['description'],
          'user_id' => 2,
          'type' => Image::TYPE_COMPETITION,
          'type_id' => $request['type_id'],
        ]);

        if(!$image->wasRecentlyCreated)
        {
          return $this->errorResponse('Ta fotografija že obstaja', 455);
        }

        return $this->showItem($image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->detele();

        Storage::delete($image->src);

        return $this->showItem($image);
    }

    /**
     * Upload the specified resource to storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function upload(Request $request) {
      $path = Storage::put('test', $request->file('image'), 'public');

      return response()->json([
        'data' => $path
      ]);
    }
}
