@extends('layouts.main')

@section('title', 'Корзина')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/cart.css">
    <link rel="stylesheet" type="text/css" href="/styles/cart_responsive.css">
@endsection

@section('content')
<div class="home">
		<div class="home_container">
			<div class="home_background" style="background-image:url(images/cart.jpg)"></div>
			<div class="home_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content">
								<div class="breadcrumbs">
									<ul>
										<li><a href="{{ route('home') }}">Главная</a></li>
										<li>Корзина</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Cart Info -->

	<div class="cart_info">
		<div class="container">
			<div class="row">
				<div class="col">
					<!-- Column Titles -->
					<div class="cart_info_columns clearfix">
						<div class="cart_info_col cart_info_col_product">Товар</div>
						<div class="cart_info_col cart_info_col_price">Цена</div>
						<div class="cart_info_col cart_info_col_quantity">Количество</div>
						<div class="cart_info_col cart_info_col_total">Итог</div>
					</div>
				</div>
			</div>
			<div class="row cart_items_row">
				<div class="col">

					@php
						$cartItems = \Cart::session($_COOKIE['cart_id'])->getContent();
					@endphp

					@if (count($cartItems) < 1)
						<div class="row row_extra">
							<div class="section_title" style="margin: auto;">Корзина пуста</div>
						</div>
					@endif

					@foreach ($cartItems as $cartItem)
						<!-- Cart Item -->
						<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
							<!-- Name -->
							<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
								<div class="cart_item_image">
									<div><img src="/images/{{ $cartItem->attributes->img }}" alt=""></div>
								</div>
								<div class="cart_item_name_container">
									<div class="cart_item_name"  data-id="{{ $cartItem->id }}"><a href="#">{{ $cartItem->name }}</a></div>
								</div>
							</div>
							<!-- Price -->
							<div class="cart_item_price">$ <span class="item_price">{{ $cartItem->price }}</span></div>
							<!-- Quantity -->
							<div class="cart_item_quantity">
								<div class="product_quantity_container">
									<div class="product_quantity clearfix">
										<span>{{ $cartItem->quantity }} шт</span>
									</div>
								</div>
							</div>
							<!-- Total -->
							@php
								$sumPrice = $cartItem->price * $cartItem->quantity
							@endphp
							<div class="cart_item_total">$ {{ $sumPrice }}</div>
						</div>
					@endforeach

				</div>
			</div>
			<div class="row row_cart_buttons">
				<div class="col">
					<div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="button continue_shopping_button"><a href="{{ route('home') }}">Продолжить покупки</a></div>
						<div class="cart_buttons_right ml-lg-auto">
							<div class="button clear_cart_button"><a id="clearCart" href="{{ route('clearCart') }}">Очистить корзину</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row row_extra">
				<div class="col-lg-4">
					
					<!-- Delivery -->
					<div class="delivery">
						<div class="section_title">Доставка</div>
						<div class="section_subtitle">Укажите желаемый способ доставки</div>
						<div class="delivery_options">
							<label class="delivery_option clearfix">Быстрая доставка
								<input type="radio" name="radio">
								<span class="checkmark"></span>
							</label>
							<label class="delivery_option clearfix">Обычная доставка
								<input type="radio" name="radio">
								<span class="checkmark"></span>
							</label>
							<label class="delivery_option clearfix">Самовывоз
								<input type="radio" checked="checked" name="radio">
								<span class="checkmark"></span>
							</label>
						</div>
					</div>
				</div>

				<div class="col-lg-6 offset-lg-2">
					<div class="cart_total">
						<div class="section_title">Итого</div>
						<div class="section_subtitle">Всего к оплате</div>
						<div class="cart_total_container">
							<ul>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Товаров на сумму</div>
									<div class="cart_total_value ml-auto">$790.90</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Доставка</div>
									<div class="cart_total_value ml-auto">Бесплатно</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Всего</div>
									<div class="cart_total_value ml-auto">$ {{ \Cart::session($_COOKIE['cart_id'])->getTotal() }}</div>
								</li>
							</ul>
						</div>
						@if (count($cartItems) > 0)
							<div class="button checkout_button"><a href="{{ route('checkout') }}">Перейти к оформлению</a></div>
						@endif
					</div>
				</div>
			</div>
		</div>		
	</div>
@endsection

@section('custom_js')
    <script src="js/cart.js"></script>
@endsection