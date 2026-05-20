$(document).ready(function () {
    "use strict";
    let baseUrl = $("#hidden_base_url").val() || window.location.origin + '/';

    // Load purchase items when purchase is selected
    $(document).on("change", "#purchase_id", function () {
        var purchaseId = $(this).find('option:selected').data('purchase-id');
        if (purchaseId) {
            loadPurchaseItems(purchaseId);
        } else {
            clearItemsTable();
        }
    });

    // Calculate totals when quantity or price changes
    $(document).on("input", ".return_qty, .unit_price", function () {
        calculateRowTotal($(this).closest('tr'));
        calculateReturnTotal();
    });

    // Remove item row
    $(document).on("click", ".remove_item_row", function (e) {
        e.preventDefault();
        $(this).closest('tr').remove();
        updateRowNumbers();
        calculateReturnTotal();
    });

    // Print return invoice
    $(document).on("click", ".print_return_invoice", function () {
        var id = $(this).attr("data-id");
        viewReturnInvoice(id);
    });

    /**
     * Load Purchase Items
     */
    function loadPurchaseItems(purchaseId) {
        $.ajax({
            url: baseUrl + 'purchasereturns/get-purchase-items/' + purchaseId,
            type: 'GET',
            dataType: 'json',
            beforeSend: function () {
                $('#return_items_tbody').html('<tr><td colspan="10" class="text-center">Loading...</td></tr>');
            },
            success: function (response) {
                if (response.error) {
                    alert(response.error);
                    clearItemsTable();
                    return;
                }

                // Update supplier info
                $('#supplier_id').val(response.purchase.supplier_id);
                $('#supplier_name').val(response.purchase.supplier_name);
                $('#purchase_date').val(response.purchase.date);

                // Clear and populate items table
                $('#return_items_tbody').empty();
                $('#no_items_message').hide();

                if (response.items && response.items.length > 0) {
                    response.items.forEach(function (item, index) {
                        if (item.available_quantity > 0) {
                            addItemRow(item, index + 1);
                        }
                    });
                    calculateReturnTotal();
                } else {
                    $('#no_items_message').show();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error loading purchase items:', error);
                alert('Error loading purchase items. Please try again.');
                clearItemsTable();
            }
        });
    }

    /**
     * Add Item Row to Table
     */
    function addItemRow(item, sn) {
        var currency = $('#total_return_amount').siblings('.input-group-text').text() || '';
        var row = '<tr class="return_item_row" data-item-id="' + item.id + '">' +
            '<td class="c_center"><span class="row_sn">' + sn + '</span></td>' +
            '<td><input type="hidden" name="item_id[]" value="' + item.id + '"><span>' + item.name + '</span></td>' +
            '<td>' + item.unit + '</td>' +
            '<td class="purchased_qty">' + item.purchased_quantity + '</td>' +
            '<td class="returned_qty">' + item.returned_quantity + '</td>' +
            '<td class="available_qty">' + item.available_quantity + '</td>' +
            '<td><input type="number" name="unit_price[]" class="form-control unit_price" step="0.01" value="' + item.unit_price + '" required></td>' +
            '<td><input type="number" name="return_quantity_amount[]" class="form-control return_qty" step="0.01" max="' + item.available_quantity + '" value="0" required></td>' +
            '<td class="item_total">' + currency + '0.00<input type="hidden" name="total[]" class="item_total_value" value="0"></td>' +
            '<td class="ir_txt_center"><a href="#" class="btn btn-xs text-danger remove_item_row"><iconify-icon icon="solar:trash-bin-minimalistic-broken"></iconify-icon></a></td>' +
            '</tr>';
        $('#return_items_tbody').append(row);
    }

    /**
     * Calculate Row Total
     */
    function calculateRowTotal(row) {
        var qty = parseFloat(row.find('.return_qty').val()) || 0;
        var price = parseFloat(row.find('.unit_price').val()) || 0;
        var availableQty = parseFloat(row.find('.available_qty').text()) || 0;

        // Validate quantity
        if (qty > availableQty) {
            alert('Return quantity cannot exceed available quantity: ' + availableQty);
            row.find('.return_qty').val(availableQty);
            qty = availableQty;
        }

        var total = qty * price;
        var currency = $('#total_return_amount').siblings('.input-group-text').text() || '';
        
        // Format currency (match PHP getCurrency format)
        var formattedTotal = total.toFixed(2);
        var displayText = currency ? (currency.trim() + formattedTotal) : formattedTotal;
        
        // Update the hidden input value
        var hiddenInput = row.find('.item_total_value');
        if (!hiddenInput.length) {
            // Create hidden input if it doesn't exist
            row.find('.item_total').append('<input type="hidden" name="total[]" class="item_total_value" value="' + total.toFixed(2) + '">');
        } else {
            hiddenInput.val(total.toFixed(2));
        }
        
        // Update the display text (replace everything except the hidden input)
        var hiddenInputHtml = row.find('.item_total_value')[0] ? row.find('.item_total_value')[0].outerHTML : '';
        row.find('.item_total').html(displayText + hiddenInputHtml);
    }

    /**
     * Calculate Return Total
     */
    function calculateReturnTotal() {
        var total = 0;
        $('.item_total_value').each(function () {
            total += parseFloat($(this).val()) || 0;
        });
        // Also check for old format (if any rows still have input fields)
        $('input[name="total[]"]').each(function () {
            if ($(this).hasClass('item_total_value')) {
                total += parseFloat($(this).val()) || 0;
            }
        });
        $('#total_return_amount').val(total.toFixed(2));
    }

    /**
     * Update Row Numbers
     */
    function updateRowNumbers() {
        $('.return_item_row').each(function (index) {
            $(this).find('.row_sn').text(index + 1);
        });
    }

    /**
     * Clear Items Table
     */
    function clearItemsTable() {
        $('#return_items_tbody').empty();
        $('#supplier_id').val('');
        $('#supplier_name').val('');
        $('#purchase_date').val('');
        $('#total_return_amount').val('0');
        $('#no_items_message').show();
    }

    /**
     * View Return Invoice
     */
    function viewReturnInvoice(id) {
        var url = baseUrl + 'purchasereturns/print_return_invoice/' + id;
        var newWindow = window.open(url, 'Print Return Invoice', 'width=1600,height=550');
        if (newWindow) {
            newWindow.focus();
        }
    }

    // Form validation before submit
    $('#purchase_return_form').on('submit', function (e) {
        var hasItems = $('#return_items_tbody tr').length > 0;
        if (!hasItems) {
            e.preventDefault();
            alert('Please select a purchase and add items to return.');
            return false;
        }

        var hasReturnQty = false;
        $('.return_qty').each(function () {
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
    });
});

