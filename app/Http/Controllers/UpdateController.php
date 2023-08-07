<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Validator;

class UpdateController extends Controller
{
    public function edit(Request $request, TweetService $tweetService)
    {
        $tweetId = $request->route('tweetId');

        if (! $tweetService->isOwnTweet($request->user()->id, $tweetId)) {
            throw new AccessDeniedHttpException();
        }

        $tweet = Tweet::where('id', $tweetId)->firstOrFail();
        return view('tweet.edit', ['tweet' => $tweet]);
    }

    public function update(TweetRequest $request)
    {
        $validator = Validator::make($request->all(), Tweet::$rules, Tweet::$errorMsg);
        if ($validator->fails()) {
            return redirect()
                ->route('edit.edit', ['tweetId' => $request->route('tweetId')])
                ->withErrors($validator);
        }

        $tweet = Tweet::where('id', $request->route('tweetId'))->firstOrFail();
        $tweet->content = $request->input('tweet');
        $tweet->save();

        return redirect()
            ->route('index')
            ->with('feedback.success', 'つぶやきを編集しました。');
    }
}
