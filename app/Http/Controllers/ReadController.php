<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function show(TweetService $tweetService)
    {
        $tweets = $tweetService->getTweetsPaginated(10);
        return view('tweet.index', ['tweets' => $tweets]);
    }
}
