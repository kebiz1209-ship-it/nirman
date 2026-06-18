@extends('pages.product_head.layout.app')

@section('content')

<style>
.specification-form {
    font-size: 12px;
}

.specification-form label {
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 4px;
}

.specification-form .form-control {
    font-size: 12px;
}

.specification-form .card-header h4 {
    font-size: 18px;
    margin: 0;
}

.checklist-card {
    border: 1px solid #dee2e6;
    margin-bottom: 12px;
}

.checklist-card .card-header {
    background: #f8f9fa;
    padding: 10px 15px;
}

.checklist-card .card-body {
    padding: 12px 15px;
}

.review-box {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

textarea {
    resize: vertical;
}
</style>

<div class="container-fluid specification-form" style="margin-left:30px;">
    <div class="card-body">

        <h5 class="mb-3">
            Customer Requirement Clarity Checklist
        </h5>

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead class="thead-light">
                    <tr>
                        <th width="5%">Done</th>
                        <th width="35%">Checklist Point</th>
                        <th>Notes / Remarks</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="product_composition">
                        </td>
                        <td>Product Composition Confirmed</td>
                        <td>
                            <input type="text" class="form-control" name="product_composition_notes"
                                placeholder="Enter notes">
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="quantity_confirmed">
                        </td>
                        <td>Quantity Confirmed</td>
                        <td>
                            <input type="text" class="form-control" name="quantity_notes" placeholder="Enter notes">
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="packaging_received">
                        </td>
                        <td>Packaging Instructions Received</td>
                        <td>
                            <input type="text" class="form-control" name="packaging_notes" placeholder="Enter notes">
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="label_artwork">
                        </td>
                        <td>Label Artwork Received</td>
                        <td>
                            <input type="text" class="form-control" name="label_notes" placeholder="Enter notes">
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="transport_requirements">
                        </td>
                        <td>Special Transport Requirements</td>
                        <td>
                            <input type="text" class="form-control" name="transport_notes" placeholder="Enter notes">
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="export_documentation">
                        </td>
                        <td>Export Documentation Needs</td>
                        <td>
                            <input type="text" class="form-control" name="export_notes" placeholder="Enter notes">
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="quality_specification">
                        </td>
                        <td>Quality Specification Sheet Received</td>
                        <td>
                            <input type="text" class="form-control" name="quality_notes" placeholder="Enter notes">
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- Questions -->

        <div class="form-group mt-4">

            <label>
                Questions for Sales Team / Pending Information
            </label>

            <textarea class="form-control" rows="4" name="pending_questions"
                placeholder="List any outstanding questions, pending approvals, missing specifications etc."></textarea>

        </div>

        <!-- Status -->

        <div class="row mt-3">

            <div class="col-md-4">

                <label>
                    Review Status
                </label>

                <select class="form-control" name="review_status">

                    <option value="">
                        Select Status
                    </option>

                    <option value="Clear">
                        Clear — Ready For Production
                    </option>

                    <option value="Pending">
                        Pending Information
                    </option>

                    <option value="Hold">
                        On Hold
                    </option>

                </select>

            </div>

        </div>

        <hr>

        <div class="text-right">

            <button type="submit" class="btn btn-success btn-sm">

                <i class="fa fa-save"></i>
                Save Review

            </button>

        </div>

    </div>

</div>

</div>

@endsection