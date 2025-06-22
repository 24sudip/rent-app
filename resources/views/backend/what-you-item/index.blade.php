<!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<div class="col-md-8 col-lg-9">
    <h2>
        <div class="d-flex justify-content-between">
            <span>WhatYou Items All</span>
            <a href="{{ route('admin.what-you-item.create') }}" class="btn btn-sm btn-primary pt-2">
                Create WhatYou Items
            </a>
        </div>
    </h2>
    <table id="example" class="table table-striped quicktech-postlist-table">
        <thead class="quicktech-postlist">
            <tr>
                <th class="quicktech-postlist-th">SL</th>
                <th class="quicktech-postlist-th">Title</th>
                <th class="quicktech-postlist-th">Photo</th>
                <th class="quicktech-postlist-th">Description</th>
                <th class="quicktech-postlist-th">Action</th>
            </tr>
        </thead>
        <tbody class="quicktech-postlist-body">
            @foreach ($what_you_items as $what_you_item)
            <tr class="quicktech-postlist-row">
                <td class="quicktech-postlist-td">{{ $loop->iteration }}</td>
                <td class="quicktech-postlist-td">{{ $what_you_item->title }}</td>
                <td class="quicktech-postlist-td">
                    <img src="{{ asset($what_you_item->photo) }}" alt="photo" height="80">
                </td>
                <td class="quicktech-postlist-td">
                    {{ $what_you_item->description }}
                </td>
                <td class="quicktech-postlist-td">
                    <a href="{{ route('admin.what-you-item.edit', $what_you_item->id) }}" class="btn btn-success btn-sm">
                        Edit
                    </a>
                    <a href="{{ route('admin.what-you-item.delete', $what_you_item->id) }}" class="btn btn-danger btn-sm  delete-item">
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

