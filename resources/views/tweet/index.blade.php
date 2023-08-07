@extends('layouts.basic')


@section('page-title', 'TOP | つぶやき')


@section('sub-title', 'トップページ')


@section('content')
	@if (session('feedback.success'))
		<p class="msg success-msg">{{session('feedback.success')}}</p>
	@endif

	@error('tweet')
		<p class="msg error-msg">{{$message}}</p>
	@enderror

	<form class="form" action="{{route('create')}}" method="post">
		@csrf
		<div class="input-area">
			<textarea name="tweet" class="input" placeholder="つぶやきを入力（140字以内）"></textarea>
			<input class="btn submit-btn" type="submit" value="送信">
		</div>
	</form>

	<div class="tweet-list">
		<ul>
			@foreach ($tweets as $tweet)
				<li class="tweet">
					<p>{{$tweet->content}} by {{$tweet->getUserName()}}</p>
					@if (\Illuminate\Support\Facades\Auth::id() === $tweet->user_id)
						<a href="{{route('edit.edit', ['tweetId' => $tweet->id])}}" class="btn edit-btn">編集</a>
						<a href="{{route('delete', ['tweetId' => $tweet->id])}}" class="btn edit-btn">削除</a>
					@endif
				</li>
			@endforeach
		</ul>
	</div>
	{{$tweets->links('vendor.pagination.tweet')}}
@endsection
