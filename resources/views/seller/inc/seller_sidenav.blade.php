<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <div class="d-block text-center my-3">
                @if ((Auth::user())->avatar_original != null)
                    <img class="mw-100 mb-3" src="{{ uploaded_asset((Auth::user())->avatar_original) }}"
                        class="brand-icon" >
                @else
                    <img class="mw-100 mb-3" src="{{ uploaded_asset(0) }}" class="brand-icon"
                        alt="">
                @endif
                <h3 class="fs-16  m-0 text-primary">{{ optional(Auth::user())->name }}</h3>
                @if((Session::get('carrier_data')) != null)
                    <p class="text-primary">{{ Session::get('carrier_data')->name }}</p>
                @endif
                <p class="text-primary">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="aiz-side-nav-wrap">
            <div class="px-20px mb-3">
                <input class="form-control bg-soft-secondary border-0 form-control-sm" type="text" name=""
                    placeholder="Search in menu" id="menu-search" onkeyup="menuSearch()">
            </div>
            <ul class="aiz-side-nav-list" id="search-menu">
            </ul>
            <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">
                <li class="aiz-side-nav-item">
                    <a href="{{ route('shipper.dashboard') }}" class="aiz-side-nav-link">
                        <i class="fa fa-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Dashboard'</span>
                    </a>
                </li>

                @if(Auth::user()->approved == 1)
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('shipper.orders.index') }}" class="aiz-side-nav-link">
                            <i class="fas fa-shipping-fast aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">Shipping Order</span>
                        </a>
                    </li>
                @endif
                

                <li class="aiz-side-nav-item">
                    <a href="{{ route('shipper.shop.index') }}" class="aiz-side-nav-link">
                        <i class="fa fa-cog aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Personal Information</span>
                    </a>
                </li>

               

            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div>