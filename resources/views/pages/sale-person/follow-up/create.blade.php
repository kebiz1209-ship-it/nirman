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
                Create Follow-Up
            </h3>


            <a href="{{ route('pages.sales.followups') }}" class="btn btn-secondary btn-sm">

                Back

            </a>


        </div>




        <div class="card-body">


            <form method="POST" enctype="multipart/form-data">

                @csrf



                <!-- FOLLOW UP DETAILS -->

                <div class="section-title">
                    Follow-Up Details
                </div>



                <div class="row">



                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Follow-Up Date</label>

                            <input type="date" class="form-control" name="followup_date">

                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Customer</label>

                            <select class="form-control" name="customer_id">

                                <option>Select Customer</option>
                                <option>ABC Chemicals</option>
                                <option>XYZ Industries</option>

                            </select>

                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Related Enquiry</label>

                            <select class="form-control" name="enquiry_id">

                                <option>Select Enquiry</option>
                                <option>ENQ-1001</option>
                                <option>ENQ-1002</option>

                            </select>

                        </div>

                    </div>




                    <div class="col-md-3">

                        <div class="form-group">

                            <label>Related Order</label>

                            <select class="form-control" name="order_id">

                                <option>Select Order</option>
                                <option>ORD-1001</option>
                                <option>ORD-1002</option>

                            </select>

                        </div>

                    </div>



                </div>



                <div class="section-break"></div>



                <!-- TYPE -->

                <div class="section-title">
                    Follow-Up Type
                </div>



                <div class="row">


                    <div class="col-md-12">

                        <div class="form-group">


                            <label class="mr-4">

                                <input type="radio" name="followup_type" value="Call">

                                Call

                            </label>



                            <label class="mr-4">

                                <input type="radio" name="followup_type" value="Email">

                                Email

                            </label>



                            <label class="mr-4">

                                <input type="radio" name="followup_type" value="Meeting">

                                Meeting

                            </label>



                            <label>

                                <input type="radio" name="followup_type" value="WhatsApp">

                                WhatsApp

                            </label>


                        </div>

                    </div>


                </div>




                <div class="section-break"></div>




                <!-- DISCUSSION -->

                <div class="section-title">
                    Discussion Details
                </div>




                <div class="row">



                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Discussion Summary
                            </label>

                            <textarea class="form-control" name="discussion_summary"></textarea>


                        </div>

                    </div>




                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Next Action
                            </label>

                            <textarea class="form-control" name="next_action"></textarea>


                        </div>

                    </div>



                </div>





                <div class="row">


                    <div class="col-md-4">

                        <div class="form-group">

                            <label>
                                Next Follow-Up Date
                            </label>

                            <input type="date" class="form-control" name="next_followup_date">


                        </div>

                    </div>




                    <div class="col-md-4">

                        <div class="form-group">

                            <label>
                                Attachment
                            </label>

                            <input type="file" class="form-control" name="attachment">


                        </div>

                    </div>


                </div>





                <div class="mt-3">


                    <button type="submit" class="btn btn-success btn-sm">

                        Save Follow-Up

                    </button>



                    <button type="reset" class="btn btn-danger btn-sm">

                        Reset

                    </button>



                    <a href="{{ route('pages.sales.followups') }}" class="btn btn-secondary btn-sm">

                        Back

                    </a>



                </div>



            </form>


        </div>



    </div>


</div>



@endsection