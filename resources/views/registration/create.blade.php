@extends('layouts.master')

@section('content')
	<div class="col-sm-8 blog-main">
		<h3>Register</h3>

		<form method="POST" action="/register">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" name="name" value="{{ Request::old('name') }}" required>
			</div>

			{{-- value="{{ Request::old('email')}}" helps remember old values filled in the fiels if submission failed --}}

			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" name="email" value="{{ Request::old('email') }}" required>
			</div>

			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="password" name="password" required>
			</div>

			<div class="form-group">
				<label for="password">Password Confirmation:</label>
				<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
				{{-- name and id need to be password_confirmation for auto. confirnation --}}
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Register</button>
			</div>

			@include('layouts.errors')
			
		</form>
	</div>
@endsection