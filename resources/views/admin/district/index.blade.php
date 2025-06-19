<!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<div class="col-md-8 col-lg-9">
    <h2>
        <div class="d-flex justify-content-between">
            <span>District All</span>
            <a href="{{ route('admin.property-category.create') }}" class="btn btn-sm btn-primary pt-2">
                Create District
            </a>
        </div>
    </h2>
    <table id="example" class="table table-striped quicktech-postlist-table">
        <thead class="quicktech-postlist">
            <tr>
                <th class="quicktech-postlist-th">SL</th>
                <th class="quicktech-postlist-th">Name</th>
                <th class="quicktech-postlist-th">Division</th>
                <th class="quicktech-postlist-th">Latitude</th>
                <th class="quicktech-postlist-th">Longitude</th>
                <th class="quicktech-postlist-th">Url</th>
            </tr>
        </thead>
        <tbody class="quicktech-postlist-body">
            @foreach ($districts as $district)
            <tr class="quicktech-postlist-row">
                <td class="quicktech-postlist-td">{{ $loop->iteration }}</td>
                <td class="quicktech-postlist-td">{{ $district->name }}</td>
                <td class="quicktech-postlist-td">
                    {{ $district->division->name }}
                </td>
                <td class="quicktech-postlist-td">
                    {{ $district->lat }}
                </td>
                <td class="quicktech-postlist-td">
                    {{ $district->lon }}
                </td>
                <td class="quicktech-postlist-td">{{ $district->url }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <a href="{{ route('admin.property-status.active', $district->id) }}" class="btn btn-success btn-sm">
        Edit
    </a>
    <a href="{{ route('admin.property-status.inactive', $district->id) }}" class="btn btn-danger btn-sm">
        Delete
    </a> --}}
</div>
@endsection

