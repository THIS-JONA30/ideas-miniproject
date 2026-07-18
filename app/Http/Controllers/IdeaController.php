<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\IdeaStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(StoreIdeaRequest $request)
    {
        // Store the new Idea
        // dd($request->all());

        $idea = Auth::user()->ideas()->create($request->safe()->except(['steps', 'image']));

        $idea->steps()->createMany(
            collect($request->steps)->map(fn($step) => ['description' => $step])
        );

        $image_path = $request->image->store('ideas', 'public');

        $idea->update([
            'image_path' => $image_path
        ]);

        return to_route('idea.index')
            ->with('success', 'Idea created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        // dd($idea);
        return view('idea.show', ['idea' => $idea]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        $idea->delete($idea->id);   

        return redirect('/');
    }
}
