<?php

namespace App\Http\Controllers;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CreateController extends Controller
{
    public function create(TweetRequest $request)
    {
        $validator = Validator::make($request->all(), Tweet::$rules, Tweet::$errorMsg);
        if ($validator->fails()) {
            return redirect()
                ->route('index')
                ->withErrors($validator);
        }

        $tweet = new Tweet();
        $form = $request->all();
        $form['user_id'] = Auth::id();
        $form['content'] = $form['tweet'];
        unset($form['_token'], $form['tweet']);
        $tweet->fill($form)->save();

        return redirect()
            ->route('index')
            ->with('feedback.success', 'つぶやきを投稿しました。');
    }
}
