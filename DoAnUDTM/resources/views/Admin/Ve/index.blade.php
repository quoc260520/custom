@extends('Admin.Home.index')
@section('content')
    <style type="text/css">
        .ghe {
            min-width: 100px;
        }
    </style>
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-12 p-md-0">
                    <div class="welcome-text">
                        <center>
                            <h4> Trang Thêm Vé</h4>
                        </center>

                    </div>
                </div>

            </div>
            <div class="errorMessage">
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-validation">
                                <form id="create-ve-form" method="POST" action="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-9">
                                        <label class="col-md-6" for="idPhim">Chọn Phim</label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="idPhim" name="idPhim">
                                                <option value="">---Chọn Phim---</option>
                                                @foreach ($phim as $item)
                                                    <option value="{{ $item->idPhim }}">{{ $item->TenPhim }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group col-9">
                                        <label class="col-md-3" for="idPhong">Chọn Phòng</label>
                                        <div class="col-md-10">
                                            <select class="form-control" id="idPhong" name="idPhong">
                                                <option value="">---Chọn Phòng---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex flex-md-row flex-col col-12">
                                        <div class="form-group col-6 p-0">
                                            <label class="col-md-6" for="ngayChieu">Chọn Ngày</label>
                                            <div class="col-md-10">
                                                <select class="form-control" id="ngayChieu" name="ngayChieu">
                                                    @for ($i = 0; $i < 8; $i++)
                                                        <option value="{{ now()->addDays($i)->format('Y-m-d') }}">
                                                            {{ now()->addDays($i)->format('Y-m-d') }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-6 p-0">
                                            <label class="col-md-6" for="idLichChieu">Chọn Khung Giờ</label>
                                            <div class="col-md-10">
                                                <select class="form-control" id="idLichChieu" name="idLichChieu">
                                                    <option value="">---Chọn Khung Giờ---</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group col-12 p-4">
                                        <label for="">Chọn Ghế</label>
                                        {{-- chỗ này là xuất ghế --}}
                                        <div class="col-md-8 form-it" id="danhsachghe"></div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="">Ghế Đã Chọn</label>
                                        <div class="font-weight-bold text-dark">Ghế : <span id="thongtinve"></span></div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label class="col-md-6 p-0" for="thucAn">Đồ Ăn</label>
                                        <div class="d-flex flex-row p-0">
                                            <select class="form-control col-8" id="thucAn" name="thucAn">
                                                <option value="">---Chọn Đồ Ăn---</option>
                                                @foreach ($thucAn as $item)
                                                    <option value="{{ $item->MATHUCAN }}">{{ $item->TENTHUCAN }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-primary ml-4"
                                                onclick="addThucAn()">Thêm</button>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between p-0 col-8">
                                            <table class="table text-dark">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">Tên món</th>
                                                        <th scope="col">Giá</th>
                                                        <th scope="col">Số lượng</th>
                                                        <th scope="col">Xóa</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="bodyTable">
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="col-12 bg-light p-2">
                                        <div class="col-12 row">
                                            <div class="col-10"><label>Tổng tiền</label></div>
                                            <div class="col-2"><label id="tongTien"></label></div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4 mr-4">
                                            <button type="submit" class="btn btn-primary">Tạo hóa đơn</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const doAn = {!! json_encode($thucAn) !!};
    </script>
    <script src="{{ asset('assets/js/adminVe.js') }}"></script>
@endsection
