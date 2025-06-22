<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="col-md-8 col-lg-9">
    <form action="{{ route('admin.what-you-setting.update', 1) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"
                value="{{ old('title', $what_you_setting->title) }}">
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="sub_title" class="form-label">Sub Title</label>
                <input type="text" class="form-control" id="sub_title" placeholder="Enter sub-title" name="sub_title"
                value="{{ old('sub_title', $what_you_setting->sub_title) }}">
                @error('sub_title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Video file</label>
                <input type="file" class="form-control" id="video" placeholder="Video" name="video" accept="video/mp4,
                video/webm"
                value="{{ old('video') }}">
                @error('video')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="">
                    <video width="300" height="130" controls>
                        <source src="{{ asset($what_you_setting->video) }}" type="video/webm">
                    </video>
                </div>
            </div>
            <div class="">
                <button type="submit" class="btn btn-sm btn-info">Upload</button>
            </div>
        </div>
    </form>
</div>
@endsection

