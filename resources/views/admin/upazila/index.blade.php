<!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<div class="col-md-8 col-lg-9">
    <h2>
        <div class="d-flex justify-content-between">
            <span>Upazila All</span>
            <a href="{{ route('admin.upazila.create') }}" class="btn btn-sm btn-primary pt-2">
                Create Upazila
            </a>
        </div>
    </h2>
    <table id="example" class="table table-striped quicktech-postlist-table">
        <thead class="quicktech-postlist">
            <tr>
                <th class="quicktech-postlist-th">SL</th>
                <th class="quicktech-postlist-th">Name</th>
                <th class="quicktech-postlist-th">District</th>
                <th class="quicktech-postlist-th">Division</th>
                <th class="quicktech-postlist-th">Url</th>
                <th class="quicktech-postlist-th" width="20%">Action</th>
            </tr>
        </thead>
        <tbody class="quicktech-postlist-body">
            @foreach ($upazilas as $upazila)
            <tr class="quicktech-postlist-row">
                <td class="quicktech-postlist-td">{{ $loop->iteration }}</td>
                <td class="quicktech-postlist-td">{{ $upazila->name }}</td>
                <td class="quicktech-postlist-td">
                    {{ $upazila->district->name }}
                </td>
                <td class="quicktech-postlist-td">
                    {{ $upazila->district->division->name }}
                </td>
                <td class="quicktech-postlist-td">{{ $upazila->url }}</td>
                <td class="quicktech-postlist-td" width="20%">
                    <a href="{{ route('admin.upazila.edit', $upazila->id) }}" class="btn btn-success btn-sm">
                        Edit
                    </a>
                    {{-- <a href="{{ route('admin.property-status.inactive', $upazila->id) }}" class="btn btn-danger btn-sm">
                        Delete
                    </a> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

