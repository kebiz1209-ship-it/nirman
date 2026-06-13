@extends('pages.sale-person.layout.app')

@section('content')

<div class="container-fluid" style="margin-left:15px;">

    <div class="card">

        <div class="card-header">
            <h4 class="mb-0">Payment Follow Up</h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice No</th>
                            <th>Invoice Amount</th>
                            <th>Received Amount</th>
                            <th>Balance Amount</th>
                            <th>Due Date</th>
                            <th>Follow Up Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>INV-1001</td>
                            <td>₹ 50,000.00</td>
                            <td>₹ 20,000.00</td>
                            <td>₹ 30,000.00</td>
                            <td>15-Jun-2026</td>
                            <td>13-Jun-2026</td>
                            <td><span class="badge badge-warning">Partial</span></td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>INV-1002</td>
                            <td>₹ 35,000.00</td>
                            <td>₹ 0.00</td>
                            <td>₹ 35,000.00</td>
                            <td>18-Jun-2026</td>
                            <td>14-Jun-2026</td>
                            <td><span class="badge badge-danger">Pending</span></td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>INV-1003</td>
                            <td>₹ 25,000.00</td>
                            <td>₹ 25,000.00</td>
                            <td>₹ 0.00</td>
                            <td>10-Jun-2026</td>
                            <td>10-Jun-2026</td>
                            <td><span class="badge badge-success">Received</span></td>
                        </tr>

                

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection