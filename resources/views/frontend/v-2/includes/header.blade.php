<header class="header-section">
    <div class="container">
        <div class="header-top-wrapper">
            <a href="{{ url('/') }}" class="brand-logo-outer">
                <img src="{{asset('setting/'.$setting->logo)}}">
            </a>
            <div class="search-form-outer" id="search">
                <search></search>
            </div>
            <div class="header-top-right-outer">
                <div id="cart">
                    <add-cart></add-cart>
                </div>
                {{-- <div class="header-top-right-item dropdown account">
                    <div class="header-top-right-item-link">
                        @if (auth()->check())
                        <i class="fas fa-user"></i> {{ auth()->user()->name }}
                        @else
                        <i class="fas fa-user"></i> <a href="{{url('/customer/login-form')}}" class="account-list-item-link">Login</a>
                        @endif
                    </div>
                    <ul class="account-list">
                        <li class="account-list-item">
                            @if (auth()->check())
                            <a href="{{ route('logout') }}" class="account-list-item-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-user"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                             </form>
                            @endif
                        </li>
                        
                    </ul>
                </div> --}}
            </div>
        </div>
        <div class="responsive search-form-outer" id="search1">
            <search></search>
        </div>
        <div class="header-bottom-wrapper">
            <div class="category-items-wrapper">
                <div class="category-icon-outer">
                    <i class="fas fa-th-large"></i> <span>All Category</span>
                </div>
                <div class="category-items-outer">
                    <ul class="category-list">
                        @foreach ($categories as $category)
                            <li class="category-list-item item-has-submenu">
                                <a href="{{ url('/products/'.$category->slug) }}" class="category-list-item-link">
                                    <img src="{{ asset('/category/'.$category->image) }}" alt="category">
                                    {{ $category->name }}
                                </a>
                                <ul class="nav-item-category-submenu">
                                    @foreach($category->subcategories as $subcategory)
                                        <li class="category-submenu-item">
                                            <a href="{{ url('/subcategory/products/'.$subcategory->slug) }}" class="category-submenu-item-link">
                                                {{ $subcategory->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
