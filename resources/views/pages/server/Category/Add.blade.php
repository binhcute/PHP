@extends('layout_admin')
@section('title','Danh Mục')
@section('content')
<div class="col-sm-12">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <a class="btn btn-primary" href="{{route('LoaiSanPham.index')}}"><i class="fa fa-angle-double-left"></i>  Quay Lại</a>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}"> <i data-feather="home"></i></a></li>
          <li class="breadcrumb-item">Danh Mục</li>
          <li class="breadcrumb-item active">Thêm</li>
        </ol>
      </div>
    </div>
  </div>
<div class="card">
  <div class="card-header">
    <h5>Thêm Danh Mục</h5>
  </div>
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
  </div>
  <img src="images/{{ Session::get('image') }}">
  @endif

  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> Có một vài lỗi trong quá trình nhập liệu.
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form class="form theme-form" action="{{ route('LoaiSanPham.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col">
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label pt-0">Người Nhập Hiện Tại</label>
            <div class="col-sm-9">
              <div class="form-control-static">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</div>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Tên Loại Sản Phẩm</label>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="Nhập tên loại sản phẩm" name="name">
            </div>
          </div>
          <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Mô Tả</label>
            <div class="col-sm-9">
              <textarea class="form-control" id="ckeditor1" rows="5" cols="5" placeholder="Nội dung mô tả..." name="description"></textarea>
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Trạng Thái</label>
            <div class="col-sm-9">
            <select class="form-select" name="status" required="" aria-label="select example">
              <option value="">Open this select menu</option>
              <option value="1">Hiển Thị</option>
              <option value="0">Ẩn</option>
            </select>
            </div>  
          </div>
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Chọn ảnh</label>
            <div class="col-sm-9">
              <input class="form-control" type="file" name="img" data-bs-original-title="" title="">
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="card-footer text-end">
      <div class="col-sm-9 offset-sm-3">
        <button class="btn btn-primary" type="submit">Submit</button>
        <input class="btn btn-light" type="reset" value="Cancel">
      </div>
    </div>
  </form>
</div>
</div>
@endsection