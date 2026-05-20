$(document).ready(function () {
    "use strict";
    let hidden_alert = $("#hidden_alert").val();
    let hidden_cancel = $("#hidden_cancel").val();
    let hidden_ok = $("#hidden_ok").val();
    let hidden_base_url = $("#hidden_base_url").val();

    /**
     * @description This function is used to set the attribute of the element
     */
    function setAttribute() {
        let i = 1;
        $(".set_sn").each(function () {
            $(this).html(i);
            i++;
        });
        i = 1;
        $(".unit_price_c").each(function () {
            $(this).attr("id", "unit_price_" + i);
            i++;
        });
        i = 1;
        $(".qty_c").each(function () {
            $(this).attr("id", "qty_" + i);
            i++;
        });
        i = 1;
        $(".total_c").each(function () {
            $(this).attr("id", "total_" + i);
            i++;
        });
    }

    /**
     * @description This function is used to calculate the row
     */
    function cal_row() {
        let i = 1;
        let row_total = 0;
        $(".unit_price_c").each(function () {
            let unit_price = Number($("#unit_price_" + i).val()) || 0;
            let qty = Number($("#qty_" + i).val()) || 0;
            row_total = unit_price * qty;
            $("#total_" + i).val(row_total.toFixed(2));
            i++;
        });
    }

    // Raw material selection change
    $(document).on("change", "#rmaterial", function (e) {
        let params = $(this).find(":selected").val();
        $("#qty_modal").val("1");
        if (params != "") {
            let item_details_array = params.split("|");
            $("#item_id_modal").val(item_details_array[0]);
            $(".item_name_modal").html(item_details_array[1]);
            $("#item_name_modal").val(item_details_array[1]);
            $("#item_currency_modal").val(item_details_array[5]);
            $("#item_unit_modal").val(item_details_array[4]);
            $(".modal_unit_name").html(item_details_array[4]);
            $("#unit_price_modal").val(item_details_array[3]);
            
            // Check stock availability
            let fromOutletId = $("#from_outlet_id").val();
            if (fromOutletId) {
                $.ajax({
                    url: hidden_base_url + "getRawMaterialStockForTransfer",
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val(),
                        raw_material_id: item_details_array[0],
                        outlet_id: fromOutletId
                    },
                    success: function (response) {
                        if (response.stock !== undefined) {
                            $(".item_name_modal").html(item_details_array[1] + " (Available: " + parseFloat(response.stock).toFixed(2) + " " + response.unit + ")");
                        }
                    },
                    error: function () {
                        // Ignore errors
                    }
                });
            }
            
            $("#cartPreviewModal").modal("show");
        }
    });

    // Add to cart button
    $(document).on("click", "#addToCart", function (e) {
        e.preventDefault();
        $(".rmError").remove();
        let unit_price = $("#unit_price_modal").val();
        let qty_modal = $("#qty_modal").val();
        let item_unit_modal = $("#item_unit_modal").val();
        let item_name_modal = $("#item_name_modal").val();
        let item_id_modal = $("#item_id_modal").val();
        let item_currency_modal = $("#item_currency_modal").val();
        
        if (!qty_modal || qty_modal <= 0) {
            swal({
                title: hidden_alert + "!",
                text: "Please enter a valid quantity",
                cancelButtonText: hidden_cancel,
                confirmButtonText: hidden_ok,
                confirmButtonColor: "#3c8dbc",
            });
            return false;
        }
        
        appendCart(
            item_id_modal,
            item_name_modal,
            item_currency_modal,
            item_unit_modal,
            unit_price,
            qty_modal
        );
    });

    /**
     * @description This function is used to append the cart
     */
    function appendCart(
        item_id_modal,
        item_name_modal,
        item_currency_modal,
        item_unit_modal,
        unit_price,
        qty_modal
    ) {
        let html =
            '<tr class="rowCount" data-id="' +
            item_id_modal +
            '">\n' +
            '<td class="width_1_p text-start"><p class="set_sn">1</p></td>\n' +
            "<td>" +
            '<input type="hidden" value="' +
            item_id_modal +
            '" name="rm_id[]"> ' +
            "<span>" +
            item_name_modal +
            "</span></td>\n" +
            '<td class="available_stock_display">-</td>' +
            '<td><div class="input-group"><input type="number" tabindex="5" name="unit_price[]" onfocus="this.select();" class="check_required form-control integerchk input_aligning unit_price_c cal_row" placeholder="Unit Price" value="' +
            unit_price +
            '"><span class="input-group-text">' +
            item_currency_modal +
            '</span></div><div class="text-danger d-none unitPriceErr"></div></td>' +
            '<td><div class="input-group"><input type="number" data-countid="1" tabindex="51" id="quantity_amount_1" name="quantity_amount[]" onfocus="this.select();" class="check_required form-control integerchk input_aligning qty_c cal_row" value="' +
            qty_modal +
            '" placeholder="Qty/Amount" ><span class="input-group-text">' +
            item_unit_modal +
            '</span></div><div class="text-danger d-none qtyErr"></div></td>' +
            '<td><div class="input-group mb-3"><input type="number" id="total_1" name="total[]" class="form-control input_aligning total_c" placeholder="Total" readonly=""><span class="input-group-text">' +
            item_currency_modal +
            "</span></div></td>" +
            '<td class="ir_txt_center"><a class="btn btn-xs del_row dlt_button"><iconify-icon icon="solar:trash-bin-minimalistic-broken"></iconify-icon> </a></td>\n' +
            "</tr>";

        let check_exist = true;

        $(".rowCount").each(function () {
            let id = $(this).attr("data-id");
            if (Number(id) == Number(item_id_modal)) {
                check_exist = false;
            }
        });

        if (check_exist == true) {
            if (item_id_modal) {
                $(".add_tr").append(html);
                setAttribute();
                cal_row();
                
                // Update stock display for the new row
                let fromOutletId = $("#from_outlet_id").val();
                if (fromOutletId) {
                    let row = $(".rowCount[data-id='" + item_id_modal + "']");
                    $.ajax({
                        url: hidden_base_url + "getRawMaterialStockForTransfer",
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val(),
                            raw_material_id: item_id_modal,
                            outlet_id: fromOutletId
                        },
                        success: function (response) {
                            if (response.stock !== undefined) {
                                row.find(".available_stock_display").text(parseFloat(response.stock).toFixed(2) + " " + response.unit);
                            }
                        },
                        error: function () {
                            row.find(".available_stock_display").text("-");
                        }
                    });
                }
                
                $("#rmaterial").val("").change();
                $("#cartPreviewModal").modal("hide");
                return false;
            }
        } else {
            swal({
                title: hidden_alert + "!",
                text: "This Raw Material already added",
                cancelButtonText: hidden_cancel,
                confirmButtonText: hidden_ok,
                confirmButtonColor: "#3c8dbc",
            });
            $("#rmaterial").val("").change();
            $("#cartPreviewModal").modal("hide");
            return false;
        }
    }

    // Delete row
    $(document).on("click", ".del_row", function (e) {
        $(this).closest("tr").remove();
        setAttribute();
        cal_row();
    });

    // Calculate row on input change
    $(document).on("keyup", ".cal_row", function (e) {
        cal_row();
    });

    $(document).on("click", ".cal_row", function (e) {
        cal_row();
    });

    $(document).on("focus", ".cal_row", function (e) {
        cal_row();
    });

    // From outlet change - update stock for all rows
    $("#from_outlet_id").on("change", function () {
        $(".rowCount").each(function () {
            let row = $(this);
            let rawMaterialId = row.find('input[name="rm_id[]"]').val();
            let fromOutletId = $("#from_outlet_id").val();
            
            if (rawMaterialId && fromOutletId) {
                $.ajax({
                    url: hidden_base_url + "getRawMaterialStockForTransfer",
                    method: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val(),
                        raw_material_id: rawMaterialId,
                        outlet_id: fromOutletId
                    },
                    success: function (response) {
                        if (response.stock !== undefined) {
                            row.find(".available_stock_display").text(parseFloat(response.stock).toFixed(2) + " " + response.unit);
                        }
                    },
                    error: function () {
                        row.find(".available_stock_display").text("-");
                    }
                });
            }
        });
    });

    // Form submission validation
    $("#transfer_form").submit(function (e) {
        let status = true;
        let transfer_reference_no = $("#transfer_reference_no").val();
        let from_outlet_id = $("#from_outlet_id").val();
        let to_outlet_id = $("#to_outlet_id").val();
        let transfer_date = $("#transfer_date").val();

        if (transfer_reference_no == "") {
            showErrorMessage("transfer_reference_no", "The Transfer Reference No field is required.");
            status = false;
        } else {
            $("#transfer_reference_no").removeClass("is-invalid");
            $("#transfer_reference_no").closest("div").find(".text-danger").addClass("d-none");
        }

        if (from_outlet_id == "") {
            $("#from_outlet_id").addClass("is-invalid");
            status = false;
        } else {
            $("#from_outlet_id").removeClass("is-invalid");
        }

        if (to_outlet_id == "") {
            $("#to_outlet_id").addClass("is-invalid");
            status = false;
        } else {
            $("#to_outlet_id").removeClass("is-invalid");
        }

        if (from_outlet_id == to_outlet_id) {
            swal({
                title: hidden_alert + "!",
                text: "From Outlet and To Outlet cannot be the same",
                cancelButtonText: hidden_cancel,
                confirmButtonText: hidden_ok,
                confirmButtonColor: "#3c8dbc",
            });
            status = false;
        }

        if (transfer_date == "") {
            showErrorMessage("transfer_date", "The Transfer Date field is required.");
            status = false;
        } else {
            $("#transfer_date").removeClass("is-invalid");
            $("#transfer_date").closest("div").find(".text-danger").addClass("d-none");
        }

        let rowCount = $(".rowCount").length;
        if (!Number(rowCount)) {
            $("#transfer_cart .add_tr").html(
                '<tr><td colspan="7" class="text-danger rmError">Please add minimum one Raw Material</td></tr>'
            );
            status = false;
        } else {
            $(".rmError").remove();
        }

        if (status == true) {
            return true;
        } else {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        }
    });

    function showErrorMessage(id, message) {
        $("#" + id + "").addClass("is-invalid");
        let closestDiv = $("#" + id + "")
            .closest("div")
            .find(".text-danger");
        closestDiv.text(message);
        closestDiv.removeClass("d-none");
    }

    setAttribute();
    cal_row();
});

