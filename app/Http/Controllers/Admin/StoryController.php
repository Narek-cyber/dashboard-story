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
     * @param Story $story
     * @param $token
     * @return RedirectResponse
     */
    public function approve($token, Story $story): RedirectResponse
    {
        if ($story->{'approval_token'} == $token) {
            $story->update(['is_approved' => true]);
            $stories = $this->storyService->index();
            broadcast(new ApproveEvent($stories))->toOthers();
            return redirect()->route('notice-board', ['token'=> $token, 'id' => $story->{'id'}]);
        }
        abort(404);
    }

    public function notice_board($token, $id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $story = Story::query()->findOrFail($id);
        return view('admin.stories.notice-board', compact('story'));
    }
}
