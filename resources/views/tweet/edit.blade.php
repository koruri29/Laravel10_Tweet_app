@extends('layouts.basic')


@section('page-title', '編集 | つぶやき')


@section('sub-title', '編集ページ')


@section('content')
	<a href="{{route('index')}}">&laquo;トップへ</a>
	@error('tweet')
		<p class="msg error-msg">{{$message}}</p>
	@enderror
	<div class="input-area">
		<form class="form" action="{{route('edit.update', ['tweetId' => $tweet->id])}}" method="post">
			@csrf
			<textarea name="tweet" class="input" placeholder="つぶやきを入力（140字以内）">{{$tweet->content}}</textarea>
			<input class="btn submit-btn" type="submit" value="更新">
		</form>
	</div>
@endsection
