@extends('pages.sale-person.layout.app')

@section('content')


<style>
.col-5-custom {
    flex: 0 0 20%;
    max-width: 20%;
}

@media (max-width: 992px) {
    .col-5-custom {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 576px) {
    .col-5-custom {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>


<div class="container-fluid" style="margin-left:20px;">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">Add Customer Feedback</h4>

            <a href="{{ route('pages.sales.feedback.index') }}" class="btn btn-secondary btn-sm">
                Back
            </a>

        </div>

        <div class="card-body">

            <form action="#" method="POST">

                @csrf

                <div class="row">


                <div class="col-5-custom mb-3">
                        <label class="form-label fw-bold">
                            Order No <span class="text-danger">*</span>
                        </label>
                        <select class="form-control select2" name="customer_id">
                            <option value="">Select Order</option>
                            <option value="">Order 1 </option>
                            <option value="">Order 2</option>
                            <option value="">Order 3</option>
                        </select>
                    </div>

                    <!-- Customer -->
                    <div class="col-5-custom mb-3">
                        <label class="form-label fw-bold">
                            Customer <span class="text-danger">*</span>
                        </label>
                        <select class="form-control select2" name="customer_id">
                            <option value="">Select Customer</option>
                            <option value="">XYZ private limited</option>
                            <option value="">Test AgriCorp</option>
                            <option value="">Biological Inputs Pty Ltd</option>
                            <option value="">UmaHari LLC</option>
                        </select>
                    </div>

                    <!-- Product -->
                    <div class="col-5-custom mb-3">
                        <label class="form-label fw-bold">
                            Product <span class="text-danger">*</span>
                        </label>
                        <select class="form-control select2" name="product_id">
                            <option value="">Select Product</option>
                            <option value="">Uma-gro liquid Biofertilizer</option>
                            <option value="">AGRIBAC BACILLUS MEGATERIUM</option>
                            <option value="">AGRIBAC PSEUDOMONAS</option>
                         
                        </select>
                    </div>

                    <!-- Rating -->
                    <div class="col-5-custom mb-3">
                        <label class="form-label fw-bold">
                            Overall Rating
                        </label>
                        <select class="form-control" name="rating">
                            <option value="">Select Rating</option>
                            <option value="5">★★★★★ Excellent</option>
                            <option value="4">★★★★ Very Good</option>
                            <option value="3">★★★ Good</option>
                            <option value="2">★★ Fair</option>
                            <option value="1">★ Poor</option>
                        </select>
                    </div>

                    <!-- Feedback Date -->
                    <div class="col-5-custom mb-3">
                        <label class="form-label fw-bold">
                            Feedback Date
                        </label>
                        <input type="date" class="form-control" name="feedback_date" value="{{ date('Y-m-d') }}">
                    </div>

               
                </div>

                <hr>

                <h5 class="mb-3">Feedback Details</h5>

                <div class="row">

                    <!-- Quality Feedback -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Quality Feedback
                        </label>
                        <textarea class="form-control" rows="4" name="quality_feedback"
                            placeholder="Product quality, consistency, performance, defects etc."></textarea>
                    </div>

                    <!-- Delivery Feedback -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Delivery Feedback
                        </label>
                        <textarea class="form-control" rows="4" name="delivery_feedback"
                            placeholder="Delivery timeline, transport condition, delays etc."></textarea>
                    </div>

                    <!-- Packaging Feedback -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Packaging Feedback
                        </label>
                        <textarea class="form-control" rows="4" name="packaging_feedback"
                            placeholder="Packaging quality, labeling, damage issues etc."></textarea>
                    </div>

                    <!-- Service Feedback -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            Service Feedback
                        </label>
                        <textarea class="form-control" rows="4" name="service_feedback"
                            placeholder="Sales support, communication, responsiveness etc."></textarea>
                    </div>

                    <!-- Improvement Suggestion -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">
                            Improvement Suggestions
                        </label>
                        <textarea class="form-control" rows="4" name="improvement_suggestions"
                            placeholder="Customer suggestions for improvement"></textarea>
                    </div>

                    <!-- Remarks -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">
                            Remarks
                        </label>
                        <textarea class="form-control" rows="4" name="remarks"
                            placeholder="Additional comments or observations"></textarea>
                    </div>

                </div>

                <hr>

                <div class="text-end">

                    <button type="reset" class="btn btn-secondary">
                        Reset
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Save Feedback
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection