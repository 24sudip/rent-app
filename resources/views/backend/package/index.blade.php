<!-- When there is no desire, all things are at peace. - Laozi -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<div class="col-md-8 col-lg-9">
    <h2>
        <div class="d-flex justify-content-between">
            <span>Package</span>
            <a href="{{ route('admin.package.create') }}" class="btn btn-sm btn-primary pt-2">
                Create Package
            </a>
        </div>
    </h2>
    <table class="table table-bordered table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">SL</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Maximum Post</th>
                <th scope="col">Duration</th>
                <th scope="col">Status</th>
                <th scope="col">Premium</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($packages as $package)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $package->name }}</td>
                <td>
                    {{ $package->price }}
                </td>
                <td>{{ $package->maximum_post }}</td>
                <td>{{ $package->duration }}</td>
                <td>
                    @if ($package->status == 0)
                    <span class="badge bg-danger rounded-pill">Inactive</span>
                    @elseif ($package->status == 1)
                    <span class="badge bg-success rounded-pill">Active</span>
                    @endif
                </td>
                <td>{{ $package->type }}</td>
                <td>
                    <a href="{{ route('admin.package.edit', $package->id) }}" class="btn btn-sm btn-success">Edit</a>
                    <a href="{{ route('admin.package.delete', $package->id) }}"
                    class="btn btn-sm btn-danger delete-item">Delete</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No Package Available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

