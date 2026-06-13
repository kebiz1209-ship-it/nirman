<style>
.disabled-menu {
    pointer-events: none;
    opacity: 0.6;
    cursor: not-allowed;
}

.disabled-parent .treeview-menu {
    display: none !important;
}
</style>

<div class="logo_Section_main_sidebar">

    <a href="{{ route('home') }}" class="logo-wrapper">

        @php
            $photo = isset($whiteLabelInfo->mini_logo)
                ? 'uploads/white_label/' . $whiteLabelInfo->mini_logo
                : 'frequent_changing/images/mini_logo.png';

            $logo_lg = isset($whiteLabelInfo->logo)
                ? 'uploads/white_label/' . $whiteLabelInfo->logo
                : 'frequent_changing/images/logo.png';
        @endphp

        <span class="logo-lg">
            <img src="{{ $baseURL . $logo_lg }}" class="img-circle" alt="Logo Image">
        </span>

        <span class="logo-mini">
            <img src="{{ $baseURL . $photo }}" class="img-circle" alt="Logo Image">
        </span>

    </a>

    <a href="#"
       class="sidebar-toggle set_collapse"
       data-status="{{ session()->get('is_collapse') == 'Yes' ? 1 : 2 }}"
       data-toggle="push-menu"
       role="button"
       style="transform: rotate(0deg); transition: 0.7s;">

        <iconify-icon icon="solar:round-alt-arrow-left-broken" width="25"></iconify-icon>

    </a>

</div>

<!-- Sidebar -->
<section class="sidebar">

    <div id="left_menu_to_scroll">

        <ul class="sidebar-menu ps ps--active-x ps--active-y tree"
    data-widget="tree">

    <!-- DASHBOARD -->
    <li class="{{ request()->is('sales-dashboard') ? 'active_sub_menu' : '' }}">

        <a href="{{ route('sales.dashboard') }}">

            <iconify-icon icon="solar:home-2-broken"></iconify-icon>

            <span class="match_bold">
                Dashboard
            </span>

        </a>

    </li>

    <!-- ORDERS -->
    <li class="parent-menu treeview2 {{ request()->is('sales/order') ? 'menu-open active_sub_menu' : '' }}">

                <a href="{{ route('pages.sales.order') }}" class="ajax-link">

                    <iconify-icon icon="solar:user-broken"></iconify-icon>

                    <span class="match_bold">
                       Orders 
                    </span>

                </a>

            </li>



    <!-- CUSTOMER -->
<li class="parent-menu treeview2 {{ request()->is('sales-customer*') ? 'menu-open active_sub_menu' : '' }}">

    <a href="{{ route('pages.sales.customer.index') }}" class="ajax-link">

            <iconify-icon icon="solar:users-group-rounded-broken"></iconify-icon>


            <span class="match_bold">
                Customer
            </span>

        </a>

    </li>

    <!-- ENQUIRIES -->
    <li>

        <a href="{{ route('pages.sales.enquiry.index') }}" class="ajax-link">

            <iconify-icon icon="solar:chat-round-line-broken"></iconify-icon>

            <span class="match_bold">
                Enquiries
            </span>

        </a>

    </li>

    <!-- MY FOLLOW UPS -->
    <li>

        <a href="{{ route('pages.sales.followups') }}" class="ajax-link">

            <iconify-icon icon="solar:phone-calling-rounded-broken"></iconify-icon>

            <span class="match_bold">
                My Follow Ups
            </span>

        </a>

    </li>

    <!-- SAMPLES -->
    <li>

        <a href="{{ route('pages.sales.samples') }}" class="ajax-link">

            <iconify-icon icon="solar:box-broken"></iconify-icon>

            <span class="match_bold">
                Samples
            </span>

        </a>

    </li>

    <!-- PAYMENT -->


<li class="parent-menu treeview2 {{ request()->is('sales-payment*') ? 'menu-open active_sub_menu' : '' }}">

    <a href="{{ route('pages.sales.payment.index') }}" class="ajax-link">

        <iconify-icon icon="solar:user-broken"></iconify-icon>

        <span class="match_bold">
            Payment
        </span>

    </a>

</li>


<!-- CUSTOMER FEEDBACK -->
<li class="parent-menu treeview2 {{ request()->is('sales-feedback*') ? 'menu-open active_sub_menu' : '' }}">

    <a href="{{ route('pages.sales.feedback.index') }}" class="ajax-link">

        <iconify-icon icon="solar:chat-round-like-broken"></iconify-icon>

        <span class="match_bold">
            Customer Feedback
        </span>

    </a>

</li>
    <!-- REPORTS -->
    <li>

        <a href="javascript:void(0)">

            <iconify-icon icon="solar:chart-2-broken"></iconify-icon>

            <span class="match_bold">
                Reports
            </span>

        </a>

    </li>

    <div class="ps__rail-x">
        <div class="ps__thumb-x" tabindex="0"></div>
    </div>

    <div class="ps__rail-y">
        <div class="ps__thumb-y" tabindex="0"></div>
    </div>

</ul>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).on('click', '.ajax-link', function(e) {

    e.preventDefault();

    let url = $(this).attr('href');

    $('.content-wrapper').html(
        '<div class="text-center p-5">Loading...</div>'
    );

    $.ajax({
        url: url,
        type: "GET",

        success: function(response) {

            let html = $(response)
                .find('.content-wrapper')
                .html();

            $('.content-wrapper').html(html);

            window.history.pushState({}, '', url);
        }
    });

});
</script>

<script>
window.onpopstate = function() {
    location.reload();
};
</script>