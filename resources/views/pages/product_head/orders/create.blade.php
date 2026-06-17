@extends('layouts.app')

@section('content')

<style>
    .order-form label {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .order-form .form-control {
        height: 32px;
        font-size: 12px;
    }

    .order-form .btn {
        font-size: 12px;
    }
</style>

<div class="container-fluid order-form" style="margin-left:20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4>Create Order</h4>

            <a href="{{ route('pages.product-head.orders') }}"
               class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>

        </div>

        <div class="card-body">

            <form>

                <div class="row">

                    <div class="col-md-3 mb-2">
                        <label>Order No</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Auto Generated">
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Order Date</label>
                        <input type="date"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Customer</label>
                        <select class="form-control">
                            <option>Select Customer</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Product Type</label>
                        <select class="form-control">
                            <option>Select Product</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Quantity</label>
                        <input type="number"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Priority</label>
                        <select class="form-control">
                            <option>Low</option>
                            <option>Medium</option>
                            <option>High</option>
                            <option>Urgent</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Status</label>
                        <select class="form-control">
                            <option>New</option>
                            <option>Under Review</option>
                            <option>Query Raised</option>
                            <option>Waiting for Sales Reply</option>
                            <option>Approved</option>
                            <option>Rejected</option>
                            <option>Sent to Production</option>
                            <option>Hold</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-2">
                        <label>Assigned Sales Manager</label>
                        <select class="form-control">
                            <option>Select Sales Manager</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label>Order Notes</label>
                        <textarea rows="4"
                                  class="form-control"></textarea>
                    </div>

                </div>

                <hr>

                <div class="text-right">

                    <button type="submit"
                            class="btn btn-success btn-sm">
                        <i class="fa fa-save"></i>
                        Save Order
                    </button>

                    <button type="reset"
                            class="btn btn-danger btn-sm">
                        Reset
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection