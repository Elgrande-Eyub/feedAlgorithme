<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class algorithme extends Controller
{
    public $user;


    public function __construct()
    {
        $this->user = Auth::user();
    }


    public function threads()
    {
        $user = $this->user;

        $threads = Thread::get();

        foreach($threads as $thread){
            $thread->Finalscore = $thread->score + $this->calculateUserScore($thread,$this->user);
        }

        $threads = $threads->sortByDesc('finalScore');
        $FormattedThreads = $this->FormattesCounts($threads);

        $threadsPagination = collect($FormattedThreads)->paginate(10);

        return view('threads',compact('user','threadsPagination'));
    }

    public function FormattesCounts($collection)
    {
        foreach ($collection as $row) {
            // setuppp time Ago for timestamp create_at
            $timeAgo = $row->created_at->diffForHumans();
            $row->time_ago = $timeAgo;
            // formate likes count from 1000 to 1k
            $formattedLikesCount = round($row->likes_count / 1000, 1);
            $row->formateLikes = $formattedLikesCount. 'k';
            // formate followers
            $formattedFollowresCount = round($row->user->profile->followers_count / 1000, 1);
            $row->formateFollowres = $formattedFollowresCount. 'k';

        }

        return $collection;
    }

    public function generateScores(){

        $threads = Thread::all();
        foreach ($threads as $thread) {
            $score = $this->calculateGlobalScore($thread);
            $thread->score = $score;
            $thread->save();
        }

        return "Generated Successfuly";
    }

    public function calculateGlobalScore($thread)
    {
        // Define weights for global factors
        $followersWeight = 0.4;
        $likesWeight = 0.3;
        $timestampWeight = 0.2;
        $paginationWeight = 0.1;

        // Calculate the global score based on weights and attributes
        $score = ($thread->followers_count * $followersWeight) +
                 ($thread->likes_count * $likesWeight) +
                 ($this->calculateTimestampFactor($thread) * $timestampWeight) +
                 ($paginationWeight * $this->calculatePaginationFactor($thread));

        return $score;
    }

    public function calculateUserScore($thread, $user)
    {
        // Define weights for user-specific factors
        $ageWeight = 1;
        $languageWeight = 200;
        $locationWeight = 1;

        // Calculate the user-specific score based on weights and attributes
        $score = ($this->calculateAgeFactor($thread, $user) * $ageWeight) +
                 ($this->calculateLanguageFactor($thread, $user) * $languageWeight) +
                 ($this->calculateLocationFactor($thread, $user) * $locationWeight);

        return $score;
    }

        private function calculateTimestampFactor($thread)
        {
            // Calculate timestamp factor based on timestamp (e.g., newer threads have higher factor)
            $timeDifference = now()->diffInMinutes($thread->created_at);
            return 1 / ($timeDifference + 1); // Adding 1 to avoid division by zero
        }

        private function calculateAgeFactor($thread, $user)
        {
            // Calculate age difference factor (e.g., 0.5 for half the age difference)
            $ageDifference = abs($user->profile->age - $thread->user->profile->age);
            return 1 - ($ageDifference / 100); // Normalize to range [0, 1]
        }

        private function calculateLanguageFactor($thread, $user)
        {
            // Check if the thread language matches the user's language preference
            return $thread->user->profile->language === $user->profile->language ? 1 : 0;
        }

        private function calculateLocationFactor($thread, $user)
        {
            // Check if the thread location matches the user's location (city/country)
            return ($thread->user->profile->city === $user->profile->city) && ($thread->user->profile->country === $user->profile->country) ? 1 : 0;
        }

        private function calculatePaginationFactor($thread)
        {
            // Assign a fixed value for pagination weight
            return 1;
        }



}
