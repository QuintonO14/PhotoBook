@extends('layouts.app')

@section('content')

    <h1 class="text-center">Get Started Here!</h1>
    <h3 class="text-center">Select your photo, caption it, and done!</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-5 center">
                {!! Form::open(['method'=>'POST', 'id'=>'form', 'runat'=>'server', 'action'=>'PhotoController@store', 'files'=>true]) !!}
                {!! Form::hidden('user_id', Auth::id()) !!}
                {!! Form::button('Choose Image', ['class'=>'btn btn-success chooseImage']) !!}
                {!! Form::file('image', ['id'=>'imgChange','class'=>'imgInput']) !!}
                {!! Html::image('images/default-thumbnail.jpg', 'Image', array('id'=>'image', 'class'=>'previewImage')) !!}
                {!! Form::textarea('caption', null, ['class'=>'form-control caption top', 'placeholder'=>'Write your caption here in 80 characters or less!', 'size'=>'10x3', 'maxlength'=>'80']) !!}
                {!! Form::submit('Upload', ['class'=>'btn btn-primary width']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="photos-container">
            @foreach($photos as $photo)
                <div class="photos">
                    <a href="/img/{{$photo->image}}" data-lightbox="photobook" data-title="{{$photo->caption}}">
                     <img src="/img/{{$photo->image}}" alt="" class="image">
                        <button class="hiddenP">Click to Enlarge</button>
                        <a href="{{ route('photo.delete', $photo->id) }}" class="delete">Delete</a>
                    </a>
                    <p>{{$photo->caption}}</p>
                </div>
            @endforeach
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection