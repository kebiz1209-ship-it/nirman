@extends('pages.sale-person.layout.app')

@section('content')


<style>
.compact-form .form-group {
    margin-bottom: 8px;
}

.compact-form label {
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 3px;
}

.compact-form .form-control {
    height: 32px;
    font-size: 12px;
    padding: 4px 8px;
}


.compact-form textarea.form-control {
    height: 70px;
}


.compact-form .btn {
    height: 32px;
    font-size: 12px;
}


.section-title {
    font-size: 18px;
    font-weight: 700;
    background: #f4f6f9;
    padding: 10px 12px;
    border-left: 4px solid #007bff;
    border-radius: 5px;
    margin-bottom: 15px;
}


.section-break {
    margin: 18px 0;
    border-top: 1px dashed #dcdcdc;
}
</style>



<div class="container-fluid compact-form" style="margin-left:20px;">


    <div class="card shadow-sm">



        <div class="card-header d-flex justify-content-between align-items-center">


            <h3 class="mb-0">
                Create Sample Request
            </h3>



            <a href="{{route('pages.sales.samples')}}" class="btn btn-secondary btn-sm">

                Back

            </a>


        </div>


        <div class="card-body">


            <form method="POST">

                @csrf

                <div class="section-title">
                    Sample Details
                </div>


                <div class="row">


                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Sample No
                            </label>

                            <input type="text" class="form-control" value="SMP-1001" readonly>

                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Request Date
                            </label>

                            <input type="date" class="form-control">


                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Customer
                            </label>


                            <select class="form-control">

                                <option>
                                    Select Customer
                                </option>

                                <option>
                                    ABC Chemicals
                                </option>

                                <option>
                                    XYZ Industries
                                </option>


                            </select>


                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Order Request
                            </label>


                            <select class="form-control">

                                <option>
                                    Select Order Request
                                </option>

                                <option>
                                    OR-1001
                                </option>

                                <option>
                                    OR-1002
                                </option>


                            </select>


                        </div>

                    </div>



                </div>



                <div class="section-break"></div>



                <!-- PRODUCT DETAILS -->


                <div class="section-title">
                    Product Details
                </div>



                <div class="row">



                    <div class="col-md-4">

                        <div class="form-group">

                            <label>
                                Product
                            </label>


                            <select class="form-control">

                                <option>
                                    Select Product
                                </option>

                                <option>
                                    Product A
                                </option>

                                <option>
                                    Product B
                                </option>


                            </select>


                        </div>

                    </div>




                    <div class="col-md-2">

                        <div class="form-group">

                            <label>
                                Sample Qty
                            </label>


                            <input type="number" class="form-control">


                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Required Date
                            </label>


                            <input type="date" class="form-control">


                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Purpose
                            </label>


                            <select class="form-control">

                                <option>
                                    Customer Testing
                                </option>

                                <option>
                                    Lab Testing
                                </option>

                                <option>
                                    Demo
                                </option>


                            </select>


                        </div>

                    </div>



                </div>




                <div class="section-break"></div>




                <!-- COURIER DETAILS -->


                <!-- COURIER DETAILS -->

                <div class="section-title">
                    Courier Details
                </div>


                <div class="row">


                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Courier Required
                            </label>


                            <select class="form-control" name="courier_required">

                                <option>
                                    Yes
                                </option>

                                <option>
                                    No
                                </option>

                            </select>


                        </div>

                    </div>



                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Courier Name
                            </label>


                            <input type="text" class="form-control" name="courier_name"
                                placeholder="Enter Courier Name">


                        </div>

                    </div>



                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Tracking No
                            </label>


                            <input type="text" class="form-control" name="tracking_no"
                                placeholder="Enter Tracking Number">


                        </div>

                    </div>



                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Dispatch Date
                            </label>


                            <input type="date" class="form-control" name="dispatch_date">


                        </div>

                    </div>



                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Courier Address
                            </label>


                            <input type="text" class="form-control" name="courier_address">


                        </div>

                    </div>



                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Contact Person
                            </label>


                            <input type="text" class="form-control" name="contact_person">


                        </div>

                    </div>



                    <div class="col-md-3">

                        <div class="form-group">

                            <label>
                                Mobile
                            </label>


                            <input type="text" class="form-control" name="mobile">


                        </div>

                    </div>



                </div>


                <div class="section-break"></div>




                <!-- NOTES -->


                <div class="section-title">
                    Additional Notes
                </div>



                <div class="row">


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Remarks
                            </label>


                            <textarea class="form-control"></textarea>


                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Attachment
                            </label>


                            <input type="file" class="form-control">


                        </div>

                    </div>


                </div>





                <div class="mt-3">


                    <button type="submit" class="btn btn-success btn-sm">

                        Save Sample Request

                    </button>



                    <button type="reset" class="btn btn-danger btn-sm">

                        Reset

                    </button>



                    <a href="{{route('pages.sales.samples')}}" class="btn btn-secondary btn-sm">

                        Back

                    </a>



                </div>




            </form>



        </div>



    </div>



</div>


@endsection