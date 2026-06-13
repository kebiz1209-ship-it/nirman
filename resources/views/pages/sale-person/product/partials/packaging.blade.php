<style>
.primary-item {
    border: 1px solid #dee2e6 !important;
    border-radius: 8px;
    padding: 15px !important;
    margin-bottom: 15px !important;
    background: #fff;
}

.primary-item h6 {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 15px !important;
}

.form-group {
    margin-bottom: 10px;
}

.form-group label {
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 4px;
}

.form-control {
    height: 34px;
    font-size: 12px;
}

textarea.form-control {
    height: 70px;
    resize: vertical;
}

.btn-sm {
    padding: 3px 10px;
    font-size: 12px;
}


.custom-row{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
}

.col-5-custom{
    flex:1;
   
}

.specification-box{
    height:70px !important;
    resize:vertical;
}
.form-group {
    margin-bottom: 0;
}

.form-control {
    width: 100%;
    height: 34px;
    font-size: 12px;
}

textarea.form-control {
    height: 34px;
    resize: none;
}

@media (max-width: 1200px) {
    .col-5-custom {
        flex: 0 0 25%;
        max-width: 25%;
    }
}

@media (max-width: 992px) {
    .col-5-custom {
        flex: 0 0 33.33%;
        max-width: 33.33%;
    }
}

@media (max-width: 768px) {
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

.form-control {
    width: 100%;
}
</style>

<!-- <div class="card mt-2"> -->
<!-- <div class="card-body"> -->

<div id="primary-wrapper">

    <div class="primary-item">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="text-primary mb-0"></h6>

            <button type="button" class="btn btn-danger btn-sm remove-primary">
                Remove
            </button>
        </div>

        <!-- PRIMARY -->

        <!-- PRIMARY PACKAGING -->
        <h6 class="text-primary">Primary Packaging</h6>

        <!-- FIRST ROW -->
        <div class="custom-row">

            <!-- Packaging Type -->
            <div class="col-5-custom">

                <div class="form-group">

                    <label>Packaging Type</label>

                    <select name="packaging[0][bottle_type]" class="form-control">

                        <option value="">Select Packaging Type</option>

                        <option value="Plastic Bottle">Plastic Bottle</option>
                        <option value="Glass Bottle">Glass Bottle</option>
                        <option value="Pet Jar">PET Jar</option>
                        <option value="Tin Container">Tin Container</option>
                        <option value="Pouch">Pouch</option>
                        <option value="Box Packaging">Box Packaging</option>
                        <option value="Can">Can</option>
                        <option value="Drum">Drum</option>
                        <option value="Spray Bottle">Spray Bottle</option>
                        <option value="Tube">Tube</option>

                    </select>

                </div>

            </div>

            <!-- Size -->
            <div class="col-5-custom">

                <div class="form-group">

                    <label>Size</label>

                    <input type="text" name="packaging[0][bottle_size]" class="form-control">

                </div>

            </div>

            <!-- Weight -->
            <div class="col-5-custom">

                <div class="form-group">

                    <label>Weight</label>

                    <input type="text" name="packaging[0][weight]" class="form-control">

                </div>

            </div>

            <!-- Label Type -->
            <div class="col-5-custom">

                <div class="form-group">

                    <label>Label Type</label>

                    <input type="text" name="packaging[0][label_type]" class="form-control">

                </div>

            </div>

            <!-- Fill Quantity -->
            <div class="col-5-custom">

                <div class="form-group">

                    <label>Fill Quantity</label>

                    <input type="number" step="0.01" name="packaging[0][fill_quantity]" class="form-control">

                </div>

            </div>

            <!-- In Batch -->
            <div class="col-5-custom">

                <div class="form-group">

                    <label>In Batch</label>

                    <input type="number" step="0.01" name="packaging[0][in_batch]" class="form-control">

                </div>

            </div>

        </div>



        <!-- SECOND ROW -->
        <div class="custom-row mt-2">

            <!-- Specification -->
            <div class="col-md-12">

                <div class="form-group">

                    <label>Specification</label>

                    <textarea name="packaging[0][specification]" class="form-control specification-box"></textarea>

                </div>

            </div>

        </div>

        <hr>

        <!-- SECONDARY -->
        <h6 class="text-success">Secondary Packaging</h6>

        <div class="custom-row">

            <div class="col-5-custom">
                <div class="form-group">
                    <label>Inner Carton</label>
                    <input type="text" name="packaging[0][inner_carton]" class="form-control">
                </div>
            </div>

            <div class="col-5-custom">
                <div class="form-group">
                    <label>Qty Per Carton</label>
                    <input type="number" name="packaging[0][qty_per_carton]" class="form-control">
                </div>
            </div>

            <div class="col-5-custom">
                <div class="form-group">
                    <label>Carton Length</label>
                    <input type="text" name="packaging[0][carton_length]" class="form-control">
                </div>
            </div>

            <div class="col-5-custom">
                <div class="form-group">
                    <label>Carton Width</label>
                    <input type="text" name="packaging[0][carton_width]" class="form-control">
                </div>
            </div>
            <div class="col-5-custom">
                <div class="form-group">
                    <label>Carton Height</label>
                    <input type="text" name="packaging[0][carton_height]" class="form-control">
                </div>
            </div>

        </div>

        <div class="custom-row">



            <div class="col-5-custom">
                <div class="form-group">
                    <label>Carton Weight</label>
                    <input type="text" name="packaging[0][carton_weight]" class="form-control">
                </div>
            </div>

        </div>

        <hr>

        <!-- TERTIARY -->
        <h6 class="text-info">Tertiary Packaging</h6>

        <div class="custom-row">

            <div class="col-5-custom">
                <div class="form-group">
                    <label>Master Carton</label>
                    <input type="text" name="packaging[0][master_carton]" class="form-control">
                </div>
            </div>

            <div class="col-5-custom">
                <div class="form-group">
                    <label>Pallet Configuration</label>
                    <input type="text" name="packaging[0][pallet_configuration]" class="form-control">
                </div>
            </div>

            <div class="col-5-custom">
                <div class="form-group">
                    <label>Secondary Cartons </label>
                    <input type="number" name="packaging[0][secondary_carton_count]" class="form-control">
                </div>
            </div>

            <div class="col-5-custom">
                <div class="form-group">
                    <label>Stretch Field Required</label>
                    <select name="packaging[0][stretch_required]" class="form-control">
                        <option value="">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="col-5-custom">
                <div class="form-group">
                    <label>Transport Label Required</label>
                    <select name="packaging[0][transport_label_required]" class="form-control">
                        <option value="">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="custom-row">



            <div class="col-5-custom">
                <div class="form-group">
                    <label>Transport Packaging</label>
                    <input type="text" name="packaging[0][transport_packaging]" class="form-control">
                </div>
            </div>

        </div>

    </div>

</div>

<button type="button" class="btn btn-success" id="add-primary">
    + Add Packaging
</button>

<!-- </div> -->
<!-- </div> -->

<script>
$(function() {

    $('#add-primary').click(function() {

        let index = $('.primary-item').length;

        let html = $('.primary-item:first').prop('outerHTML');

        html = html.replaceAll('packaging[0]', 'packaging[' + index + ']');

        $('#primary-wrapper').append(html);

        $('#primary-wrapper .primary-item:last')
            .find('input,textarea,select')
            .val('');

    });

    $(document).on('click', '.remove-primary', function() {

        if ($('.primary-item').length > 1) {
            $(this).closest('.primary-item').remove();
        }

    });

});
</script>