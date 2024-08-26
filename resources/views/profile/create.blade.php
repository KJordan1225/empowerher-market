@extends('layouts.app')

@section('content')

<!-- Display success message -->
@if(session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
@endif

<div class="col-9"> 
              
		@if (!is_null(auth()->user()->profile))
		<h2>Update profile for {{auth()->user()->name}}</h2>
		</br>
        @php 
            $profileItems = auth()->user()->profile;
        @endphp
		<form action="{{ route('profile.update', $profileItems->id) }}" method="POST">    
        @method('PUT')
        
		@else
		<h2>Create profile for {{auth()->user()->name}}</h2>
		</br>
		<form method="POST" action="{{ route('profile.store') }}">
		@endif	
	
		@csrf	            

			<!-- Title Textfield -->
			<div class="form-group">
				<label for="profile_title">Profile Title</label>
				<input type="text" class="form-control" id="profile_title" name="profile_title" 
					value="{{ old('profile_title', isset($profileItems->id) ? $profileItems->profile_title : '') }}">
			</div>
			@error('profile_title')
                <div class="error">{{ $message }}</div>
            @enderror

			<!-- Description Textfield -->
			<div class="form-group">
				<label for="profile_summary">Profile Summary</label>
				<textarea type="text" class="form-control" id="profile_summary" name="profile_summary" rows="16">
					{{ isset($profileItems->id) ? $profileItems->profile_summary : '' }}
				</textarea>
			</div>

			<!-- ADD CODE FOR IMAGE UPLOAD HERE -->

			<!-- END ADD CODE FOR IMAGE UPLOAD HERE -->
			
			<!-- Submit Button -->
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
</div>

@endsection