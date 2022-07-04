@extends('layouts.main')

@section('title', 'Оформление заказа')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/checkout.css">
<link rel="stylesheet" type="text/css" href="/styles/checkout_responsive.css">
@endsection

@section('content')
    <div class="home">
		<div class="home_container">
			<div class="home_background" style="background-image:url(/images/cart.jpg)"></div>
			<div class="home_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content">
								<div class="breadcrumbs">
									<ul>
										<li><a href="{{ route('home') }}">Главная</a></li>
										<li><a href="{{ route('cartIndex') }}">Корзина</a></li>
										<li>Оформление заказа</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Checkout -->
	
	<div class="checkout">
		<div class="container">
			<div class="row">

				<!-- Billing Info -->
    
                <form action="{{ route('placeOrder') }}" id="checkout_form" class="checkout_form row">
                    @csrf
                    <div class="col-lg-6">
                        <div class="billing checkout_section">
                            <div class="section_title">Контактные данные</div>
                            <div class="section_subtitle">Введите информацию о вашем адресе</div>
                            <div class="checkout_form_container">
                                <!-- <form action="#" id="checkout_form" class="checkout_form"> -->
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <!-- Name -->
                                            <label for="checkout_name">Имя*</label>
                                            <input type="text" id="checkout_name" name="first_name" class="checkout_input" required>
                                        </div>
                                        <div class="col-xl-6 last_name_col">
                                            <!-- Last Name -->
                                            <label for="checkout_last_name">Фамилия*</label>
                                            <input type="text" id="checkout_last_name" name="last_name" class="checkout_input" required>
                                        </div>
                                    </div>
                                    <div>
                                        <!-- Address -->
                                        <label for="checkout_address">Адрес*</label>
                                        <input type="text" id="checkout_address" name="address" class="checkout_input" required>
                                    </div>
                                    <div>
                                        <!-- Zipcode -->
                                        <label for="checkout_zipcode">Почтовый индекс*</label>
                                        <input type="text" id="checkout_zipcode" name="zipcode" class="checkout_input" required>
                                    </div>
                                    <div>
                                        <!-- City / Town -->
                                        <label for="checkout_city">Город*</label>
                                        <input type="text" id="checkout_city" name="city" class="checkout_input" required>
                                        <!-- <label for="checkout_city">Город*</label>
                                        <select name="checkout_city" id="checkout_city" class="dropdown_item_select checkout_input" require>
                                            <option></option>
                                            <option>Москва</option>
                                            <option>Краснодар</option>
                                            <option>Урюпинскк</option>
                                            <option>Самара</option>
                                        </select> -->
                                    </div>
                                    <div>
                                        <!-- Phone no -->
                                        <label for="checkout_phone">Номер телефона*</label>
                                        <input type="tel" id="checkout_phone" name="phone" class="checkout_input" required>
                                    </div>
                                    <div>
                                        <!-- Email -->
                                        <label for="checkout_email">Email*</label>
                                        <input type="email" id="checkout_email" name="email" class="checkout_input" required>
                                    </div>
                                    <div class="checkout_extra">
                                        <div>
                                            <input type="checkbox" id="checkbox_terms" name="regular_checkbox" class="regular_checkbox" checked="checked" required>
                                            <label for="checkbox_terms"><img src="/images/check.png" alt=""></label>
                                            <span class="checkbox_title">Согласие на обработку данных</span>
                                        </div>
                                    </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>

                    <!-- Order Info -->

                    <div class="col-lg-6">
                        < class="order checkout_section">
                            <div class="section_title">Ваш заказ</div>
                            <div class="section_subtitle">Детали заказа</div>

                            <!-- Order details -->
                            <div class="order_list_container">
                                <div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
                                    <div class="order_list_title">Товар</div>
                                    <div class="order_list_value ml-auto">Цена</div>
                                </div>
                                <ul class="order_list">

                                    @php
                                        $cartItems = \Cart::session($_COOKIE['cart_id'])->getContent();
                                    @endphp

                                    @foreach($cartItems as $cartItem)

                                        @php
                                            $sumPrice = $cartItem->price * $cartItem->quantity
                                        @endphp
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <div class="order_list_title">
                                                @if ($cartItem->quantity > 1)
                                                    {{ $cartItem->name }} <span style="color: #e95a5a;">* {{ $cartItem->quantity }}</span>
                                                @else
                                                    {{ $cartItem->name }}
                                                @endif
                                            </div>
                                            <div class="order_list_value ml-auto">$ {{ $sumPrice }}</div>
                                        </li>
                                    @endforeach
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="order_list_title" style="font-weight: 700;">Итого</div>
                                        <div class="order_list_value ml-auto" style="font-weight: 700;">$ {{ \Cart::session($_COOKIE['cart_id'])->getTotal() }}</div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Payment Options -->
                            <div class="payment">
                                <div class="payment_options">
                                    <label class="payment_option clearfix">Paypal
                                        <input type="radio" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="payment_option clearfix">Наличными при получении
                                        <input type="radio" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="payment_option clearfix">Банковская карта
                                        <input type="radio" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="payment_option clearfix">Прямой банковский перевод
                                        <input type="radio" checked="checked" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                            <!-- Order Text -->
                            <div class="order_text">Нажимая кнопку "Оформить заказ", вы подтверждаете своё согласие с правилами пользования сайта, с политикой конфиденциальности, а также даёте согласие на обработку персональных данных</div>
                            <input type="submit" id="placeOrder" class="button" style="width: 100%; margin-top: 83px; font-weight: 700; font-size: 12pt;" value="Оформить заказ">
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
@endsection

@section('custom_js')
    <script src="/js/checkout.js"></script>
    <script>
        $(document).ready(function () {
            $('.order_button').click(false);

            $('.order_button').click(function (event) {
                event.preventDefault()
            })
        })

        function checkout() {
            if (!$('#checkout_name')) alert('')
        }
    </script>
@endsection