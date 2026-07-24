<?php

namespace App\Http\Controllers;

use App\Actions\CreateIdea;
use App\Models\Idea;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\IdeaStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $user = Auth::user();

        $status = $request->status;
        
        // dd(array_column($in_status, 'value'));

        $ideas = $user->ideas()
        ->when(in_array($status, IdeaStatus::values()), fn($query) =>
            $query->where('status', $status)
        )
        ->latest()
        ->get();

        
        return view('idea.index', [
            'ideas' => $ideas,
            'count' => Idea::statusCount($user)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdeaRequest $request, CreateIdea $action)
    {
        $action->handle($request->safe()->all(), $request->user);

        return to_route('idea.index')
            ->with('success', 'Idea created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        // dd($idea);
        Gate::authorize('workWith', $idea);

        return view('idea.show', ['idea' => $idea]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        Gate::authorize('workWith', $idea);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        
        Gate::authorize('workWith', $idea);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        Gate::authorize('workWith', $idea);
        
        $idea->delete($idea->id);

        return redirect('/');
    }


    /***
     * Remove the featured image an Idea has 
     * */
    public function destroyImage(Idea $idea){
        Gate::authorize('workWith', $idea);
        
        Storage::disk('public')->delete($idea->image_path);

        $idea->update(['image_path' => NULL]);

        return back();
    }
}
