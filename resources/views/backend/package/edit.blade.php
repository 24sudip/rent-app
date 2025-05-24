<!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="col-md-8 col-lg-9">
    <form action="{{ route('admin.package.update', $package->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control form-control-solid @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" name="name" value="{{ old('name') ?? $package->name }}">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control form-control-solid @error('price') is-invalid @enderror" id="price" placeholder="Enter Price" name="price" value="{{ old('price') ?? $package->price }}">
                @error('price')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="maximum_post" class="form-label">Maximum Post</label>
                <input type="number" class="form-control form-control-solid @error('maximum_post') is-invalid @enderror" id="maximum_post" placeholder="Enter Maximum Post" name="maximum_post" value="{{ old('maximum_post') ?? $package->maximum_post }}">
                @error('maximum_post')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duration In Days</label>
                <input type="number" class="form-control form-control-solid @error('duration') is-invalid @enderror" id="duration" placeholder="Enter Duration" name="duration" value="{{ old('duration') ?? $package->duration }}">
                @error('duration')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <textarea class="form-control form-control-solid @error('short_description') is-invalid @enderror" id="short_description" placeholder="Enter Short Description" name="short_description"
                rows="2">{{ old('short_description') ?? $package->short_description }}</textarea>
                @error('short_description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select class="form-control form-control-solid @error('status') is-invalid @enderror" placeholder="Enter Status" name="status">
                    <option value="">Select a status</option>
                    <option value="1" {{ old('status', $package->status) == "1" ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $package->status) == "0" ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select type="text" class="form-control form-control-solid @error('type') is-invalid @enderror" id="type" placeholder="Enter Type" name="type">
                    <option value="">Select a type</option>
                    <option value="Free" {{ old('type', $package->type) == "Free" ? 'selected' : '' }}>Free</option>
                    <option value="Premium" {{ old('type', $package->type) == "Premium" ? 'selected' : '' }}>Premium</option>
                </select>
                @error('type')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="">
                <button type="submit" class="btn btn-sm btn-info">Update</button>
            </div>
        </div>
    </form>
</div>
{{-- <script type="text/javascript">
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
</script> --}}
@endsection
