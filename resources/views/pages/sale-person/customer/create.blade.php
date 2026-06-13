@extends('pages.sale-person.layout.app')

@section('content')

<style>

.compact-form {
    padding: 0;
    margin-left: 30px;
}

.compact-form .row {
    margin-left: -6px;
    margin-right: -6px;
}

.compact-form .row > div {
    padding-left: 6px;
    padding-right: 6px;
}

.compact-form .form-group {
    margin-bottom: 8px;
}

.compact-form label {
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 3px;
    display: block;
}

.compact-form .form-control {
    height: 32px;
    font-size: 12px;
    padding: 4px 8px;
}

.compact-form textarea.form-control {
    height: 55px;
    resize: vertical;
}

.compact-form .btn {
    height: 34px;
    font-size: 12px;
}

.card {
    margin: 0;
}

.card-header {
    padding: 10px 12px;
}

.card-header h3 {
    font-size:18px;
    font-weight:700;
}

.card-body {
    padding: 12px !important;
}

</style>


<div class="container-fluid compact-form">


    <div class="card">


        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Customer Master
            </h3>


            <a href="{{ route('pages.sales.customer.index') }}"
               class="btn btn-secondary btn-sm">
                Back
            </a>


        </div>



        <div class="card-body">


            <form>


                <!-- FIRST ROW -->

                <div class="row">


                    <div class="col">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>



                    <div class="col">
                        <div class="form-group">
                            <label>Phone *</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>



                    <div class="col">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control">
                        </div>
                    </div>



                    <div class="col">
                        <div class="form-group">
                            <label>Opening Balance</label>
                            <input type="number" class="form-control">
                        </div>
                    </div>



                    <div class="col">
                        <div class="form-group">
                            <label>Balance Type</label>

                            <select class="form-control">
                                <option>Debit</option>
                                <option>Credit</option>
                            </select>

                        </div>
                    </div>


                </div>





                <!-- SECOND ROW -->


                <div class="row">


                    <div class="col">
                        <div class="form-group">
                            <label>Credit Limit</label>
                            <input type="number" class="form-control">
                        </div>
                    </div>



                    <div class="col">
                        <div class="form-group">
                            <label>Default Discount</label>
                            <input type="number" class="form-control">
                        </div>
                    </div>



                    <div class="col">
                        <div class="form-group">
                            <label>Customer Type</label>

                            <select class="form-control">
                                <option>Retail</option>
                                <option>Wholesale</option>
                                <option>Distributor</option>
                                <option>Corporate</option>
                            </select>

                        </div>
                    </div>



                    <div class="col">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>



                    <div class="col">
                        <div class="form-group">
                            <label>Date of Anniversary</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>



                </div>





                <!-- ADDRESS -->


                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label>
                                Address
                            </label>

                            <textarea class="form-control"></textarea>

                        </div>

                    </div>


                </div>





                <!-- NOTE -->


                <div class="row">

                    <div class="col-md-12">


                        <div class="form-group">

                            <label>
                                Note
                            </label>


                            <textarea class="form-control"></textarea>


                        </div>


                    </div>


                </div>






                <!-- BUTTONS -->


                <div class="mt-3">


                    <button type="submit"
                            class="btn btn-success btn-sm">

                        <iconify-icon icon="solar:check-circle-broken"></iconify-icon>
                        Save Customer

                    </button>



                    <button type="reset"
                            class="btn btn-danger btn-sm">

                        <iconify-icon icon="solar:refresh-broken"></iconify-icon>
                        Reset

                    </button>



                    <a href="{{ route('pages.sales.customer.index') }}"
                       class="btn btn-secondary btn-sm">

                        <iconify-icon icon="solar:round-arrow-left-broken"></iconify-icon>
                        Back

                    </a>



                </div>



            </form>


        </div>


    </div>


</div>


@endsection