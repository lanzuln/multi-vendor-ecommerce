@php
    $id = Auth::user()->id;
    $vendor = App\Models\User::find($id);
    $status = $vendor->status;
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backendAdmin/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Vendor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
            <ul>

            </ul>
        </li>

        @if ($status === 'active')
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Product manage</div>
                </a>
                <ul>
                    <li> <a href="app-emailbox.html"><i class="bx bx-right-arrow-alt"></i>all product</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">All Order</div>
                </a>
                <ul>
                    <li> <a href="app-emailbox.html"><i class="bx bx-right-arrow-alt"></i>all order</a>
                    </li>
                </ul>
            </li>
        @else
        @endif

    </ul>
    <!--end navigation-->
</div>
