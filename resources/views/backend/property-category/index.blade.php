<!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<div class="col-md-8 col-lg-9">
    <h2>
        <div class="d-flex justify-content-between">
            <span>Property Category</span>
            <a href="{{ route('admin.property-category.create') }}" class="btn btn-sm btn-primary pt-2">
                Create Property Category
            </a>
        </div>
    </h2>
    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">SL</th>
                <th scope="col">Name</th>
                <th scope="col">Photo</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($property_categories as $property_category)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $property_category->name }}</td>
                <td>
                    <img src="{{ asset($property_category->category_photo) }}" width="80">
                </td>
                <td>{{ $property_category->created_at }}</td>
                <td>
                    <a href="{{ route('admin.property-category.edit', $property_category->id) }}" class="btn btn-sm btn-success">Edit</a>
                    <a href="{{ route('admin.property-category.delete', $property_category->id) }}"
                    class="btn btn-sm btn-danger delete-item">Delete</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No Category Available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
