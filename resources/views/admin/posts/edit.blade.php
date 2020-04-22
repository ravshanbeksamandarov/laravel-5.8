@extends('layouts/admin')

@section('content')


<div class="col-md-12">
    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-blod text-primary">
                {{$post->title}}ni o'zgartirish
            </h6>
        </div>
        <div class="card-body">
                @include('admin.alerts.main')
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.posts.update', $post->id) }}">
              @csrf
              @method('PUT')
                <div class="form-group">
                    <label for="">Sarlavha</label>
                <input class="form-control" name="title" type="text" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="">Qategoriya</label>
                    <select class="form-control" name="id_cat" id="">
                        @foreach ($category_list as $item)
                            <option value="{{$item->id}}"
                                @if($item->id == $post->id_cat) selected @endif >
                                {{$item->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Qisqacha</label>
                    <input class="form-control" name="short" type="text" value="{{ $post->short }}">
                </div>
                <div class="form-group">
                    <label for="">Maqola</label>
                    <textarea name="content" class="form-control"  id="" cols="30" rows="10">{{ $post->content }}</textarea>
                </div>
                <div class="form-group">
                    <img src="/storage/{{ $post->thumb }}" width="200px" class="img img-thumbnail" alt="">
                </div>
                <div class="form-group">
                    <label for="">Rasmni tanlang</label><br>
                    <input class="form-control" type="file" name="img" value="{{ $post->img }}">
                </div>
                <br>
                <button type="submit" class="btn btn-success">O'zgartirish</button>
            </form>
        </div>
    </div>
</div>

@endsection
