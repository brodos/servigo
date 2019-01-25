<?php

namespace App\Jobs;

use App\Media;
use Illuminate\Bus\Queueable;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PushMediaToCloudinary implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $media;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pathinfo = pathinfo($this->media->path);

        $response = Cloudder::upload(
            Storage::url($this->media->path), // local path for the file
            $pathinfo['dirname'] . $pathinfo['filename'], // publicId
            null, // options
            [$this->media->owner->uuid] // tags
        );


    }
}
