<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateIdea{
    public function handle(array $attributes, ?User $user = NULL){
        // Create the new Idea 
        // dd($attributes);

        /** @var User  **/
        $user ??= Auth::user();

        $data = collect($attributes)->only([
            'title', 'description', 'status', 'links'
        ])->toArray();

        if($attributes['image'] ?? false){
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function() use($attributes, $data, $user){
            $idea = $user->ideas()->create($data);
    
            if(isset($attributes['steps'])){
                $idea->steps()->createMany(
                    collect($attributes['steps'])->map(fn($step) => ['description' => $step])
                );
            }
        });

    }
}