<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Story\StoreRequest;
use App\Http\Services\StoryService;
use App\Models\Story;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @return RedirectResponse
     */
    public function approve(Story $story): RedirectResponse
    {
        $story->update(['is_approved' => true]);

        return redirect()->route('notice-board', ['id' => $story->{'id'}]);
    }

    /**
     * @return JsonResponse
     */
    public function approvedStories(): JsonResponse
    {
        $approvedStories = $this->storyService->index();
        return response()->json($approvedStories);
    }

    public function notice_board($id): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $story = Story::query()->findOrFail($id);
        return view('admin.stories.notice-board', compact('story'));
    }
}
