@extends('pages.sale-person.layout.app')

@section('content')

<div class="container-fluid" style="margin-left:20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">Customer Feedback</h4>

            <a href="{{ route('pages.sales.feedback.create') }}" class="btn btn-primary btn-sm">
                + Add Feedback
            </a>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Rating</th>
                            <th>Feedback</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td colspan="7" class="text-center">
                                No feedback found
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection