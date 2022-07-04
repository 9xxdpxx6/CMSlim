@extends('layouts.main')

@section('title', 'Главная')

@section('content')
	<div class="home">
		<div class="home_slider_container">
			
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme home_slider">
				
				<!-- Slider Item -->
				<div class="owl-item home_slider_item">
					<div class="home_slider_background" style="background-image:url(images/slide1.jpg)"></div>
					<div class="home_slider_content_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
										<div class="home_slider_title">Творите свободно</div>
										<div class="home_slider_subtitle">Творите свободно со светосильным объективом NIKKOR Z 28-75mm f/2.8. Уже в продаже</div>
										<div class="button button_light home_button"><a href="{{ route('showProduct', ['category', $products->where('alias', 'nikkor_z_28_76mm')->first()->alias]) }}">Купить сейчас</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slider Item -->
				<div class="owl-item home_slider_item">
					<div class="home_slider_background" style="background-image:url(images/slide2.jpg)"></div>
					<div class="home_slider_content_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
										<div class="home_slider_title">Фитнес-браслет Mi Smart Band 6</div>
										<div class="home_slider_subtitle">На шаг впереди. Бренд №1 среди фитнес-браслетов в мире</div>
										<div class="button button_light home_button"><a href="{{ route('showProduct', ['category', $products->where('alias', 'mi_smart_band_6')->first()->alias]) }}">Купить сейчас</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Slider Item -->
				<div class="owl-item home_slider_item">
					<div class="home_slider_background" style="background-image:url(images/slide3.jpg)"></div>
					<div class="home_slider_content_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
										<div class="home_slider_title">iPhone 13</div>
										<div class="home_slider_subtitle">Просто. Нереально</div>
										<div class="button button_light home_button"><a href="{{ route('showProduct', ['category', $products->where('alias', 'iphone_13')->first()->alias]) }}">Купить сейчас</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<!-- Home Slider Dots -->
			
			<div class="home_slider_dots_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_slider_dots">
								<ul id="home_slider_custom_dots" class="home_slider_custom_dots">
									<li class="home_slider_custom_dot active">01</li>
									<li class="home_slider_custom_dot">02</li>
									<li class="home_slider_custom_dot">03</li>
								</ul>
							</div>
						</div>
					</div>
				</div>	
			</div>

		</div>
	</div>

	<!-- Ads -->

	<div class="avds">
		<div class="avds_container d-flex flex-lg-row flex-column align-items-start justify-content-between">
			<div class="avds_small">
				<div class="avds_background" style="background-image:url(images/avds_small.jpg)"></div>
				<div class="avds_small_inner">
					<div class="avds_discount_container">
						<img src="images/discount.png" alt="">
						<div>
							<div class="avds_discount">
								<div>20<span>%</span></div>
								<div>Скидки</div>
							</div>
						</div>
					</div>
					<div class="avds_small_content">
						<div class="avds_title">Смартфоны</div>
						<div class="avds_link"><a href="{{ route('showCategory', $categories->where('alias', 'phones')->first()->alias) }}">Перейти</a></div>
					</div>
				</div>
			</div>
			<div class="avds_large">
				<div class="avds_background" style="background-image:url(images/avds_large.jpg)"></div>
				<div class="avds_large_container">
					<div class="avds_large_content">
						<div class="avds_title">Профессиональные фотоаппараты</div>
						<div class="avds_text">При покупке профессиональной техники у дилеров со статусом «Профессиональный дилер Nikon», вы получаете 1 год гарантии и 3 года сервисного обслуживания</div>
						<div class="avds_link avds_link_large"><a href="{{ route('showCategory', $categories->where('alias', 'cameras')->first()->alias) }}">Перейти</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Products -->

	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="product_grid">

						@foreach ($products as $product)
							<!-- Product -->
							@php
								$image = '';
								if (count($product->images) > 0) {
									$image = $product->images[0]['img'];
								} else {
									$image = 'no_image.png';
								}
							@endphp
							<div class="product">
								<div class="product_image"><img src="images/{{ $image }}" alt="{{ $product->title }}"></div>
								<div class="product_extra product_new"><a href="{{ route('showCategory', $product->category->alias) }}">{{ $product->category->title }}</a></div>
								<div class="product_content">
									<div class="product_title"><a href="{{ route('showProduct', ['category', $product->alias]) }}">{{ $product->title }}</a></div>
									@if ($product->new_price != null)
										<div style="text-decoration: line-through;">$ {{ $product->price }}</div>
										<div class="product_price">$ {{ $product->new_price }}</div>
									@else	
										<div class="product_price">$ {{ $product->price }}</div>
									@endif
								</div>
							</div>
						@endforeach
					</div>
						
				</div>
			</div>
		</div>
	</div>

	<!-- Ad -->

	<div class="avds_xl">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="avds_xl_container clearfix">
						<div class="avds_xl_background" style="background-image:url(images/avds_xl.jpg)"></div>
						<div class="avds_xl_content">
							<div class="avds_title">Новые технологии</div>
							<div class="avds_text">Захватывающие технологии будущего доступны уже сейчас!</div>
							<div class="avds_link avds_xl_link"><a href="{{ route('showCategory', $categories->where('alias', 'smart_watch')->first()->alias) }}">Перейти</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Icon Boxes -->

	<div class="icon_boxes">
		<div class="container">
			<div class="row icon_box_row">
				
				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
						<div class="icon_box_title">Бесплатная доставка по России</div>
						<div class="icon_box_text">
							<p>При заказе на сумму от 10 000 рублей доставка бесплатно в любую точку России</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
						<div class="icon_box_title">Бесплатный возврат</div>
						<div class="icon_box_text">
							<p>Бесплатный возврат неподошедшего товара в магазин в течении двух недель после покупки</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
						<div class="icon_box_title">24 часа Быстрая поддержка</div>
						<div class="icon_box_text">
							<p>Круглосуточная техническая поддержка по телефону или электронной почте</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection