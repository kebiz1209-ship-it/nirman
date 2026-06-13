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


.table th {
    background: #f4f6f9;
    font-size: 12px;
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
                Sample Requests
            </h3>



            <a href="{{route('pages.sales.samples.create')}}" class="btn btn-primary btn-sm">

                + Create Sample

            </a>


        </div>



        <div class="card-body">



            <!-- FILTERS -->


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
                            Requested
                        </option>

                        <option>
                            Under Development
                        </option>

                        <option>
                            Ready
                        </option>

                        <option>
                            Dispatched
                        </option>

                        <option>
                            Customer Testing
                        </option>

                        <option>
                            Approved
                        </option>

                        <option>
                            Rejected
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
                                Sample No
                            </th>


                            <th>
                                Customer
                            </th>


                            <th>
                                Product
                            </th>


                            <th>
                                Status
                            </th>


                            <th>
                                Dispatch Date
                            </th>


                            <th>
                                Feedback Status
                            </th>


                            <th>
                                Action
                            </th>


                        </tr>


                    </thead>



                    <tbody>



                        <tr>


                            <td>
                                SMP-1001
                            </td>


                            <td>
                                ABC Chemicals Pvt Ltd
                            </td>


                            <td>
                                Industrial Cleaner
                            </td>


                            <td>

                                <span class="badge bg-info">
                                    Requested
                                </span>

                            </td>


                            <td>
                                -
                            </td>


                            <td>
                                Pending
                            </td>



                            <td>


                                <a href="#" class="btn btn-primary btn-sm">

                                    View

                                </a>


                                <a href="#" class="btn btn-success btn-sm">

                                    Update

                                </a>


                            </td>



                        </tr>

                        <tr>


                            <td>
                                SMP-1002
                            </td>


                            <td>
                                XYZ Industries
                            </td>


                            <td>
                                Special Compound
                            </td>


                            <td>

                                <span class="badge bg-warning">
                                    Under Development
                                </span>

                            </td>


                            <td>
                                -
                            </td>


                            <td>
                                Pending
                            </td>



                            <td>


                                <a href="#" class="btn btn-primary btn-sm">

                                    View

                                </a>


                            </td>

                        </tr>

                        <tr>
                            <td>
                                SMP-1003
                            </td>


                            <td>
                                Prime Chemicals
                            </td>


                            <td>
                                Custom Formula Product
                            </td>


                            <td>

                                <span class="badge bg-success">
                                    Dispatched
                                </span>

                            </td>


                            <td>
                                15-06-2026
                            </td>


                            <td>
                                Customer Testing
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