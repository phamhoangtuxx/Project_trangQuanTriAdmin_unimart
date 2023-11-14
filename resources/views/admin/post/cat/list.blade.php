@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <form>

        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                            Danh mục sản phẩm
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input class="form-control" type="text" name="category_name" id="name">
                            </div>
                           
                            {{-- <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Lưu danh mục
                                    </label>
                                </div>
                                {{-- <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Công khai
                                    </label>
                                </div> --}}
                            {{-- </div> --}}    
    
    
    
                            <input type="submit" name="btn-status" value="Thêm danh mục" class="btn btn-primary">
                        </div>
                </div>
            </div>

            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách sản phẩm 
                    </div>
                    <div class="card-body">
                            <table class="table table-striped table-checkall">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <input name="checkall" type="checkbox">
                                        </th>
                                        <th scope="col">Stt</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col">Nội dung</th>
                                        <th scope="col">Danh mục</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0
                                    @endphp
                                    @foreach ($post as $posts )
                                    @php
                                    $i++
                                @endphp
                                        
                                    <tr>
                                        <td>
                                            
                                            <input type="checkbox"name="check_box[]"value={{$posts->id }}>   
                                        </td>
                                        <td>{{$i}}</td>
                                        <td><img src={{asset("uploads_image_product/$posts->thumbnail")}} alt=""width="80"height="80"></td>                       
                                         <td class="col-2"><a href="#">{{$posts->title}}</a></td>
                                         <td>{{$posts->content}}</td>
                                         <td>{{$posts->categories}}</td>
                                      
                                    </tr>
                                    @endforeach
                
                                   
                                </tbody>
                            </table>
                      
                    </div>
                </div>
            </div>
        </div>
</form>
</div>

@endsection