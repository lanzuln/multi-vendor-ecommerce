<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backendAdmin/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}" >
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        {{-- brand  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.brand') }}"><i class="bx bx-right-arrow-alt"></i>All brand</a></li>
                <li> <a href="{{ route('create.brand') }}"><i class="bx bx-right-arrow-alt"></i>Add brand</a></li>
            </ul>
        </li>
        {{-- category --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.category') }}"><i class="bx bx-right-arrow-alt"></i>All category</a></li>
                <li> <a href="{{ route('create.category') }}"><i class="bx bx-right-arrow-alt"></i>Add category</a></li>
            </ul>
        </li>
        {{-- sub category --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Sub Category</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>All category</a></li>
                <li> <a href="{{ route('create.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Add category</a>
                </li>
            </ul>
        </li>
        {{-- product --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Product</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt"></i>All Product</a></li>
                <li> <a href="{{ route('create.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
            </ul>
        </li>
        {{-- slider manage  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Slider Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.slider') }}"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
                </li>
                <li> <a href="{{ route('add.slider') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>

            </ul>
        </li>
        {{-- Banner Manage --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Banner Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.banner') }}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
                </li>
                <li> <a href="{{ route('add.banner') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>

                </li>

            </ul>
        </li>

        {{-- coupon management  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Coupon System</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.coupon') }}"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
                </li>
                <li> <a href="{{ route('add.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                </li>

            </ul>
        </li>
        {{-- shipping managament  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Shipping Area </div>
            </a>
            <ul>
                <li> <a href="{{ route('all.division') }}"><i class="bx bx-right-arrow-alt"></i>All Division</a>
                </li>
                <li> <a href="{{ route('all.district') }}"><i class="bx bx-right-arrow-alt"></i>All District</a>
                </li>
                <li> <a href="{{ route('all.state') }}"><i class="bx bx-right-arrow-alt"></i>All State</a></li>

            </ul>
        </li>
        {{-- order managament  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Order Manage </div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Pending
                        Order</a>
                </li>
                <li> <a href="{{ route('admin.confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed
                        Order</a>
                </li>
                <li> <a href="{{ route('admin.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing
                        Order</a>
                </li>
                <li> <a href="{{ route('admin.delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered
                        Order</a>
                </li>


            </ul>
        </li>
        {{-- return  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='lni lni-paperclip'></i>
                </div>
                <div class="menu-title">Return Order </div>
            </a>
            <ul>
                <li> <a href="{{ route('return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return
                        Request</a>
                </li>
                <li> <a href="{{ route('complete.return.request') }}"><i class="bx bx-right-arrow-alt"></i>Complete
                        Request</a>
                </li>
            </ul>
        </li>
            {{-- Stock Manage  --}}
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="lni lni-cart-full"></i>
                    </div>
                    <div class="menu-title">Stock Manage</div>
                </a>
                <ul>
                    <li> <a href="{{ route('product.stock') }}"><i class="bx bx-right-arrow-alt"></i>Product
                            Stock</a>
                    </li>
                </ul>
            </li>

        {{-- report view  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-stats-up"></i>
                </div>
                <div class="menu-title">Reports Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('report.view') }}"><i class="bx bx-right-arrow-alt"></i>Report View</a>
                </li>

                <li> <a href="{{ route('order.by.user') }}"><i class="bx bx-right-arrow-alt"></i>Order By
                        User</a>
                </li>


            </ul>
        </li>

        {{-- User Manage  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-slideshare"></i>
                </div>
                <div class="menu-title">User Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('all-user') }}"><i class="bx bx-right-arrow-alt"></i>All User</a>
                </li>

                <li> <a href="{{ route('all-vendor') }}"><i class="bx bx-right-arrow-alt"></i>All Vendor</a>
                </li>
            </ul>
        </li>
        {{-- Blog Manage  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-pyramids"></i>
                </div>
                <div class="menu-title">Blog Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.blog.category') }}"><i class="bx bx-right-arrow-alt"></i>All Blog
                        Categroy</a>
                </li>

                <li> <a href="{{ route('admin.blog.post') }}"><i class="bx bx-right-arrow-alt"></i>All Blog
                        Post</a>
                </li>


            </ul>
        </li>
        {{-- Review Manage  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-indent-increase"></i>
                </div>
                <div class="menu-title">Review Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending
                        Review</a>
                </li>

                <li> <a href="{{ route('publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Publish
                        Review</a>
                </li>


            </ul>
        </li>

        <li class="menu-label">Vendor management</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Vendor management</div>
            </a>
            <ul>
                <li> <a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Inactive
                        vendor</a>
                </li>
                <li> <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Active vendor</a>
                </li>
            </ul>
        </li>

        <li class="menu-label">General</li>
        {{-- Setting Manage  --}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-cog"></i>
                </div>
                <div class="menu-title">Setting Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt"></i>Site Setting</a>
                </li>

                <li> <a href="{{ route('seo.setting') }}"><i class="bx bx-right-arrow-alt"></i>Seo Setting</a>
                </li>


            </ul>
        </li>
        {{-- Roles And Permission  --}}
        <li class="menu-label">Roles And Permission</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-users"></i>
                </div>
                <div class="menu-title">Role & Permission</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.permission') }}"><i class="bx bx-right-arrow-alt"></i>All
                        Permission</a>
                </li>
                <li> <a href="{{ route('all.roles') }}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                </li>

                <li> <a href="{{ route('add.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>Roles in
                        Permission</a>
                </li>

                <li> <a href="{{ route('all.roles.permission') }}"><i class="bx bx-right-arrow-alt"></i>All Roles
                        in Permission</a>
                </li>

            </ul>
        </li>
        {{-- Admin Manage   --}}
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="lni lni-user"></i>
                </div>
                <div class="menu-title">Admin Manage </div>
            </a>
            <ul>
                <li> <a href="{{ route('all.admin') }}"><i class="bx bx-right-arrow-alt"></i>All Admin</a>
                </li>
                <li> <a href="{{ route('add.admin') }}"><i class="bx bx-right-arrow-alt"></i>Add Admin</a>
                </li>


            </ul>
        </li>

        <li class="menu-label">UI Elements</li>


    </ul>
    <!--end navigation-->
</div>
