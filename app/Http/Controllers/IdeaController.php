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

        $in_status = array_column(IdeaStatus::cases(), 'value');

        if(!in_array($status, $in_status)){
            $status = NULL;
        }
        
        // dd(array_column($in_status, 'value'));

        $ideas = $user->ideas()
        ->when($status, fn($query, $status) =>
            $query->where('status', $status)
        )
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
        //
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
        //
    }
}
