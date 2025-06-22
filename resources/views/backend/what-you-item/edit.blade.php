<!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="col-md-8 col-lg-9">
    <h1>WhatYou Item Edit</h1>
    <form action="{{ route('admin.what-you-item.update', $what_you_item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"
                value="{{ old('title', $what_you_item->title) }}">
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" placeholder="Enter description" name="description"
                rows="3" >{{ old('description', $what_you_item->description) }}</textarea>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Old Photo</label>
                <div class="">
                    <img src="{{ asset($what_you_item->photo) }}" alt="photo" height="80">
                </div>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" placeholder="Photo" name="photo"
                onchange="mainThumUrl(this)" value="{{ old('photo') }}">
                @error('photo')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <img src="" id="mainThmb">
            </div>
            <div class="">
                <button type="submit" class="btn btn-sm btn-info">Update</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
function mainThumUrl(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#mainThmb").attr("src",e.target.result).width(80);
            // .height(80)
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection

