<?php

namespace App\Http\Services;

use App\Jobs\SendNotificationJob;
use App\Jobs\SendNotifiicationJob;
use App\Models\Story;
use Illuminate\Database\Eloquent\Collection;

class StoryService
{
    public function __construct(protected Story $story)
    {
    }

    public function index(): Collection|array
    {
        return Story::query()->where('is_approved', '=', true)->get();
    }

    /**
     * @param $request
     * @return void
     */
    public function store($request): void
    {
        $story = Story::query()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $approvalLink = route('approve-story', $story->{'id'});
        $story->update(['link' => $approvalLink]);
        dispatch(new SendNotificationJob($story, $approvalLink));
    }
}
