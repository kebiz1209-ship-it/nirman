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

.compact-form .form-check-label {
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

.modal .form-control {
    height: 34px;
    font-size: 12px;
}

.modal label {
    font-size: 12px;
    font-weight: 600;
}
</style>

@extends('pages.sale-person.layout.app')

@section('content')

<div class="container-fluid compact-form" style="margin-left:20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">Create Order Request</h3>

            <a href="{{ route('pages.sales.order') }}" class="btn btn-secondary btn-sm">
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
                            <label>Request No</label>
                            <input type="text" class="form-control" value="REQ-1001">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" value="2026-06-10">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Sales Person</label>
                            <select class="form-control">
                                <option>Rahul Sharma</option>
                                <option>Amit Verma</option>
                                <option>Neha Jain</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Priority</label>
                            <select class="form-control">
                                <option>Low</option>
                                <option selected>Medium</option>
                                <option>High</option>
                                <option>Urgent</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Delivery Date</label>
                            <input type="date" class="form-control" value="2026-06-25">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option selected>Open</option>
                                <option>Pending</option>
                                <option>Closed</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="section-break"></div>

                <!-- CUSTOMER DETAILS -->
                <div class="section-title">
                    Customer Details
                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Customer</label>

                            <div class="d-flex">

                                <select class="form-control">
                                    <option>ABC Chemicals Pvt Ltd</option>
                                    <option>XYZ Industries</option>
                                    <option>Prime Hygiene</option>
                                    <option>Clean India Chemicals</option>
                                </select>

                                <button type="button" class="btn btn-primary ml-1" data-toggle="modal"
                                    data-target="#customerModal">
                                    +
                                </button>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Contact Person</label>
                            <input type="text" class="form-control" value="Rohit Jain">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" value="9876543210">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="sales@abc.com">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>GST No</label>
                            <input type="text" class="form-control" value="23ABCDE1234F1Z5">
                        </div>
                    </div>

                </div>

                <div class="section-break"></div>

                <!-- PRODUCT DETAILS -->

                <div class="section-title">
                    Product Selection
                </div>

                <div class="row mb-3">

                    <div class="col-md-12">

                        <div class="d-flex flex-wrap">

                            <!-- EXISTING PRODUCT BUTTON -->
                            <button type="button" class="btn btn-primary mr-2 mb-2" data-toggle="modal"
                                data-target="#existingProductModal">

                                <iconify-icon icon="solar:box-broken"></iconify-icon>
                                Existing Products

                            </button>

                            <!-- NEW PRODUCT BUTTON -->
                            <a href="{{ route('pages.sales.addproduct') }}" class="btn btn-success mr-2 mb-2">

                                <iconify-icon icon="solar:add-circle-broken"></iconify-icon>
                                Add New Product

                            </a>

                            <!-- PRODUCT MODIFICATION -->
                            <button type="button" class="btn btn-warning mb-2">

                                <iconify-icon icon="solar:pen-new-square-broken"></iconify-icon>
                                Product Modification

                            </button>

                        </div>

                    </div>

                </div>

                <!-- EXISTING PRODUCT MODAL -->
                <div class="modal fade" id="existingProductModal" tabindex="-1" role="dialog">

                    <div class="modal-dialog modal-xl" role="document">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title">
                                    Existing Products List
                                </h5>

                                <button type="button" class="close" data-dismiss="modal">

                                    <span>&times;</span>

                                </button>

                            </div>

                            <div class="modal-body">

                                <div class="table-responsive">

                                    <table class="table table-bordered table-striped table-sm">

                                        <thead class="thead-light">

                                            <tr>

                                                <th>Code</th>
                                                <th>Product Name</th>
                                                <th>Category</th>
                                                <th>Color</th>
                                                <th>Fragrance</th>
                                                <th>Packing</th>
                                                <th>Status</th>
                                                <th width="130">Action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <td>PRD-1001</td>
                                                <td>Liquid Detergent Premium</td>
                                                <td>Detergent</td>
                                                <td>Blue</td>
                                                <td>Lemon</td>
                                                <td>5L Can</td>

                                                <td>
                                                    <span class="badge badge-success">
                                                        Active
                                                    </span>
                                                </td>

                                                <td>

                                                    <a href="javascript:void(0)" class="btn btn-info btn-sm">

                                                        View Details

                                                    </a>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>PRD-1002</td>
                                                <td>Glass Cleaner Strong</td>
                                                <td>Cleaner</td>
                                                <td>Transparent</td>
                                                <td>Mint</td>
                                                <td>500ml Bottle</td>

                                                <td>
                                                    <span class="badge badge-success">
                                                        Active
                                                    </span>
                                                </td>

                                                <td>

                                                    <a href="javascript:void(0)" class="btn btn-info btn-sm">

                                                        View Details

                                                    </a>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>PRD-1003</td>
                                                <td>Floor Cleaner Lemon</td>
                                                <td>Floor Care</td>
                                                <td>Green</td>
                                                <td>Lemon</td>
                                                <td>1L Bottle</td>

                                                <td>
                                                    <span class="badge badge-warning">
                                                        Testing
                                                    </span>
                                                </td>

                                                <td>

                                                    <a href="javascript:void(0)" class="btn btn-info btn-sm">

                                                        View Details

                                                    </a>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td>PRD-1004</td>
                                                <td>Hand Wash Herbal</td>
                                                <td>Personal Care</td>
                                                <td>Pink</td>
                                                <td>Rose</td>
                                                <td>250ml Bottle</td>

                                                <td>
                                                    <span class="badge badge-success">
                                                        Active
                                                    </span>
                                                </td>

                                                <td>

                                                    <a href="javascript:void(0)" class="btn btn-info btn-sm">

                                                        View Details

                                                    </a>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- SCRIPT -->
                <script>
                $(document).ready(function() {

                    $('#openNewProductPage').on('click', function() {

                        $('#newProductPage').slideDown();

                        $('html, body').animate({

                            scrollTop: $("#newProductPage").offset().top

                        }, 500);

                    });

                });
                </script>

                <div class="section-break"></div>

                <!-- APPLICATION DETAILS -->
                <!-- <div class="section-title">
                    Application Details
                </div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Application</label>
                            <select class="form-control">
                                <option>Home Care</option>
                                <option>Industrial Cleaning</option>
                                <option>Personal Care</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Market Segment</label>
                            <select class="form-control">
                                <option>Retail</option>
                                <option>Wholesale</option>
                                <option>Export</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Industry Type</label>
                            <select class="form-control">
                                <option>Cleaning Chemical</option>
                                <option>Cosmetic</option>
                                <option>Detergent</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Competitor Brand</label>
                            <select class="form-control">
                                <option>Lizol</option>
                                <option>Harpic</option>
                                <option>Dettol</option>
                            </select>
                        </div>
                    </div>

                </div> -->

                <!-- <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Customer Requirement</label>
                            <textarea class="form-control">Need premium quality with strong fragrance.</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Special Notes</label>
                            <textarea class="form-control">Urgent development required before month end.</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Competitor Product</label>
                            <textarea class="form-control">Comparable to Lizol Lavender variant.</textarea>
                        </div>
                    </div>

                </div>

                <div class="mt-3">

                    <button type="submit" class="btn btn-success btn-sm">
                        Save
                    </button>

                    <button type="reset" class="btn btn-danger btn-sm">
                        Reset
                    </button>

                </div> -->

            </form>

        </div>

    </div>

</div>

<!-- CUSTOMER MODAL -->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Add Customer
                </h5>

                <button type="button" class="close" data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" class="form-control" placeholder="Enter Customer Name">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="text" class="form-control" placeholder="Enter Mobile">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Enter Email">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>GST No</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-success btn-sm">
                    Save Customer
                </button>

                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    Close
                </button>

            </div>

        </div>

    </div>

</div>

@endsection