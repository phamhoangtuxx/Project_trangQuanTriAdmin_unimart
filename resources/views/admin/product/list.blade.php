@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <div class="d-flex">
                        <input type="text"name="keyword"value="{{request()->input('keyword')}}" class="form-control form-search" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">                                
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            @if (\Session::has('message'))
            <div class="alert alert-success">
                {!! \Session::get('message') !!}
            </div>
            @else
                    {!! \Session::get('not_delete_admin') !!}            
        @endif
        <form action="#"method="">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'Stocking'])}}" 
                    class="text-primary">Sản phẩm có sẵn<span class="text-muted"name="active_paginate">({{$active}})</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status'=>'deleted'])}}"name="deletedat_paginate" 
                        class="text-primary">Sản phẩm trong kho<span class="text-muted">({{$totalScore}})</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1 col-3" id="" name="select_status">
                    @foreach ($options as $key => $option )
                    <option value="{{$option}}">{{$option}}</option>
                    @endforeach
                </select>
                <input type="submit" name="btn-status" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">Stt</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0
                    @endphp
                    @foreach ($product as $products )
                    
                    @php
                    $i++
                @endphp
                        
                    <tr>
                        <td>
                            
                            <input type="checkbox"name="check_box[]"value={{ (int)$products->id }}>   
                        </td>
                        <td>{{$i}}</td>
                        <td><img src={{asset("uploads_image_product/$products->thumbnail")}} alt=""width="50"height="50"></td>

                         <td class="col-3">
                            <a href="#">{{$products->name}}</a>
                        </td>
                         <td class="col-1">
                            {{number_format($products->price)}}VNĐ
                        </td>
                         {{-- <td>{{$products->quantity}}</td> --}}
                        
                         <td class="col-2">
                           <div class="quantity d-flex">
                            <form>
                            
                            </form>
                                <form action="{{ route('decrease') }}" method="POST">
                                    
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                                   <button type="submit">-</button>
                                  </form>      
                                 {{ $products->quantity }}
                              <form action="{{ route('increase') }}" method="POST">
                                  @csrf
                                  <input type="hidden" name="product_id" value="{{ $products->id }}">
                                  <button type="submit">+</button>
                              </form>
                          
                              
                        </div> 
                    </td>
                      
                    
                         <td class="col-3">{{$products->categories}}</td>
                         <td class="col-2">{{ $products->created_at }}</td>
                        <td class="col-3"><span class="badge badge-warning">{{$products->status}}</span></td>

                     
                        <td class="col-5 ">
                            <a style="width:40px;margin-bottom:3px" href="{{route('product.edit',$products->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a style="width:40px;margin-bottom:3px" href="{{route('product.delete',$products->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>


                            <a href="{{route('product.byProduct',$products->id)}}" style="width:40px" class="btn btn-primary btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Order"><i class="fa fa-shopping-cart" aria-hidden="true"></i>


                                
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $product->appends(request()->all())->links() }}

        </form>
         
          
        </div>
    </div>
</div>

@endsection