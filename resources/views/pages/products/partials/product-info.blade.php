<!-- ROW 1 -->


<style>
    .approval-row {
    display: flex;
    flex-wrap: nowrap; /* keep all in one line */
    gap: 20px;
    align-items: center;
}

.approval-row .checkbox-box {
    display: flex;
    align-items: center;
    white-space: nowrap;
}

.approval-row .checkbox-box label {
    margin-left: 5px;
    margin-bottom: 0;
}
</style>
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Product Name *</label>
            <input type="text" name="name" class="form-control" required>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Category *</label>
            <select name="category" class="form-control" required>
                <option value="">Select</option>
                <option value="Bacteria">Bacteria</option>
                <option value="Nano">Nano</option>
                <option value="Micoriza">Micoriza</option>
                <option value="Combination">Combination</option>
            </select>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Product Code</label>
            <input type="text" name="product_code" class="form-control" placeholder="Internal code">
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Alias</label>
            <input type="text" name="alias" class="form-control">
        </div>
    </div>
</div>

<!-- ROW 2 -->
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Product Type *</label>
            <select name="product_type" class="form-control" required>
                <option value="">Select</option>
                <option value="Liquid">Liquid</option>
                <option value="Powder">Powder</option>
                <option value="Gel">Gel</option>
                <option value="Granual">Granual</option>
            </select>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Unit *</label>
            <select name="unit" class="form-control" required>
                <option value="">Select</option>
                <option value="Box">Box</option>
                <option value="KG">KG</option>
                <option value="GM">GM</option>
                <option value="LTR">LTR</option>
                <option value="ML">ML</option>
            </select>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Stock Method</label>
            <select name="stock_method" class="form-control">
                <option value="FIFO">FIFO</option>
                <option value="FEFO">FEFO</option>
                <option value="Batch Control">Batch Control</option>
                <option value="None">None</option>
            </select>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>HSN Code</label>
            <input type="text" name="hsn_code" class="form-control">
        </div>
    </div>
</div>

<!-- ROW 3 -->
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>GST (%)</label>
            <select name="gst" class="form-control">
                <option value="0">0%</option>
                <option value="5">5%</option>
                <option value="18">18%</option>
                <option value="28">28%</option>
            </select>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>MRP *</label>
            <input type="number" name="mrp" class="form-control" step="0.01" required>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Potency</label>
            <input type="text" name="potency" class="form-control" placeholder="e.g., 500mg, 10%">
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Grade</label>
            <input type="text" name="grade" class="form-control" placeholder="e.g., Pharma, Technical">
        </div>
    </div>
</div>

<!-- ROW 4 -->
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Manufacture Type</label>
            <select name="manufacture_type" class="form-control">
                <option value="Standard">Standard</option>
                <option value="Contract">Contract</option>
                <option value="Customized">Customized</option>
            </select>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Privacy Level</label>
            <select name="privacy_level" class="form-control">
                <option value="Open Formula">Open Formula</option>
                <option value="Restricted">Restricted</option>
                <option value="Confidential">Confidential</option>
                <option value="Trade Secret">Trade Secret</option>
            </select>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Product Owner</label>
            <select name="product_owner" class="form-control">
                <option value="Company">Company</option>
                <option value="Client">Client</option>
            </select>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Formula Owner</label>
            <select name="formula_owner" class="form-control">
                <option value="Company">Company</option>
                <option value="Client">Client</option>
                <option value="Shared">Shared</option>
            </select>
        </div>
    </div>
</div>

<!-- ROW 5 -->
<div class="row">

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Concept">Concept</option>
                <option value="R&D Development">R&D Development</option>
                <option value="Laboratory Trial">Laboratory Trial</option>
                <option value="Sample Trial">Sample Trial</option>
                <option value="Pilot Batch">Pilot Batch</option>
                <option value="Commercial Product">Commercial Product</option>
                <option value="On Hold">On Hold</option>
                <option value="Discontinue">Discontinue</option>
            </select>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Customer Name</label>
            <select name="status" class="form-control">
                <option value="Concept">Select</option>
                <option value="Concept">Kashish amulani</option>
                <option value="R&D Development">Test agricrop</option>
                <option value="Laboratory Trial">Jhanvi</option>
               
            </select>
        </div>
    </div>

    <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Customer Name</label>
            <input type="text"
                   name="customer_name"
                   class="form-control">

        </div>
    </div> -->

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Customer Product Code</label>
            <input type="text"
                   name="customer_product_code"
                   class="form-control">
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Customer Product Name</label>
            <input type="text"
                   name="customer_product_name"
                   class="form-control">
        </div>
    </div>

</div>

<!-- ROW 6 - Specifications & Dosage -->
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Specifications</label>
            <textarea name="specifications" class="form-control" rows="4" 
                      placeholder="Enter product specifications..."></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Dosage</label>
            <textarea name="dosage" class="form-control" rows="4"
                      placeholder="Enter dosage information..."></textarea>
        </div>
    </div>
</div>




<!-- Availability & Approvals Section -->
<div class="row mt-2">
    <div class="col-md-12">
        <div class="checkbox-container">
            <div class="checkbox-title">Availability & Approvals</div>

            <div class="checkbox-grid approval-row">
                <div class="checkbox-box">
                    <input type="checkbox" id="sample_available">
                    <label for="sample_available">Sample Available</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox" id="commercial_product_allowed">
                    <label for="commercial_product_allowed">Commercial Product Allowed</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox" id="regulatory_approved">
                    <label for="regulatory_approved">Regulatory Approved</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox" id="customer_approved">
                    <label for="customer_approved">Customer Approved</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox" id="available_for_production">
                    <label for="available_for_production">Available For Production</label>
                </div>

                <div class="checkbox-box">
                    <input type="checkbox" id="nda_required">
                    <label for="nda_required">NDA/MTA Required</label>
                </div>
            </div>
        </div>
    </div>
</div>