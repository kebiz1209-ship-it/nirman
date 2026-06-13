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

<ul class="sidebar-menu ps ps--active-x ps--active-y tree" data-widget="tree">

    <!-- DASHBOARD -->
    <li class="{{ request()->is('sales-dashboard') ? 'active_sub_menu' : '' }}">
        <a href="{{ route('sales.dashboard') }}">
            <iconify-icon icon="solar:home-2-broken"></iconify-icon>
            <span class="match_bold">Dashboard</span>
        </a>
    </li>

    <!-- ORDERS -->
    <li>
       <a href="javascript:void(0)">
            <iconify-icon icon="solar:document-text-broken"></iconify-icon>
            <span class="match_bold">Incoming QC</span>
        </a>
    </li>

    <!-- PRODUCT AVAILABILITY -->
    <li>
       <a href="javascript:void(0)">
            <iconify-icon icon="solar:box-minimalistic-broken"></iconify-icon>
            <span class="match_bold">In Process QC</span>
        </a>
    </li>

    <!-- COMMUNICATION CENTER -->
    <li>
        <a href="javascript:void(0)">
            <iconify-icon icon="solar:chat-round-dots-broken"></iconify-icon>
            <span class="match_bold">Final QC</span>
        </a>
    </li>

    <!-- APPROVAL CENTER -->
    <li>
        <a href="javascript:void(0)">
            <iconify-icon icon="solar:check-circle-broken"></iconify-icon>
            <span class="match_bold">COA</span>
        </a>
    </li>

    <!-- PRODUCTION PLANNING -->
    <li>
        <a href="javascript:void(0)">
            <iconify-icon icon="solar:clipboard-list-broken"></iconify-icon>
            <span class="match_bold">Reports</span>
        </a>
    </li>



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