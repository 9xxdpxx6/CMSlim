@extends('layouts.main')

@section('title', $category->title)

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/categories.css">
    <link rel="stylesheet" type="text/css" href="/styles/Categories_responsive.css">
@endsection

@section('content')
	<div class="home">
		<div class="home_container">
			<div class="home_background" style="background-image:url('/images/{{ $category->img }}')"></div>
			<div class="home_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content">
								<div class="home_title">{{ $category->title }}<span>.</span></div>
								<div class="home_text"><p>{{ $category->description }}</p></div>
							</div>
						</div>
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
					
					<!-- Product Sorting -->
					<div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
						<div class="results">Найдено: <span>{{ $category->products->count() }}</span></div>
						<div class="sorting_container ml-md-auto">
							<div class="sorting">
								<ul class="item_sorting">
									<li>
										<span class="sorting_text">Упорядочить</span>
										<i class="fa fa-chevron-down" aria-hidden="true"></i>
										<ul>
											<li class="product_sorting_btn" data-order="default"><span>По умолчанию</span></li>
											<li class="product_sorting_btn" data-order="price-low-high"><span>Сначала дешёвые</span></li>
											<li class="product_sorting_btn" data-order="price-high-low"><span>Сначала дорогие</span></li>
											<li class="product_sorting_btn" data-order="name-a-z"><span>По алфавиту: А-Я</span></li>
											<li class="product_sorting_btn" data-order="name-z-a"><span>По алфавиту Я-А</span></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
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
								<div class="product_image"><img src="/images/{{ $image }}" alt="{{ $product->title }}"></div>
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
                    {{ $products->appends(request()->query())->links('pagination.index') }}						
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
						<div class="icon_box_image"><img src="/images/icon_1.svg" alt=""></div>
						<div class="icon_box_title">Бесплатная доставка по России</div>
						<div class="icon_box_text">
							<p>При заказе на сумму от 10 000 рублей доставка бесплатно в любую точку России</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="/images/icon_2.svg" alt=""></div>
						<div class="icon_box_title">Бесплатный возврат</div>
						<div class="icon_box_text">
							<p>Бесплатный возврат неподошедшего товара в магазин в течении двух недель после покупки</p>
						</div>
					</div>
				</div>

				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="/images/icon_3.svg" alt=""></div>
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

@section('custom_js')
    <script src="/js/categories.js"></script>
    <script>
       $(document).ready(function () {
            $('.product_sorting_btn').click(function () {
                let orderBy = $(this).data('order')
                $('.sorting_text').text($(this).find('span').text())
                $.ajax({
                    url: "{{ route('showCategory',$category->alias) }}",
                    type: "GET",
                    data: {
                        orderBy: orderBy,
                        page: {{isset($_GET['page']) ? $_GET['page'] : 1}},
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        let positionParameters = location.pathname.indexOf('?');
                        let url = location.pathname.substring(positionParameters,location.pathname.length);
                        let newURL = url + '?';
                        // newURL += 'oderBy=' + orderBy + "&page={{isset($_GET['page']) ? $_GET['page'] : 1}}";
                        newURL += "page={{isset($_GET['page']) ? $_GET['page'] : 1}}"+';orderBy=' + orderBy;
                        history.pushState({}, '', newURL);
                        $('.product_pagination a').each(function(index, value){
                            let link= $(this).attr('href')
                            $(this).attr('href',link+'&orderBy='+orderBy)
                        })
                        $('.product_grid').html(data)
                        $('.product_grid').isotope('destroy')
                        $('.product_grid').imagesLoaded( function() {
                            let grid = $('.product_grid').isotope({
                                itemSelector: '.product',
                                layoutMode: 'fitRows',
                                fitRows:
                                    {
                                        gutter: 30
                                    }
                            });
                        });
                    }
                });
            })
        })
    </script>
@endsection