<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DeleteController extends Controller
{
    public function delete(Request $request, TweetService $tweetService)
    {
        $tweetId = $request->route('tweetId');

        if (! $tweetService->isOwnTweet($request->user()->id, $tweetId)) {
            throw new AccessDeniedHttpException();
        }

        $tweet = Tweet::where('id', $tweetId);
        $tweet->delete();

        return redirect()
            ->route('index')
            ->with('feedback.success', 'つぶやきを削除しました。');
    }
}
