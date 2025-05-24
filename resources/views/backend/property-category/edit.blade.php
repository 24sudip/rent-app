<!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="col-md-8 col-lg-9">
    <form action="{{ route('admin.property-category.update', $property_category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                value="{{ old('name') ?? $property_category->name }}">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category_photo" class="form-label">Category Photo</label>
                <input type="file" class="form-control" id="category_photo" placeholder="Category Photo" name="category_photo"
                onchange="mainThumUrl(this)">
                @error('category_photo')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <img src="" id="mainThmb">
                <div class="">
                    <label class="form-label mt-3">Old Category Photo</label>
                </div>
                <div class="mt-2">
                    <img src="{{ asset($property_category->category_photo) }}" width="100">
                </div>
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
            $("#mainThmb").attr("src",e.target.result).width(100);
            // .height(80)
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection

