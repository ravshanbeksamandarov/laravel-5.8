@extends('layouts/admin')

@section('content')


<div class="col-md-12">
    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-blod text-primary">
                Yangilik qo'shish
            </h6>
        </div>
        <div class="card-body">
            @include('admin.alerts.main')
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.posts.store') }}">
              @csrf
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">O'zbekcha</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Русский</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">English</a>
                    </li>
              </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="form-group">
                        <label for="">Sarlavha</label>
                        <input value="{{old('title_uz')}}" class="form-control" name="title_uz" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">Qisqacha</label>
                        <input value="{{old('short_uz')}}" class="form-control" name="short_uz" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">Maqola</label>
                        <textarea name="content_uz" id="" class="form-control summernote" cols="30" rows="10"> {{old('content_uz')}}</textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="form-group">
                        <label for="">Название</label>
                        <input value="{{old('title_ru')}}" class="form-control" name="title_ru" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">Короткий</label>
                        <input value="{{old('short_ru')}}" class="form-control" name="short_ru" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">Полный</label>
                        <textarea name="content_ru" id="" class="form-control summernote" cols="30" rows="10">{{old('content_ru')}}</textarea>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input value="{{old('title_en')}}" class="form-control" name="title_en" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">Short description</label>
                        <input value="{{old('short_en')}}" class="form-control" name="short_en" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">Body of article</label>
                        <textarea name="content_en" id="" class="form-control summernote" cols="30" rows="10">{{old('content_en')}}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Turkum</label>
                <select class="form-control" name="id_cat" id="">
                    @foreach ($category_list as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Rasm</label>
                <input class="form-control" name="img" type="file">
            </div>
                <button type="submit" class="btn btn-success">Saqlash</button>
            </form>
        </div>
    </div>
</div>

@endsection

@include('admin.components.editor')
