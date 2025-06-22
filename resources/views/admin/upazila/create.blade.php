<!-- Life is available only in the present moment. - Thich Nhat Hanh -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="col-md-8 col-lg-9">
    <form action="{{ route('admin.upazila.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="mb-3">
                <label for="district_id" class="form-label">District</label>
                <select class="form-control" id="district_id" placeholder="Enter District" name="district_id">
                    <option value="">Select A District</option>
                    @foreach ($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                </select>
                @error('district_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                value="{{ old('name') }}">
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="bn_name" class="form-label">Bangla name</label>
                <input type="text" class="form-control" id="bn_name" placeholder="Enter bangla name" name="bn_name"
                value="{{ old('bn_name') }}">
                @error('bn_name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">Url</label>
                <input type="url" class="form-control" id="url" placeholder="Enter url" name="url"
                value="{{ old('url') }}">
                @error('url')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="">
                <button type="submit" class="btn btn-sm btn-info">Save</button>
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

