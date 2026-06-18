@extends('pages.product_head.layout.app')

@section('content')

<style>
.boq-page{
    font-size:12px;
}

.boq-page .card-header h4{
    font-size:18px;
    margin:0;
}

.boq-page table th{
    white-space:nowrap;
    font-size:12px;
}

.boq-page table td{
    vertical-align:middle;
}

.boq-page .form-control{
    height:32px;
    font-size:12px;
}

.boq-page .help-box{
    background:#f8f9fa;
    border:1px solid #ddd;
    padding:10px;
    border-radius:5px;
    margin-bottom:15px;
}
</style>

<div class="container-fluid boq-page" style="margin-left:20px;">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h4>Bill of Quantities (BOQ)</h4>

                <small>
                    Define all raw materials and packaging materials
                    required for this order.
                </small>
            </div>

            <a href="{{ route('pages.product-head.boq') }}"
               class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i>
                Back
            </a>

        </div>

        <div class="card-body">

            <!-- Order Details -->

            <div class="alert alert-info mb-3">

                <div>
                    <strong>Order No :</strong>
                    ORD-001
                </div>

                <div>
                    <strong>Customer :</strong>
                    ABC Chemicals
                </div>

                <div>
                    <strong>Product :</strong>
                    Bio Fertilizer
                </div>

                <div>
                    <strong>Order Qty :</strong>
                    1000 KG
                </div>

            </div>

            <!-- BOQ TABLE -->

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th width="280">
                                Ingredient / Material
                            </th>

                            <th width="120">
                                Quantity
                            </th>

                            <th width="100">
                                UOM
                            </th>

                            <th width="150">
                                Potency/g or ml
                            </th>

                            <th width="180">
                                Grade / Specification
                            </th>

                            <th width="140">
                                Stock Status
                            </th>

                            <th width="120">
                                Material Type
                            </th>

                            <th width="100">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody id="boqBody">

                        <tr>

                        <td>
                             <select class="form-control">

                                

                                    <option>
                                       Bacteria
                                    </option>

                                    <option>
                                       Aloevera
                                    </option>

                                    <option>
                                      Sugar
                                    </option>

                                </select>
</td>

                            <td>
                                <input type="number"
                                       class="form-control"
                                       placeholder="Qty">
                            </td>

                            <td>

                                <select class="form-control">

                                    <option>KG</option>
                                    <option>GM</option>
                                    <option>LTR</option>
                                    <option>ML</option>
                                    <option>PCS</option>

                                </select>

                            </td>

                            <td>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Potency/g or ml">
                            </td>

                            <td>
                                <input type="text"
                                       class="form-control"
                                       placeholder="Grade / Spec">
                            </td>

                            <td>

                                <select class="form-control">

                                    <option>
                                        -- Check --
                                    </option>

                                    <option>
                                        In Stock
                                    </option>

                                    <option>
                                        Low Stock
                                    </option>

                                    <option>
                                        Purchase Required
                                    </option>

                                </select>

                            </td>

                            <td>

                                <select class="form-control">

                                    <option>
                                        Raw Material
                                    </option>

                                    <option>
                                        Packaging Material
                                    </option>

                                </select>

                            </td>

                            <td class="text-center">

                                <button type="button"
                                        class="btn btn-danger btn-sm">

                                    ✕

                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                <button type="button"
                        class="btn btn-success btn-sm">

                    <i class="fa fa-plus"></i>

                    Add Material

                </button>


            </div>

            <hr>

            

        </div>

    </div>

</div>

@endsection