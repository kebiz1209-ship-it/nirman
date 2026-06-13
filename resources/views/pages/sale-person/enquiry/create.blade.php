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
    height: 75px;
    resize: vertical;
}


.compact-form .btn {
    height: 32px;
    font-size: 12px;
    padding: 4px 10px;
}


.section-title {
    font-size: 18px;
    font-weight: 700;
    background: #f4f6f9;
    padding: 10px 12px;
    border-left: 4px solid #007bff;
    border-radius: 5px;
    margin-bottom: 15px;
    color: #2c3e50;
}


.section-break {
    margin: 18px 0;
    border-top: 1px dashed #dcdcdc;
}


.card-header h3 {
    font-size: 18px;
    font-weight: 700;
}
</style>


<div class="container-fluid compact-form" style="margin-left:20px;">


    <div class="card">


        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Create Enquiry
            </h3>


            <a href="{{route('pages.sales.enquiry.index')}}" class="btn btn-secondary btn-sm">
                Back
            </a>


        </div>



        <div class="card-body">


            <form>


                <!-- BASIC DETAILS -->

                <div class="section-title">
                    Basic Details
                </div>


                <div class="row">


                    <div class="col-md-2">
                        <div class="form-group">

                            <label>Enquiry No</label>

                            <input type="text" class="form-control" value="ENQ-1001">

                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group">

                            <label>Date</label>

                            <input type="date" class="form-control">

                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group">

                            <label>Source</label>

                            <select class="form-control">

                                <option>Website</option>
                                <option>Reference</option>
                                <option>Phone</option>
                                <option>Email</option>

                            </select>

                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group">

                            <label>Sales Person</label>

                            <select class="form-control">

                                <option>Rahul Sharma</option>
                                <option>Amit Verma</option>

                            </select>

                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group">

                            <label>Priority</label>

                            <select class="form-control">

                                <option>Low</option>
                                <option>Medium</option>
                                <option>High</option>
                                <option>Urgent</option>

                            </select>

                        </div>
                    </div>



                    <div class="col-md-2">
                        <div class="form-group">

                            <label>Status</label>

                            <select class="form-control">

                                <option>Open</option>
                                <option>Follow Up</option>
                                <option>Closed</option>

                            </select>

                        </div>
                    </div>


                </div>



                <div class="section-break"></div>




                <!-- CUSTOMER -->

                <div class="section-title">
                    Customer Details
                </div>



                <div class="row">



                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Customer</label>


                            <div class="d-flex">


                                <select class="form-control">

                                    <option>Select Customer</option>
                                    <option>ABC Chemicals</option>
                                    <option>XYZ Industries</option>

                                </select>


                                <button type="button" class="btn btn-primary ml-1">

                                    +

                                </button>


                            </div>


                        </div>

                    </div>




                    <div class="col-md-2">

                        <div class="form-group">

                            <label>Contact Person</label>

                            <input type="text" class="form-control">

                        </div>

                    </div>




                    <div class="col-md-2">

                        <div class="form-group">

                            <label>Mobile</label>

                            <input type="text" class="form-control">

                        </div>

                    </div>




                    <div class="col-md-2">

                        <div class="form-group">

                            <label>Email</label>

                            <input type="email" class="form-control">

                        </div>

                    </div>




                    <div class="col-md-2">

                        <div class="form-group">

                            <label>GST No</label>

                            <input type="text" class="form-control">

                        </div>

                    </div>



                </div>




                <div class="section-break"></div>




                <!-- REQUIREMENT -->


                <div class="section-title">
                    Requirement Details
                </div>



                <div class="row">



                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Product Type</label>

                            <select class="form-control">

                                <option>Existing Product</option>
                                <option>New Product</option>
                                <option>Modification</option>

                            </select>


                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Product Name</label>

                            <input type="text" class="form-control">

                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Application</label>

                            <input type="text" class="form-control">

                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Industry</label>

                            <input type="text" class="form-control">

                        </div>

                    </div>





                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Required Quantity</label>

                            <input type="number" class="form-control">

                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Target Price</label>

                            <input type="text" class="form-control">

                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Required Delivery Date</label>

                            <input type="date" class="form-control">

                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Market Segment</label>

                            <select class="form-control">

                                <option>Retail</option>
                                <option>Industrial</option>
                                <option>Export</option>

                            </select>


                        </div>

                    </div>



                </div>



                <div class="section-break"></div>




                <!-- NOTES -->


                <div class="section-title">
                    Additional Information
                </div>



                <div class="row">


                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Customer Requirement</label>

                            <textarea class="form-control"></textarea>

                        </div>

                    </div>




                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Special Notes</label>

                            <textarea class="form-control"></textarea>

                        </div>

                    </div>




                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Competitor Product</label>

                            <textarea class="form-control"></textarea>

                        </div>

                    </div>



                </div>



                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Attachment</label>

                            <input type="file" class="form-control">

                        </div>

                    </div>


                </div>




                <div class="mt-3">


                    <button class="btn btn-success btn-sm">

                        Save Enquiry

                    </button>


                    <button type="reset" class="btn btn-danger btn-sm">

                        Reset

                    </button>



                    <a href="{{route('pages.sales.enquiry.index')}}" class="btn btn-secondary btn-sm">

                        Back

                    </a>

                </div>
            </form>
        </div>


    </div>


</div>


@endsection