@extends('Home.Main')
@section('content')
<div class="hero common-hero">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hero-ct">
                    <h1> Danh Sách Phim Sắp Chiếu</h1>
                    <ul class="breadcumb">
                        <li class="active"><a href="#">Home</a></li>
                        <li> <span class="ion-ios-arrow-right"></span> Tận Hưởng niêm vui trong thể giới hoang tưởng</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-single">
    <div class="container">
        <div class="row ipad-width">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="flex-wrap-movielist">
                  
                    @foreach ($phimsapchieu as $item)
                        <div class="movie-item-style-2 movie-item-style-1">
                            <img src="{{ asset('assets/Content/Upload/Image/' .$item->ApPhich) }}" alt="" >
                            <div class="hvr-inner">
                                <a href="{{ route('detailphim',['id'=>$item->idPhim]) }}">Chi Tiết<i class="ion-android-arrow-dropright"></i> </a>
                            </div>
                            <div class="mv-item-infor">
                                <h6><a href="">{{ $item->TenPhim }}</a></h6>
                                <p class="rate"><i class="ion-android-star"></i><span>8.1</span> /10</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="topbar-filter">
                    
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection
