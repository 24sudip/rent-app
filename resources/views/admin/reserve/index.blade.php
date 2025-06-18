<!-- Order your soul. Reduce your wants. - Augustine -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<div class="col-md-8 col-lg-9">
    <h2>
        <div class="d-flex justify-content-between">
            <span>Reserve Property List</span>
            {{-- <a href="{{ route('admin.property-category.create') }}" class="btn btn-sm btn-primary pt-2">
                Create Property Category
            </a> --}}
        </div>
    </h2>
    <table id="example" class="table table-striped quicktech-postlist-table">
        <thead class="quicktech-postlist">
            <tr>
                <th class="quicktech-postlist-th">SL</th>
                <th class="quicktech-postlist-th">Customer fullName</th>
                <th class="quicktech-postlist-th">Manager</th>
                <th class="quicktech-postlist-th">Room Type</th>
                <th class="quicktech-postlist-th">Date</th>
                <th class="quicktech-postlist-th">Time</th>
            </tr>
        </thead>
        <tbody class="quicktech-postlist-body">
            @foreach ($reserves as $reserve)
            <tr class="quicktech-postlist-row">
                <td class="quicktech-postlist-td">{{ $loop->iteration }}</td>
                <td class="quicktech-postlist-td">{{ $reserve->fullName }}</td>
                <td class="quicktech-postlist-td">
                    {{ $reserve->property->manager->name }}
                </td>
                <td class="quicktech-postlist-td">
                    {{ $reserve->sharingType }}
                </td>
                <td class="quicktech-postlist-td">{{ date('d F, Y', strtotime($reserve->date)) }}</td>
                <td class="quicktech-postlist-td">
                    {{ $reserve->time }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

