<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Media;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
	public function index()
	{
		if (request()->has('uuid') === false) {
			return response([], 422);
		}
		
		$media = Media::whereIn('uuid', request()->uuid)->get();

		return $media;
	}
    /**
     * Store a newly submitted media file in storage and db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	// run the validation
        $this->validate(request(), [
            'media' => 'required|image|max:10240'
        ]);
        

        // Storage::disk('public')->delete(auth()->user()->getOriginal('avatar_path'));

        // persis file to storage and fetch the path
        $path = request()->file('media')->store('media/' . auth()->user()->uuid, 'public');

        // persist media to db
        $media = auth()->user()->media()->create([
            'uuid' => Str::uuid(),
            'user_id' => auth()->id(),
            'path' => $path,
            'media_type' => 'image'
        ]);

        // PushMediaToCloudinary::dispatch($media)->onConnection('database')->onQueue('images');

        return response(['success' => true, 'media' => ['url' => asset($media->path), 'uuid' => $media->uuid]]);
    }

    public function show(Media $media)
    {
        return $media;
    }

    /**
     * [destroy description]
     * @param  Media  $media [description]
     * @return [type]        [description]
     */
    public function destroy(Media $media)
    {
        $this->authorize('delete_media', $media);

        $media->delete();

    	return response([], 204);
    }
}
