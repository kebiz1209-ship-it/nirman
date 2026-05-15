<!-- Admin Logo Part End -->
<section class="sidebar">
    <div id="left_menu_to_scroll">
        <ul class="sidebar-menu ps ps--active-x ps--active-y tree" data-widget="tree">
            @if (routePermission('user-home'))
                <li class="parent-menu treeview2 menu_assign_class menu__cidirp_1{{ request()->is('home') ? ' active_sub_menu' : '' }}"
                    data-menu__cid="irp_1">
                    <a href="{{ route('home') }}">
                        <iconify-icon icon="solar:home-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.home')</span>
                    </a>
                </li>
            @endif
            @if (menuPermission('Dashboard'))
                <li class="parent-menu treeview2 menu_assign_class menu__cidirp_1{{ request()->is('dashboard') ? ' active_sub_menu' : '' }}"
                    data-menu__cid="irp_1">
                    <a href="{{ route('dashboard') }}">
                        <iconify-icon icon="solar:chart-2-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.dashboard')</span>
                    </a>
                </li>
            @endif
            @if (menuPermission('Production Management'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('productions*') || request()->is('production-loss*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:chart-square-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.production_management')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('manufacture.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('production.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_manufacture')</span></a>
                            </li>
                        @endif
                        @if (routePermission('manufacture.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('production.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.manufacture_list')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('BOM Management'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('manufactures*') || request()->is('production-loss*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:chart-square-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.bom_management')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('rmcategory.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rmcategories.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_rm_category')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rmcategory.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rmcategories.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.rm_category')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rm.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rawmaterials.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_raw_material')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rm.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rawmaterials.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_raw_material')</span></a>
                            </li>
                        @endif
                        @if (routePermission('noi.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('noninventoryitems.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_non_inventory_item')</span></a>
                            </li>
                        @endif
                        @if (routePermission('noi.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('noninventoryitems.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_non_inventory_item')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('RM Stock'))
                <li class="parent-menu treeview menu_assign_class menu__cidirp_1{{ request()->is('getRMStock*') || request()->is('getLowStock*') || request()->is('stock-adjustment*') ? ' active_sub_menu' : '' }}"
                    data-menu__cid="irp_1">
                    <a href="#">
                        <iconify-icon icon="solar:database-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.rm_stocks')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('rm.stock'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('getRMStock') }}"><iconify-icon
                                        icon="solar:database-broken"></iconify-icon><span>@lang('index.rm_stocks')</span></a>
                            </li>
                        @endif
                        @if (routePermission('low.stock'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('getLowStock') }}"><iconify-icon
                                        icon="solar:danger-broken"></iconify-icon><span>@lang('index.low_stock')</span></a>
                            </li>
                        @endif
                        @if (routePermission('stock-adjustment.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('stockAdjust') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_stock_adjustment')</span></a>
                            </li>
                        @endif
                        @if (routePermission('stock-adjustment.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('stockAdjustList') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.stock_adjustment_list')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('Product Stock'))
                <li class="parent-menu treeview2 menu_assign_class menu__cidirp_1{{ request()->is('product-stock*') ? ' active_sub_menu' : '' }}"
                    data-menu__cid="irp_1">
                    <a href="{{ route('product-stock') }}">
                        <iconify-icon icon="solar:bag-2-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.product_stocks')</span>
                    </a>
                </li>
            @endif
            @if (menuPermission('Quality Control'))
                <li class="parent-menu treeview menu_assign_class menu__cidirp_1{{ request()->is('getRMStock*') || request()->is('getLowStock*') || request()->is('stock-adjustment*') ? ' active_sub_menu' : '' }}"
                    data-menu__cid="irp_1">
                    <a href="#">
                        <iconify-icon icon="solar:database-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.quality_control_and_waste_management')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('production-loss.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('production-loss') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_production_loss')</span></a>
                            </li>
                        @endif
                        @if (routePermission('production-loss.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('production-loss-report') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.production_loss_list')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rmwaste.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rmwastes.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_rm_waste')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rmwaste.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rmwastes.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_rm_waste')</span></a>
                            </li>
                        @endif
                        @if (routePermission('productwaste.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('product-wastes.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_product_waste')</span></a>
                            </li>
                        @endif
                        @if (routePermission('productwaste.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('product-wastes.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_product_waste')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('Sales'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('sales*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:cart-large-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.sale')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('sale.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('sales.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_sale')</span></a>
                            </li>
                        @endif
                        @if (routePermission('sale.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('sales.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.sale_list')</span></a>
                            </li>
                        @endif
                        @if (routePermission('customer.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customers.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_customer')</span></a>
                            </li>
                        @endif
                        @if (routePermission('customer.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customers.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_customer')</span></a>
                            </li>
                        @endif
                        @if (routePermission('customer.due-report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customer-due-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.customer_due_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('customer.ledger'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customer-ledger') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.customer_ledger')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('Supply Chain Management'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('sales*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:cart-large-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.supply_chain_management')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('supplier.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('suppliers.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_supplier')</span></a>
                            </li>
                        @endif
                        @if (routePermission('supplier.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('suppliers.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_supplier')</span></a>
                            </li>
                        @endif
                        @if (routePermission('purchase.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rawmaterialpurchases.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_purchase')</span></a>
                            </li>
                        @endif
                        @if (routePermission('purchase.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rawmaterialpurchases.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_purchase')</span></a>
                            </li>
                        @endif
                        @if (routePermission('supplierdue.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('supplier-due-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.supplier_due_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('supplier.balance-report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('supplier-balance-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.supplier_balance_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('supplierledger.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('supplier-ledger') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.supplier_ledger')</span></a>
                            </li>
                        @endif
                        @if (routePermission('demand-forecasting.order'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('forecasting.order') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.demand_forecasting_by_order')</span></a>
                            </li>
                        @endif
                        @if (routePermission('demand-forecasting.product'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('forecasting.product') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.demand_forecasting_by_product')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rm-price-history'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('price-history') }}"><iconify-icon
                                        icon="solar:notebook-broken"></iconify-icon><span>@lang('index.rm_price_history')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('Orders'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('customer-orders*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:user-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.orders')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('order.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customer-orders.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_order')</span></a>
                            </li>
                        @endif
                        @if (routePermission('order.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customer-orders.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.order_list')</span></a>
                            </li>
                        @endif
                        @if (routePermission('order-status'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customer-order-status') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.order_status')</span></a>
                            </li>
                        @endif
                        @if (routePermission('quotations.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('quotation.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_quotion')</span></a>
                            </li>
                        @endif
                        @if (routePermission('quotations.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('quotation.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.quotion_list')</span></a>
                            </li>
                        @endif
                        @if (routePermission('product.low-stock'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rawmaterialpurchases.create') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.po_by_low_stock')</span></a>
                            </li>
                        @endif
                        @if (routePermission('product.work-order'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rawmaterialpurchases.create') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.po_by_work_order')</span></a>
                            </li>
                        @endif
                        @if (routePermission('product.production'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rawmaterialpurchases.create') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.po_by_production')</span></a>
                            </li>
                        @endif
                        @if (routePermission('product.multiple-product'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rawmaterialpurchases.create') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.po_by_products')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('Accounting'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('accounts*') || request()->is('deposit*') || request()->is('balance-sheet*') || request()->is('trial-balance*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:wallet-money-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.accounting')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('account.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('accounts.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_account')</span></a>
                            </li>
                        @endif
                        @if (routePermission('account.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('accounts.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_account')</span></a>
                            </li>
                        @endif
                        @if (routePermission('deposit.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('deposit.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_deposit_or_withdraw')</span></a>
                            </li>
                        @endif
                        @if (routePermission('deposit.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('deposit.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_deposit_or_withdraw')</span></a>
                            </li>
                        @endif
                        @if (routePermission('balancesheet'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('balance-sheet') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.balance_sheet')</span></a>
                            </li>
                        @endif
                        @if (routePermission('trialbalance'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('trial-balance') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.trial_balance')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('HRM'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('attendance*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:stopwatch-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.hrm')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('attendance.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('attendance.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_attendance')</span></a>
                            </li>
                        @endif
                        @if (routePermission('attendance.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('attendance.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.attendance_list')</span></a>
                            </li>
                        @endif
                        @if (routePermission('payroll.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('payroll.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_payroll')</span></a>
                            </li>
                        @endif
                        @if (routePermission('payroll.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('payroll.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_payroll')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (menuPermission('Supplier Payment'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('supplier-payment*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:card-send-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.supplier_payment')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('supplier-payment.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('supplier-payment.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_supplier_payment')</span></a>
                            </li>
                        @endif
                        @if (routePermission('supplier-payment.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('supplier-payment.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.supplier_payment_list')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('Customer Receives'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('customer-payment*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:card-recive-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.customer_receive')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('customer-received.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customer-payment.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_customer_receive')</span></a>
                            </li>
                        @endif
                        @if (routePermission('customer-received.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customer-payment.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.customer_receive_list')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('Item Setup'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('rmcategories*') || request()->is('rawmaterials*') || request()->is('noninventoryitems*') || request()->is('fpcategories*') || request()->is('finishedproducts*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:inbox-line-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.item_setup')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        <li class="px-4 mt-2 submenu_header">@lang('index.finished_product')</li>
                        <div class="dropdown-divider"></div>
                        @if (routePermission('productcategory.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('fpcategories.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_product_category')</span></a>
                            </li>
                        @endif
                        @if (routePermission('productcategory.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('fpcategories.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_product_category')</span></a>
                            </li>
                        @endif
                        @if (routePermission('product.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('finishedproducts.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_product')</span></a>
                            </li>
                        @endif
                        @if (routePermission('product.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('finishedproducts.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_product')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (menuPermission('Reports'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('rm-purchase-report*') || request()->is('rm-item-purchase-report*') || request()->is('rm-stock-report*') || request()->is('supplier-due-report*') || request()->is('supplier-balance-report*') || request()->is('supplier-ledger*') || request()->is('production-report*') || request()->is('fp-production-report*') || request()->is('fp-sale-report*') || request()->is('fp-item-sale-report*') || request()->is('customer-due-report*') || request()->is('customer-ledger*') || request()->is('profit-loss-report*') || request()->is('product-profit-report*') || request()->is('attendance-report*') || request()->is('expense-report*') || request()->is('salary-report*') || request()->is('rmwaste-report*') || request()->is('fpwaste-report*') || request()->is('rm-price-history') || request()->is('product-price-history') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:diagram-down-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.report')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('product-price-history'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('product.price.history') }}"><iconify-icon
                                        icon="solar:notebook-broken"></iconify-icon><span>@lang('index.product_price_history')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rm-price-history'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('price-history') }}"><iconify-icon
                                        icon="solar:notebook-broken"></iconify-icon><span>@lang('index.rm_price_history')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rmpurchase.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rm-purchase-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.rm_purchase_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rmpurchaseitem.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rm-item-purchase-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.rm_item_purchase_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rmstock.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rm-stock-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.rm_stock_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('supplierdue.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('supplier-due-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.supplier_due_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('supplier.balance-report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('supplier-balance-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.supplier_balance_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('supplierledger.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('supplier-ledger') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.supplier_ledger')</span></a>
                            </li>
                        @endif
                        @if (routePermission('production.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('production-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.production_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('fpp.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('fp-production-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.fp_production_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('fpsale.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('fp-sale-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.fp_sale_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('fpitemsale.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('fp-item-sale-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.fp_item_sale_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('customerdue.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customer-due-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.customer_due_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('customerledger'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('customer-ledger') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.customer_ledger')</span></a>
                            </li>
                        @endif
                        @if (routePermission('profit-loss'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('profit-loss-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.profit_loss_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('production-profit.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('product-profit-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.product_profit_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('attandance.report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('attendance-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.attendance_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('expense-report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('expense-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.expense_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('salary-report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('salary-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.salary_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('rmwaste-report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('rmwaste-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.rmwaste_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('productwaste-report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('fpwaste-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.product_waste_report')</span></a>
                            </li>
                        @endif
                        @if (routePermission('abcanalysis-report'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('abc-analysis-report') }}"><iconify-icon
                                        icon="solar:clipboard-list-broken"></iconify-icon><span>@lang('index.abc_analysis_report')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('Expenses'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('expense') || request()->is('expense/*') || request()->is('expense-category*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:money-bag-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.expense')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('expense.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('expense.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_expense')</span></a>
                            </li>
                        @endif
                        @if (routePermission('expense.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('expense.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.expense_list')</span></a>
                            </li>
                        @endif
                        @if (routePermission('expense-category.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('expense-category.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_expense_category')</span></a>
                            </li>
                        @endif
                        @if (routePermission('expense-category.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('expense-category.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.expense_category_list')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('Users'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('user*') || request()->is('role*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:user-circle-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.user')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('role.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('role.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_role')</span></a>
                            </li>
                        @endif
                        @if (routePermission('role.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('role.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_role')</span></a>
                            </li>
                        @endif
                        @if (routePermission('user.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('user.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_user')</span></a>
                            </li>
                        @endif
                        @if (routePermission('user.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('user.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_user')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (menuPermission('Settings'))
                <li
                    class="parent-menu treeview menu__cidirp_10{{ request()->is('settings') || request()->is('white-label') || request()->is('taxes') || request()->is('units*') || request()->is('mail-settings') || request()->is('productionstages*') ? ' active_sub_menu' : '' }}">
                    <a href="#">
                        <iconify-icon icon="solar:settings-broken"></iconify-icon>
                        <span class="match_bold">@lang('index.settings')</span>
                    </a>
                    <div class="triangle"></div>
                    <ul class="treeview-menu">
                        @if (routePermission('company-profile'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('settings') }}">
                                    <iconify-icon icon="solar:settings-minimalistic-broken"></iconify-icon>
                                    <span>@lang('index.company_profile')</span>
                                </a>
                            </li>
                        @endif
                        @if (routePermission('tax-settings'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('taxes') }}"><iconify-icon
                                        icon="solar:target-broken"></iconify-icon><span>@lang('index.tax_settings')</span></a>
                            </li>
                        @endif
                        @if (routePermission('units.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('units.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_unit')</span></a>
                            </li>
                        @endif
                        @if (routePermission('units.index'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('units.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_unit')</span></a>
                            </li>
                        @endif
                        @if (isWhiteLabelChangeAble())
                            @if (routePermission('white-label'))
                                <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                        href="{{ route('white-label') }}"><iconify-icon
                                            icon="solar:sledgehammer-broken"></iconify-icon><span>@lang('index.white_label')</span></a>
                                </li>
                            @endif
                        @endif
                        @if (routePermission('mail-settings'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('settings.mail.index') }}"><iconify-icon
                                        icon="solar:letter-unread-broken"></iconify-icon></i><span>@lang('index.mail_settings')</span></a>
                            </li>
                        @endif
                        @if (routePermission('productionstage.create'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('productionstages.create') }}"><iconify-icon
                                        icon="solar:add-circle-broken"></iconify-icon><span>@lang('index.add_production_stage')</span></a>
                            </li>
                        @endif
                        @if (routePermission('productionstage.list'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('productionstages.index') }}"><iconify-icon
                                        icon="solar:checklist-broken"></iconify-icon><span>@lang('index.list_production_stage')</span></a>
                            </li>
                        @endif
                        @if (routePermission('data-import'))
                            <li class="menu_assign_class" data-menu__cid="irp_10"><a
                                    href="{{ route('data-import') }}"><iconify-icon
                                        icon="solar:import-broken"></iconify-icon><span>@lang('index.data_import')</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            <div class="ps__rail-x">
                <div class="ps__thumb-x" tabindex="0"></div>
            </div>
            <div class="ps__rail-y">
                <div class="ps__thumb-y" tabindex="0"></div>
            </div>
        </ul>
    </div>
</section>
