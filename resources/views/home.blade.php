@extends('layouts.default')
@section('title', '主页')
@section('content')
	<!-- <h1>主页</h1> -->
	@if( Auth::check() )
		<div class="row">
			<div class="col-md-8">
				<section class="status_from">
					@include('shared._status_form')
				</section>
				<h3>微博列表</h3>
				@include('shared._feed')
			</div>
			<aside class="col-md-4">
				<section class="user_info">
					@include('shared._user_info', ['user'=>Auth::user()])
				</section>
			</aside>
		</div>
	@else	
		<div class="jumbotron">
			<h1>welcome to laravel</h1>
			<p class="lead">
				你现在看到的是： <a href="#">Laravel</a>
			</p>
			<p>一切，将从这里开始</p>
			<p><a href="{{ route('signup') }}" class="btn btn-lg btn-success">现在注册</a></p>
		</div>
	@endif
@stop