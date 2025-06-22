<!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
@extends('frontend.layouts.usermaster')

@section('user_content')
<div class="col-md-8 col-lg-9">
    <h2>
        <div class="d-flex justify-content-between">
            <span>Payment Package List</span>
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
                <th class="quicktech-postlist-th">Amount</th>
                <th class="quicktech-postlist-th">Package</th>
                <th class="quicktech-postlist-th">Status</th>
                <th class="quicktech-postlist-th">Invoice</th>
                <th class="quicktech-postlist-th">Order Date</th>
            </tr>
        </thead>
        <tbody class="quicktech-postlist-body">
            @foreach ($payment_packages as $payment_package)
            <tr class="quicktech-postlist-row">
                <td class="quicktech-postlist-td">{{ $loop->iteration }}</td>
                <td class="quicktech-postlist-td">{{ $payment_package->name }}</td>
                <td class="quicktech-postlist-td">
                    {{ $payment_package->total_amount }}
                </td>
                <td class="quicktech-postlist-td">
                    {{ $payment_package->package->name }}
                </td>
                <td class="quicktech-postlist-td">
                    {{ $payment_package->status }}
                </td>
                <td class="quicktech-postlist-td">{{ $payment_package->invoice_no }}</td>
                <td class="quicktech-postlist-td">
                    {{ $payment_package->order_date }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

