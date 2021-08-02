@extends('layout_admin')
@section('title','Bình Luận')
@section('content')
<div class="col-sm-12">
  <div class="page-title">
    <div class="row">
      <div class="col-6">
        <h5>Danh Sách Bình Luận</h5>
      </div>
      <div class="col-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}"> <i data-feather="home"></i></a></li>
          <li class="breadcrumb-item">Danh Mục</li>
          <li class="breadcrumb-item active">Danh Sách</li>
        </ol>
      </div>
    </div>
  </div>
  @if ($message = Session::get('message'))
  <div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
    <?php
    Session::put('message', null);
    ?>
  </div>
  @endif
  @if ($destroy = Session::get('destroy'))
  <div class="alert alert-danger alert-block">
    <strong>{{ $destroy }}</strong>
    <?php
    Session::put('destroy', null);
    ?>
  </div>
  @endif
  @if ($info = Session::get('info'))
  <div class="alert alert-primary alert-block">
    <strong>{{ $info }}</strong>
    <?php
    Session::put('info', null);
    ?>
  </div>
  @endif
  <div class="card">
    @if(count($cmt)!= 0)
    <div class="card-body">
      <div class="table-responsive">
        <table class="display" id="basic-1">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tên</th>
              <th scope="col">Hình Ảnh</th>
              <th scope="col">Nội Dung</th>
              <th scope="col">Trạng Thái</th>
              <th scope="col">Tác Vụ</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cmt as $item)
            <tr>
              <th scope="row">{{ $item->comment_id }}</th>
              <td>{{ $item->firstName}} {{ $item->lastName}}</td>
              <td>
                @if($item->role == 1)
                Sản Phẩm Số {{$item->product_id}}
                @else
                Bài Viết Số {{$item->article_id}}
                @endif
              </td>
              <td class="flex-column align-items-center justify-content-around">
                @if($item->role == 1)
                <p>{{$item->rate}}</p>
                <p>{!!$item->comment_description!!}</p>
                @else
                <p>{!!$item->comment_description!!}</p>
                @endif
              </td>
              <td>
                @if($item->status==1)
                  <p>Đang hiển thị</p>
                @else
                  <p>Đang ẩn</p>
                @endif
              </td>
              <td class="d-flex align-items-center justify-content-around">
                <form action="{{route('BinhLuan.show',$item->comment_id)}}" method="get">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="_method" value="put" />
                  <button class="btn btn-outline-light" type="submit"><i class="icofont icofont-paper" style="font-size:20px;color:green"></i></i></button>
                </form>
                @if ($item->status == 1)
                <form method="post" action="{{URL::to('/BinhLuan/disabled/'.$item->comment_id)}}">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="_method" value="put" />
                  <button class="btn btn-outline-light" type="submit"><i class="icofont-ui-check" style="font-size:20px;color:cornflowerblue" onclick="return confirm('Bạn muốn ẩn bình luận này đi ?')"></i></button>
                </form>
                @else
                <form method="post" action="{{URL::to('/BinhLuan/enabled/'.$item->comment_id)}}">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="_method" value="put" />
                  <button class="btn btn-outline-light" type="submit"><i class="icofont icofont-ui-close" style="font-size:20px;color:red" onclick="return confirm('Bình luận đã bị ẩn, bạn muốn kích hoạt lại ?')" ></i></button>
                </form>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tên</th>
              <th scope="col">Hình Ảnh</th>
              <th scope="col">Nội Dung</th>
              <th scope="col">Trạng Thái</th>
              <th scope="col">Tác Vụ</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  @else
  <strong class="text-center">Danh Sách Trống</strong>
  @endif
</div>
</div>
@endsection