@extends('pages.product_head.layout.app')


@section('content')



<div class="container-fluid">




    <!-- Order -->


    <div class="card mb-3">


        <div class="card-header">


            <h5>

                Order Summary

            </h5>


        </div>



        <div class="card-body">


            <div class="row">


                <div class="col-md-3">

                    Order

                    <br>

                    <b>ORD1001</b>

                </div>



                <div class="col-md-3">

                    Customer

                    <br>

                    <b>ABC Pharma</b>

                </div>



                <div class="col-md-3">

                    Product

                    <br>

                    <b>Bio Growth Plus</b>

                </div>




                <div class="col-md-3">

                    Qty

                    <br>

                    <b>5000 LTR</b>

                </div>



            </div>



        </div>

    </div>




    <!-- Formula -->


    <div class="card mb-3">


        <div class="card-header">

            Formula


        </div>



        <div class="card-body">



            Version : V2.1


            <br>


            Batch : 5000



            <br>


            Concurrent : 5




        </div>



    </div>





    <!-- RM -->


    <div class="card mb-3">


        <div class="card-header">


            Raw Material Availability


        </div>



        <div class="card-body">


            <table class="table table-bordered">


                <thead>



                    <tr>


                        <th>Code</th>

                        <th>Material</th>

                        <th>Required</th>

                        <th>Stock</th>

                        <th>Reserved</th>

                        <th>Available</th>

                        <th>Status</th>


                    </tr>



                </thead>




                <tbody>



                    <tr>

                        <td>

                            RM001

                        </td>

                        <td>

                            Water

                        </td>

                        <td>

                            1000

                        </td>

                        <td>

                            1200

                        </td>

                        <td>

                            100

                        </td>

                        <td>

                            1100

                        </td>



                        <td>


                            <span class="badge badge-success">

                                Available


                            </span>


                        </td>



                    </tr>




                    <tr>


                        <td>

                            RM002

                        </td>


                        <td>

                            Culture


                        </td>


                        <td>

                            500


                        </td>


                        <td>

                            300


                        </td>


                        <td>

                            50


                        </td>


                        <td>

                            250


                        </td>



                        <td>


                            <span class="badge badge-danger">

                                Shortage


                            </span>



                        </td>



                    </tr>



                </tbody>



            </table>



        </div>



    </div>




    <!-- Packaging -->


    <div class="card mb-3">


        <div class="card-header">


            Packaging Availability


        </div>



        <div class="card-body">


            <table class="table table-bordered">


                <tr>

                    <th>Material</th>

                    <th>Required</th>

                    <th>Stock</th>

                    <th>Status</th>


                </tr>



                <tr>

                    <td>Bottle</td>

                    <td>5000</td>

                    <td>6000</td>

                    <td>

                        <span class="badge badge-success">

                            Available

                        </span>


                    </td>


                </tr>



            </table>


        </div>


    </div>






    <!-- Capacity -->

    <div class="card mb-3">


        <div class="card-header">


            Capacity Check


        </div>



        <div class="card-body">


            <div class="row">



                <div class="col-md-3">

                    Machine


                    <br>

                    Mixer 01

                </div>



                <div class="col-md-3">


                    Utilization


                    <br>

                    72%

                </div>




                <div class="col-md-3">


                    Free Slot


                    <br>

                    22-Jun-2026

                </div>




                <div class="col-md-3">
                    Operator
                    <br>
                    Amit

                </div>

            </div>

        </div>

    </div>

    <!-- Actions -->

    <div class="card">

        <div class="card-body text-center">

            <button class="btn btn-success">
                Approve

            </button>

            <button class="btn btn-warning">
                Raise Query

            </button>

            <button class="btn btn-danger">

                Reject

            </button>

            <button class="btn btn-secondary">

                Hold
            </button>

        </div>

    </div>

</div>



@endsection