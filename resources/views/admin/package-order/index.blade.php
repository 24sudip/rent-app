<!-- The whole future lies in uncertainty: live immediately. - Seneca -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<div class="col-md-8 col-lg-9">
    <h2>
        <div class="d-flex justify-content-between">
            <span>Package Order Confirm</span>
            {{-- <a href="{{ route('admin.property-category.create') }}" class="btn btn-sm btn-primary pt-2">
                Create Property Category
            </a> --}}
        </div>
    </h2>
    <table id="example" class="table table-striped quicktech-postlist-table">
        <thead class="quicktech-postlist">
            <tr>
                <th class="quicktech-postlist-th">SL</th>
                <th class="quicktech-postlist-th">Manager</th>
                <th class="quicktech-postlist-th">Status</th>
                <th class="quicktech-postlist-th">Package</th>
                <th class="quicktech-postlist-th">Invoice No</th>
                <th class="quicktech-postlist-th">Action</th>
            </tr>
        </thead>
        <tbody class="quicktech-postlist-body">
            @foreach ($package_orders as $package_order)
            <tr class="quicktech-postlist-row">
                <td class="quicktech-postlist-td">{{ $loop->iteration }}</td>
                <td class="quicktech-postlist-td">{{ $package_order->user->name }}</td>
                <td class="quicktech-postlist-td">
                    @if ($package_order->status == 0)
                    <span class="badge bg-danger">Pending</span>
                    @else
                    <span class="badge bg-success">Confirmed</span>
                    @endif
                </td>
                <td class="quicktech-postlist-td">
                    {{ $package_order->package->name }}
                </td>
                <td class="quicktech-postlist-td">{{ $package_order->invoice_no }}</td>
                <td class="quicktech-postlist-td">
                    @if ($package_order->status == 0)
                    <a href="{{ route('admin.package-order.confirm', $package_order->id) }}" class="btn btn-success btn-sm">
                        Confirm
                    </a>
                    @else
                    <a href="{{ route('admin.package-order.withdraw', $package_order->id) }}" class="btn btn-danger btn-sm">
                        Withdraw
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

