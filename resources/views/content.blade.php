@extends('layouts.master')
@section('title')
	potato
@endsection

@section('content')
	@include('includes.message-block');
	<div class="row">
		<div class="col-md-6">
			<h3>Sign Up</h3>
			<form action="{{ route('signup') }}" method="post">
			<div class="form-group ">
					<label for="email">Your E-mail</label>
				<input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{Request::old('email')}}">
				</div>
				<div class="form-group">
					<label for="first_name">Your First Name</label>
					<input class="form-control  {{$errors->has('first_name')? 'is-invalid':''}}" type="text" name="first_name" id="first_name" value="{{Request::old('first_name')}}">
				</div>
				<div class="form-group">
					<label for="password">Your Password</label>
					<input class="form-control {{$errors->has('password')? 'is-invalid':''}}" type="password" name="password" id="password" value="{{Request::old('password')}}">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}">
			</form>
		</div>
		<div class="col-md-6">
			<h3>Sign Ip</h3>
			<form action="{{ route('signin') }}" method="post">
				<div class="form-group">
					<label for="email">E-mail</label>
					<input class="form-control {{$errors->has('email')? 'is-invalid':''}}" type="text" name="email" id="email" value="{{Request::old('email')}}">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control {{$errors->has('password')? 'is-invalid':''}}" type="password" name="password" id="password" value="{{Request::old('password')}}">
				</div>
				<button type="submit" class="btn btn-primary">Login</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
		</div>
	</div>
@endsection
