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
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>12-Jun-2026</td>
                            <td>Rahul Sharma</td>
                            <td>CRM Software</td>
                            <td>
                                <span class="text-warning">
                                    ★★★★★
                                </span>
                            </td>
                            <td>Excellent service and timely support provided by the team.</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>10-Jun-2026</td>
                            <td>Priya Verma</td>
                            <td>ERP Solution</td>
                            <td>
                                <span class="text-warning">
                                    ★★★★☆
                                </span>
                            </td>
                            <td>Product is good but implementation took longer than expected.</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>08-Jun-2026</td>
                            <td>Amit Patel</td>
                            <td>Accounting Software</td>
                            <td>
                                <span class="text-warning">
                                    ★★★★★
                                </span>
                            </td>
                            <td>Very user-friendly and helped streamline our business process.</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>05-Jun-2026</td>
                            <td>Neha Singh</td>
                            <td>HR Management System</td>
                            <td>
                                <span class="text-warning">
                                    ★★★☆☆
                                </span>
                            </td>
                            <td>Features are useful but the UI could be improved.</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>01-Jun-2026</td>
                            <td>Vikram Gupta</td>
                            <td>Inventory Management</td>
                            <td>
                                <span class="text-warning">
                                    ★★★★☆
                                </span>
                            </td>
                            <td>Good experience overall. Customer support was responsive.</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm">
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