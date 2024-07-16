<?php

namespace App\Http\Services;

use App\Jobs\SendNotificationJob;
use App\Models\Story;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class StoryService
{
    public function __construct(protected Story $story)
    {
    }

    public function index(): Collection|array
    {
        return Story::query()
            ->where('is_approved', '=', true)
            ->orderBy('id', 'DESC')
            ->get();
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

        $approval_token = Str::random(64);

        $approvalLink = route('approve-story', [$approval_token, $story->{'id'}]);
        $story->update([
            'link' => $approvalLink,
            'approval_token' => $approval_token
        ]);
        $email = auth()->user()->{'email'};

        dispatch(new SendNotificationJob($email, $story, $approvalLink));
    }
}
