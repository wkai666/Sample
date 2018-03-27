@extends('layouts.default')
@section('title', '主页')
@section('content')
	<!-- <h1>主页</h1> -->
	<div class="jumbotron">
		<h1>welcome to laravel</h1>
		<p class="lead">
			你现在看到的是： <a href="#">哈哈哈</a>
		</p>
		<p>一切，将从这里开始</p>
		<p><a href="{{ route('signup') }}" class="btn btn-lg btn-success">现在注册</a></p>
	</div>
@stop