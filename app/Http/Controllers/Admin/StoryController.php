<?php

namespace App\Http\Controllers\Admin;

use App\Events\ApproveEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Story\StoreRequest;
use App\Http\Services\StoryService;
use App\Models\Story;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class StoryController extends Controller
{
    public function __construct(protected StoryService $storyService)
    {
    }

    /**
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $stories = $this->storyService->index();
        return view('admin.stories.index', compact('stories'));
    }

    /**
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.stories.create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $this->storyService->store($request);
            return redirect()->route('admin.stories.index')->with('success', 'Story was created.');
        } catch (Exception $e) {
            Log::error(__CLASS__ . '::' . __FUNCTION__ . "->" . $e->getMessage());
            return redirect()->back()->with('error', 'Try again.');
        }
    }


    /**
     * @param $token
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application|void
     */
    public function approve($token)
    {
        $story = Story::findStoryByToken($token);
        if ($story->{'approval_token'} == $token && $story->{'is_approved'} == 0) {
            $story->update(['is_approved' => true]);
            broadcast(new ApproveEvent($story));
            return view('admin.stories.notice-board');
        }
        abort(404);
    }
}
