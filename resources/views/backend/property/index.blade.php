<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
@extends('rent-frontend.frontend-dashboard')

@section('frontent_content')
<!-- user dashboard -->
    <section id="quicktech-doctors-panel" style="margin-top:56px;">
        <div class="container">
            <div class="row gapp mb-5">
                <div class="col-lg-3">
                    <div class="quicktech-doctor-panel-menu">
                        @include('manager.body.sidebar')
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="quicktech-doc-right-panel">
                        <div class="quikctech-post-list-all">
                            <table class="table table-striped quicktech-postlist-table">
                                <thead class="quicktech-postlist">
                                    <tr>
                                        <th class="quicktech-postlist-th">Title</th>
                                        <th class="quicktech-postlist-th">Available Rooms</th>
                                        <th class="quicktech-postlist-th">Location</th>
                                        <th class="quicktech-postlist-th">Property Owner Name</th>
                                        <th class="quicktech-postlist-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="quicktech-postlist-body">
                                    @foreach ($properties as $property)
                                    <tr class="quicktech-postlist-row">
                                        <td class="quicktech-postlist-td">{{ $property->title }}</td>
                                        <td class="quicktech-postlist-td">
                                            @foreach ($property->rooms as $room)
                                            <span>
                                                {{ $room->share_type }},
                                            </span>
                                            @endforeach
                                        </td>
                                        <td class="quicktech-postlist-td">
                                            {{ $property->upazila->name }}, {{ $property->district->name }}
                                        </td>
                                        <td class="quicktech-postlist-td">{{ $property->owner_name }}</td>
                                        <td class="quicktech-postlist-td">
                                            <a href="{{ route('manager.property.show', $property->id) }}" class="btn btn-primary btn-sm">
                                                View Details
                                            </a>
                                            <a href="{{ route('manager.property.edit', $property->id) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('manager.property.delete', $property->id) }}"
                                            class="btn btn-danger btn-sm" id="delete"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- user dashboard -->
@endsection
