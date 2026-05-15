$(document).ready(function () {
    "use strict";
    let baseUrl = $("#hidden_base_url").val() || window.location.origin + '/';

    // Load sale items when sale is selected
    $(document).on("change", "#sale_id", function () {
        var saleId = $(this).val();
        if (saleId) {
            loadSaleItems(saleId);
        } else {
            clearItemsTable();
        }
    });

    // Calculate totals when quantity or price changes
    $(document).on("input keyup", ".qty_c, .unit_price_c", function () {
        cal_row();
    });

    // Remove item row
    $(document).on("click", ".del_row", function (e) {
        e.preventDefault();
        $(this).closest('tr').remove();
        setAttribute();
        cal_row();
    });

    // Print return invoice
    $(document).on("click", ".print_return_invoice", function () {
        var id = $(this).attr("data-id");
        viewReturnInvoice(id);
    });

    // Currency conversion
    $(document).on("change", "#change_currency", function () {
        if ($(this).is(':checked')) {
            $("#currency_section").removeClass('d-none');
        } else {
            $("#currency_section").addClass('d-none');
        }
    });

    $(document).on("change", "#currency", function () {
        var selected = $(this).val();
        if (selected) {
            var parts = selected.split('|');
            var currencyId = parts[0];
            var conversionRate = parts[1];
            var symbol = parts[2];
            $("#currency_id").val(currencyId);
            $(".converted_amount_currency").text(symbol);
            calculateConvertedAmount();
        }
    });

    $(document).on("input", ".cal_row", function () {
        calculateConvertedAmount();
    });

    /**
     * Load Sale Items
     */
    function loadSaleItems(saleId) {
        $.ajax({
            url: baseUrl + 'sale-returns/get-sale-items/' + saleId,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('.add_tr').html('<tr><td colspan="9" class="text-center">Loading...</td></tr>');
            },
            success: function (response) {
                if (response.error) {
                    alert(response.error);
                    clearItemsTable();
                    return;
                }

                // Update customer info
                $('#customer_id').val(response.sale.customer_id);
                $('#customer_name').val(response.sale.customer_name);
                $('#sale_date').val(response.sale.date);

                // Clear and populate items table
                $('.add_tr').empty();

                if (response.items && response.items.length > 0) {
                    response.items.forEach(function (item, index) {
                        if (item.available_quantity > 0) {
                            addItemRow(item, index + 1);
                        }
                    });
                    setAttribute();
                    cal_row();
                } else {
                    $('.add_tr').html('<tr><td colspan="9" class="text-center">No items available for return</td></tr>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error loading sale items:', error);
                alert('Error loading sale items. Please try again.');
                clearItemsTable();
            }
        });
    }

    /**
     * Add Item Row to Table
     */
    function addItemRow(item, sn) {
        var manufactureInfo = item.manufacture_info || null;
        var expiryInfo = manufactureInfo && manufactureInfo.expiry_date ? '<br><small>Expiry Date: ' + manufactureInfo.expiry_date + '</small>' : '';
        var batchInfo = manufactureInfo && manufactureInfo.batch_no ? '<br><small>Batch Number: ' + manufactureInfo.batch_no + '</small>' : '';
        var manufactureId = item.manufacture_id || '';
        var soldQty = parseFloat(item.sold_quantity) || 0;
        var returnedQty = parseFloat(item.returned_quantity) || 0;
        var availableQty = parseFloat(item.available_quantity) || 0;
        var unitPrice = parseFloat(item.unit_price) || 0;
        
        var row = '<tr class="rowCount" data-id="' + item.id + '" data-sale-detail-id="' + item.sale_detail_id + '">' +
            '<td class="width_1_p text-start"><p class="set_sn">' + sn + '</p></td>' +
            '<td>' +
            '<input type="hidden" value="' + item.id + '" name="selected_product_id[]">' +
            '<input type="hidden" value="' + item.sale_detail_id + '" name="sale_detail_id[]">' +
            '<input type="hidden" value="' + manufactureId + '" name="manufacture_id[]">' +
            '<span>' + item.name + '(' + item.code + ')' + expiryInfo + batchInfo + '</span>' +
            '</td>' +
            '<td class="sold_qty text-center">' + soldQty.toFixed(2) + '</td>' +
            '<td class="returned_qty text-center">' + returnedQty.toFixed(2) + '</td>' +
            '<td class="available_qty text-center">' + availableQty.toFixed(2) + '</td>' +
            '<td>' +
            '<div class="input-group">' +
            '<input type="text" name="unit_price[]" onfocus="this.select();" class="check_required form-control integerchk input_aligning unit_price_c cal_row" placeholder="Unit Price" value="' + unitPrice.toFixed(2) + '" id="unit_price_' + sn + '">' +
            '<span class="input-group-text">' + getCurrencySymbol() + '</span>' +
            '</div>' +
            '</td>' +
            '<td>' +
            '<div class="input-group">' +
            '<input type="text" data-countid="' + sn + '" id="qty_' + sn + '" name="quantity_amount[]" onfocus="this.select();" class="check_required form-control integerchk input_aligning qty_c cal_row" value="0.00" data-max="' + availableQty + '" placeholder="Return Qty">' +
            '<span class="input-group-text">' + item.unit + '</span>' +
            '</div>' +
            '</td>' +
            '<td class="item_total" style="font-size: 14px; font-weight: 500;">' +
            getCurrencySymbol() + '0.00' +
            '<input type="hidden" name="total[]" class="item_total_value" value="0.00">' +
            '</td>' +
            '<td class="ir_txt_center"><a class="btn btn-xs del_row dlt_button"><iconify-icon icon="solar:trash-bin-minimalistic-broken"></iconify-icon></a></td>' +
            '</tr>';
        $('.add_tr').append(row);
    }

    /**
     * Calculate Row
     */
    function cal_row() {
        let i = 1;
        let row_total = 0;
        let row_total_total = 0;
        $(".unit_price_c").each(function () {
            let unit_price_val = $("#unit_price_" + i).val();
            let qty_val = $("#qty_" + i).val();
            
            // Clean and parse values
            let unit_price = parseFloat(unit_price_val.toString().replace(/[^0-9.-]/g, '')) || 0;
            let qty = parseFloat(qty_val.toString().replace(/[^0-9.-]/g, '')) || 0;
            let availableQty = parseFloat($(this).closest('tr').find('.available_qty').text().toString().replace(/[^0-9.-]/g, '')) || 0;

            // Validate quantity
            let maxQty = parseFloat($("#qty_" + i).attr('data-max')) || availableQty;
            if (qty > maxQty) {
                alert('Return quantity cannot exceed available quantity: ' + maxQty.toFixed(2));
                $("#qty_" + i).val(maxQty.toFixed(2));
                qty = maxQty;
            }

            row_total = unit_price * qty;
            row_total_total += row_total;
            
            // Update total display (flat text, not input field)
            let row = $(this).closest('tr');
            let formattedTotal = row_total.toFixed(2);
            
            // Get currency symbol from the page (check subtotal or grand_total input group)
            let currency = '';
            let currencyInput = $('#subtotal, #grand_total').siblings('.input-group-text');
            if (currencyInput.length) {
                currency = currencyInput.first().text().trim();
            } else {
                currency = getCurrencySymbol();
            }
            
            // Format like PHP getCurrency() - currency before amount
            let displayText = currency ? (currency + formattedTotal) : formattedTotal;
            
            // Update hidden input value
            let hiddenInput = row.find('.item_total_value');
            if (!hiddenInput.length) {
                row.find('.item_total').append('<input type="hidden" name="total[]" class="item_total_value" value="' + formattedTotal + '">');
            } else {
                hiddenInput.val(formattedTotal);
            }
            
            // Update display text (keep hidden input)
            let hiddenInputHtml = row.find('.item_total_value')[0] ? row.find('.item_total_value')[0].outerHTML : '';
            row.find('.item_total').html(displayText + hiddenInputHtml);
            i++;
        });

        let paid_val = $("#paid").val() || 0;
        let other_val = $("#other").val() || 0;
        let paid = parseFloat(paid_val.toString().replace(/[^0-9.-]/g, '')) || 0;
        let other_amount = parseFloat(other_val.toString().replace(/[^0-9.-]/g, '')) || 0;

        // Calculate discount
        let disc = $("#discount").val();
        let totalDiscount = 0;
        if ($.trim(disc) == "" || $.trim(disc) == "%" || $.trim(disc) == "%%" || $.trim(disc) == "%%%" || $.trim(disc) == "%%%%") {
            totalDiscount = 0;
        } else {
            let Disc_fields = disc.split("%");
            let discAmount = Disc_fields[0];
            let discP = Disc_fields[1];

            if (discP == "") {
                totalDiscount = row_total_total * (parseFloat($.trim(discAmount)) / 100);
            } else {
                totalDiscount = parseFloat($.trim(discAmount));
            }
        }

        let subtotal = row_total_total;
        let grand_total = subtotal + other_amount - totalDiscount;
        let due = grand_total - paid;

        $("#subtotal").val(subtotal.toFixed(2));
        $("#grand_total").val(grand_total.toFixed(2));
        $("#due").val(due.toFixed(2));
    }

    /**
     * Set Attribute
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
            $(this).attr("data-countid", i);
            i++;
        });
        // No need to set attributes for total_c as it's now a flat display
    }

    /**
     * Calculate Converted Amount
     */
    function calculateConvertedAmount() {
        var currency = $("#currency").val();
        if (currency && $("#change_currency").is(':checked')) {
            var parts = currency.split('|');
            var conversionRate = parseFloat(parts[1]) || 1;
            var grandTotal = parseFloat($("#grand_total").val()) || 0;
            var convertedAmount = grandTotal * conversionRate;
            $("#converted_amount").val(convertedAmount.toFixed(2));
        }
    }

    /**
     * Get Currency Symbol
     */
    function getCurrencySymbol() {
        var currencyText = $('.input-group-text').first().text();
        return currencyText.trim() || '';
    }

    /**
     * Clear Items Table
     */
    function clearItemsTable() {
        $('.add_tr').empty();
        $('#customer_id').val('');
        $('#customer_name').val('');
        $('#sale_date').val('');
        $('#subtotal').val('0');
        $('#grand_total').val('0');
        $('#due').val('0');
    }

    /**
     * View Return Invoice
     */
    function viewReturnInvoice(id) {
        var url = baseUrl + 'sale-returns/print_return_invoice/' + id;
        var newWindow = window.open(url, 'Print Return Invoice', 'width=1600,height=550');
        if (newWindow) {
            newWindow.focus();
        }
    }

    // Form validation before submit
    $('#sale_return_form').on('submit', function (e) {
        var hasItems = $('.add_tr tr').length > 0;
        if (!hasItems) {
            e.preventDefault();
            alert('Please select a sale and add items to return.');
            return false;
        }

        var hasReturnQty = false;
        $('.qty_c').each(function () {
            if (parseFloat($(this).val()) > 0) {
                hasReturnQty = true;
                return false;
            }
        });

        if (!hasReturnQty) {
            e.preventDefault();
            alert('Please enter return quantities for at least one item.');
            return false;
        }

        // Validate return quantities
        var isValid = true;
        $('.qty_c').each(function () {
            var qty_val = $(this).val();
            var qty = parseFloat(qty_val.toString().replace(/[^0-9.-]/g, '')) || 0;
            var maxQty = parseFloat($(this).attr('data-max')) || parseFloat($(this).closest('tr').find('.available_qty').text().toString().replace(/[^0-9.-]/g, '')) || 0;
            if (qty > maxQty) {
                isValid = false;
                alert('Return quantity cannot exceed available quantity for ' + $(this).closest('tr').find('td:eq(1) span').text());
                $(this).val(maxQty.toFixed(2));
                return false;
            }
        });

        if (!isValid) {
            e.preventDefault();
            cal_row();
            return false;
        }
    });
});

