@extends('pages.product_head.layout.app')

@section('content')

<style>
.table th {
    white-space: nowrap;
}

.badge {
    padding: 6px 10px;
}

.card-stats {
    padding: 15px;
    border-radius: 8px;
    color: #fff;
}

.card-stats h3 {
    margin: 0;
}
</style>


<div class="container-fluid" style="margin-left:30px;">


    <!-- KPI SECTION -->
    <!-- <div class="row mb-3">


        <div class="col-md-3">

            <div class="card-stats bg-primary">

                <h3>18</h3>

                <p>Planned Orders</p>

            </div>

        </div>



        <div class="col-md-3">

            <div class="card-stats bg-success">

                <h3>10</h3>

                <p>In Production</p>

            </div>

        </div>



        <div class="col-md-3">

            <div class="card-stats bg-warning">

                <h3>5</h3>

                <p>Pending Scheduling</p>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card-stats bg-danger">

                <h3>2</h3>

                <p>Delayed</p>

            </div>

        </div>

    </div> -->

    <!-- MAIN CARD -->
    <div class="card">


        <div class="card-header">

            <h4>Production Planning</h4>

        </div>

        <div class="card-body">

            <!-- FILTERS -->
            <div class="row mb-3">


                <div class="col-md-2">

                    <label>Order No</label>

                    <input type="text" class="form-control">

                </div>


                <div class="col-md-2">

                    <label>Product</label>

                    <select class="form-control">

                        <option>All</option>

                    </select>

                </div>

                <div class="col-md-2">

                    <label>Machine</label>

                    <select class="form-control">

                        <option>All</option>

                        <option>Mixer 1</option>

                        <option>Mixer 2</option>

                        <option>Reactor A</option>

                    </select>

                </div>

                <div class="col-md-2">

                    <label>Status</label>

                    <select class="form-control">

                        <option>All</option>

                        <option>Planned</option>

                        <option>In Progress</option>

                        <option>Completed</option>

                        <option>Delayed</option>

                    </select>

                </div>



                <div class="col-md-2">

                    <label>Start Date</label>

                    <input type="date" class="form-control">

                </div>



                <div class="col-md-2">

                    <label>End Date</label>

                    <input type="date" class="form-control">

                </div>



            </div>


            <div class="mb-3">

                <button class="btn btn-info">Search</button>
                <button class="btn btn-secondary">Reset</button>
                <button class="btn btn-primary">+ Schedule Production</button>

            </div>


            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>Order</th>

                            <th>Customer</th>

                            <th>Product</th>

                            <th>Batch Qty</th>

                            <th>Machine</th>

                            <th>Start Date</th>

                            <th>End Date</th>

                            <th>Status</th>

                            <th>Priority</th>

                            <th>QC Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>ORD1001</td>

                            <td>ABC Pharma</td>

                            <td>Bio Growth Plus</td>

                            <td>5000 LTR</td>

                            <td>Mixer 1</td>

                            <td>20-06-2026</td>

                            <td>21-06-2026</td>

                            <td>

                                <span class="badge badge-primary">Planned</span>

                            </td>

                            <td>

                                <span class="badge badge-danger">High</span>

                            </td>

                            <td>

                                <span class="badge badge-warning">Pending</span>

                            </td>

                            <td>

                                <a href="#" class="btn btn-sm btn-info">View</a>

                                <a href="#" class="btn btn-sm btn-success">Start</a>

                            </td>

                        </tr>

                        <tr>


                            <td>ORD1002</td>

                            <td>XYZ Healthcare</td>

                            <td>Protein Mix</td>

                            <td>2500 KG</td>

                            <td>Reactor A</td>

                            <td>19-06-2026</td>

                            <td>20-06-2026</td>



                            <td>

                                <span class="badge badge-success">In Progress</span>
                            </td>

                            <td>
                                <span class="badge badge-warning">Medium</span>

                            </td>

                            <td>
                                <span class="badge badge-primary">Running</span>
                            </td>

                            <td>
                                <a href="#" class="btn btn-sm btn-info">View</a>

                                <a href="#" class="btn btn-sm btn-warning">Pause</a>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection