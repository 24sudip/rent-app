<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<div class="col-md-8 col-lg-9">
    <h2>
        <div class="d-flex justify-content-between">
            <span>Property Status Change</span>
            {{-- <a href="{{ route('admin.property-category.create') }}" class="btn btn-sm btn-primary pt-2">
                Create Property Category
            </a> --}}
        </div>
    </h2>
    <table id="example" class="table table-striped quicktech-postlist-table">
        <thead class="quicktech-postlist">
            <tr>
                <th class="quicktech-postlist-th">SL</th>
                <th class="quicktech-postlist-th">Title</th>
                <th class="quicktech-postlist-th">Status</th>
                <th class="quicktech-postlist-th">Location</th>
                <th class="quicktech-postlist-th">Property Owner Name</th>
                <th class="quicktech-postlist-th">Action</th>
            </tr>
        </thead>
        <tbody class="quicktech-postlist-body">
            @foreach ($properties as $property)
            <tr class="quicktech-postlist-row">
                <td class="quicktech-postlist-td">{{ $loop->iteration }}</td>
                <td class="quicktech-postlist-td">{{ $property->title }}</td>
                <td class="quicktech-postlist-td">
                    @if ($property->status == 0)
                    <span class="badge bg-danger">Inactive</span>
                    @else
                    <span class="badge bg-success">Active</span>
                    @endif
                </td>
                <td class="quicktech-postlist-td">
                    {{ $property->upazila->name }}, {{ $property->district->name }}
                </td>
                <td class="quicktech-postlist-td">{{ $property->owner_name }}</td>
                <td class="quicktech-postlist-td">
                    @if ($property->status == 0)
                    <a href="{{ route('admin.property-status.active', $property->id) }}" class="btn btn-success btn-sm">
                        Active
                    </a>
                    @else
                    <a href="{{ route('admin.property-status.inactive', $property->id) }}" class="btn btn-danger btn-sm">
                        Inactive
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

