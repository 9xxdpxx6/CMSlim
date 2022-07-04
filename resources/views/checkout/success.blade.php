@extends('layouts.main')

@section('title', 'Готово')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="avds_large mt-5">
            <div class="avds_large_container mt-5">
                <div class="avds_large_content"  style="background: transparent;">
                    <div class="avds_title text-dark">Заказ успешно оформлен</div>
                    <div class="avds_link avds_link_large"><a href="{{ route('home') }}" class="text-dark"  style="text-decoration: underline;">Вернуться на главную</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection