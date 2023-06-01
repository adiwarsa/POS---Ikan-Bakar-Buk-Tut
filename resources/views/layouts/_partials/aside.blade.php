<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo justify-content-center">
		<img style="max-width: 100%; max-height: 100%;" src="{{ asset('assets/img/elements/logo.png') }}" alt="">
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<!-- Dashboard -->
		@if (auth()->user()->role == 1)
		<li class="menu-item {{ menuIsActive('home') }}">
			<a href="{{ route('home') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Analytics">
					{{ __('Dashboard') }}
				</div>
			</a>
		</li>

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">
				{{ __('Management User') }}
			</span>
		</li>

		<li class="menu-item {{ menuIsActive('users.*') }}">
			<a href="{{ route('users.index') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-user"></i>
				<div data-i18n="User">
					{{ __('User') }}
				</div>
			</a>
		</li>
		@endif
		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">
				{{ __('Management Supplier') }}
			</span>
		</li>

		<li class="menu-item {{ menuIsActive('supplier.*') }}">
			<a href="{{ route('supplier.index') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bxs-truck"></i>
				<div data-i18n="Supplier">
					{{ __('Supplier') }}
				</div>
			</a>
		</li>

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">
				{{ __('Management Stock') }}
			</span>
		</li>

		<li class="menu-item {{ menuIsActive('stock.*') }}">
			<a href="{{ route('stock.index') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-package"></i>
				<div data-i18n="Stock">
					{{ __('Stock') }}
				</div>
			</a>
		</li>

		<li class="menu-item {{ menuIsActive('stockin.*') }}">
			<a href="{{ route('stockin.index') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-message-square-add"></i>
				<div data-i18n="Stock In ">
					{{ __('Stock In ') }}
				</div>
			</a>
		</li>

		<li class="menu-item {{ menuIsActive('stockout.*') }}">
			<a href="{{ route('stockout.index') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-message-square-minus"></i>
				<div data-i18n="Stock Out ">
					{{ __('Stock Out ') }}
				</div>
			</a>
		</li>

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">
				{{ __('Management Menu') }}
			</span>
		</li>

		<li class="menu-item {{ menuIsActive('food.*') }}">
			<a href="{{ route('food.index') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-food-menu"></i>
				<div data-i18n="Menu ">
					{{ __('Menu ') }}
				</div>
			</a>
		</li>

		<li class="menu-item {{ menuIsActive('paket.*') }}">
			<a href="{{ route('paket.index') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-book"></i>
				<div data-i18n="Paket ">
					{{ __('Paket ') }}
				</div>
			</a>
		</li>

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">
				{{ __('Transaction Menu') }}
			</span>
		</li>

		<li class="menu-item {{ menuIsActive('transaction.*') }}">
			<a href="{{ route('transaction.index') }}" class="menu-link">
				<i class="menu-icon tf-icons bx bx-receipt"></i>
				<div data-i18n="Transaction ">
					{{ __('Transaction ') }}
				</div>
			</a>
		</li>
		<!-- <li class="menu-item">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons bx bx-cube-alt"></i>
				<div data-i18n="Misc">Misc</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item">
					<a href="javascript:void(0);" class="menu-link">
						<div data-i18n="Error">Error</div>
					</a>
				</li>
			</ul>
		</li> -->

	</ul>
</aside>