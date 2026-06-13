@extends('pages.sale-person.layout.app')

@section('content')


<style>
.compact-page .form-control {
    height: 32px;
    font-size: 12px;
    padding: 4px 8px;
}


.compact-page label {
    font-size: 12px;
    font-weight: 600;
}


.card-header h3 {
    font-size: 18px;
    font-weight: 700;
}


.filter-btn {
    font-size: 12px;
    padding: 6px 12px;
}


.table th {
    font-size: 12px;
    background: #f4f6f9;
}


.table td {
    font-size: 12px;
    vertical-align: middle;
}


.badge {
    font-size: 11px;
    padding: 5px 8px;
}
</style>



<div class="container-fluid compact-page" style="margin-left:20px;">


    <div class="card shadow-sm">



        <div class="card-header d-flex justify-content-between align-items-center">


            <h3 class="mb-0">
                My Follow Ups
            </h3>



            <a href="{{route('pages.sales.followups.create')}}" class="btn btn-primary btn-sm">

                + Add Follow-Up

            </a>



        </div>




        <div class="card-body">



            <!-- FILTERS -->


            <div class="mb-3">


                <a href="#" class="btn btn-primary filter-btn">

                    Today's Follow-ups

                </a>


                <a href="#" class="btn btn-danger filter-btn">

                    Overdue Follow-ups

                </a>


                <a href="#" class="btn btn-success filter-btn">

                    Completed

                </a>


                <a href="#" class="btn btn-warning filter-btn">

                    Upcoming

                </a>



            </div>




            <div class="row mb-3">


                <div class="col-md-3">

                    <label>
                        Customer
                    </label>

                    <select class="form-control">

                        <option>
                            All Customers
                        </option>

                        <option>
                            ABC Chemicals
                        </option>

                        <option>
                            XYZ Industries
                        </option>

                    </select>


                </div>

                <div class="col-md-3">

                    <label>
                        Status
                    </label>

                    <select class="form-control">

                        <option>
                            All Status
                        </option>

                        <option>
                            Pending
                        </option>

                        <option>
                            Completed
                        </option>

                        <option>
                            Cancelled
                        </option>

                    </select>


                </div>




                <div class="col-md-3">

                    <label>
                        From Date
                    </label>

                    <input type="date" class="form-control">


                </div>




                <div class="col-md-3">

                    <label>
                        To Date
                    </label>

                    <input type="date" class="form-control">


                </div>



            </div>





            <!-- TABLE -->


            <div class="table-responsive">


                <table class="table table-bordered table-hover">


                    <thead>

                        <tr>

                            <th>
                                Date
                            </th>


                            <th>
                                Customer
                            </th>


                            <th>
                                Order
                            </th>


                            <th>
                                Discussion
                            </th>


                            <th>
                                Next Follow-Up
                            </th>


                            <th>
                                Status
                            </th>


                            <th>
                                Action
                            </th>


                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>
                                12-06-2026
                            </td>


                            <td>
                                ABC Chemicals Pvt Ltd
                            </td>

                            <td>
                                ORD-1001
                            </td>
                            <td>
                                Discussed product requirement and pricing
                            </td>
                            <td>
                                15-06-2026
                            </td>
                            <td>

                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            </td>

                            <td>
                                <a href="#" class="btn btn-success btn-sm">

                                    Complete

                                </a>


                                <a href="#" class="btn btn-primary btn-sm">

                                    View

                                </a>
                            </td>

                        </tr>
                        <tr>
                            <td>
                                10-06-2026
                            </td>
                            <td>
                                XYZ Industries
                            </td>
                            <td>
                                ORD-1002
                            </td>
                            <td>
                                Payment discussion completed
                            </td>
                            <td>
                                13-06-2026
                            </td>
                            <td>

                                <span class="badge bg-success">
                                    Completed
                                </span>

                              </td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm">
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