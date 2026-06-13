@extends('pages.sale-person.layout.app')

@section('content')

<div class="container-fluid" style="margin-left: 20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">Order List</h3>

            <a href="{{ route('pages.sales.order.create') }}"
               class="btn btn-primary btn-sm">

                + Create Order

            </a>

        </div>

        <div class="card-body">

            <p>Welcome to Sales Person Order Page.</p>

            <div class="table-responsive mt-3">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>ORD-001</td>
                            <td>Demo Customer</td>
                            <td>{{ date('d-m-Y') }}</td>
                            <td>
                                <span class="badge badge-success">
                                    Pending
                                </span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">
                                    View
                                </a>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection