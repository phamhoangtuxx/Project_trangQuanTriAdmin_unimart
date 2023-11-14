
@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Đặt hàng
            </div>
            <div class="card-body">
                @foreach($product as $products)
                

                <form action="{{url('admin/product/order',$products->id)}}
                "method="POST"enctype="multipart/form-data">
                @csrf
                <div class="row">
                        <div class="col-12">
                                
                            {{-- <div class="form-group">
                                <label for="name">ID người dùng</label>
                                <input class="form-control" type="text" name="userId" id="userId"value="{{ $userId }}"readonly>
                            </div>

                      
                                    

                            <div class="form-group">
                                <label for="name">Tên người mua hàng</label>
                                <input class="form-control" type="text" name="user_name" id="user_name"value="{{ $username }}" readonly>
                            </div>
                                    

                            <div class="form-group">
                                <label for="name">Số điện thoại</label>
                                <input class="form-control" type="number" name="phone" id="phone"value="{{ $userPhone }}" readonly>
                            </div>      --}}
                           


                            <div class="form-group">
                                <label for="name"      >
                                    Tên sản phẩm</label>
                                    
                                <input class="form-control" type="text" name="name" id="name"value="{{ $products->name }}" readonly>
                            </div>


                            <div class="form-group">
                                <label for="name">Sổ lượng</label>
                                <input class="form-control" type="text" name="quantity" id="quantity"value="{{ $products->quantity }}" readonly>
                            </div>


                            <div class="form-group">
                                <label for="name">Giá sản phẩm</label>
                                <input class="form-control" type="text" name="price" id="price"value="{{ $products->price }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Trạng thái</label>
                                <input class="form-control" type="text" name="status" id="status">
                            </div>

                            @endforeach

    
                        </div>
                    </div>
    
                        <button  type="submit" class="btn btn-primary"name="btn-add_product"value="thêm sản phẩm">Đặt hàng</button>
                    
                </form>
            </div>
        </div>
    </div>
    
                              
@endsection