@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('include.message')
                    <div class="card pub_image pub_image-detail" style="margin-bottom: 25px">
                        <div class="card-header" style="display: flex; align-content: center; align-items: center">
                            <div class="container-avatar">
                                @if($image->user->image)
                                    <img class="avatar" style="width: 55px; height: 55px; border-radius: 500px; margin: 17px 4px;" src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" alt="userAvatar">
                                @else
                                    <img class="avatar" style="width: 55px; height: 55px; border-radius: 500px; margin: 17px 4px;" src="{{ asset('img/profile-foto-default.jpg') }}" alt="userAvatar">

                                @endif
                            </div>

                            <div class="data-user" style="font-weight: bold; margin-left: 10px;">
                                <span class="nick-name" style="color: gray">{{ $image->user->nick }}</span>
                            </div>
                        </div>

                            <div class="card-body card-publics">
                                <div class="image-container image-detail" style=" width: 100%; overflow: hidden; max-height: 100%; align-items: center">
                                    <img class="image-file-user" style="width: 100%; height: 100%; object-fit: contain;" src="{{ route('image.file', ['filename' => $image->imagen_path]) }}" alt="image" />
                                </div>
                                <div class="description">
                                    <span class="nickname">{{ '@' .$image->user->nick }}</span>
                                    <span class="nick-name" style="color: gray">
                                        {{ ' | Publicado '. $image->created_at->diffForHumans() }}
                                    </span>
                                    <p>{{ $image->description }}</p>
                                </div>

                                <div class="container">
                                    <!-- Compruebo si el usuario le dio like a la imagen -->
                                    <?php $user_like = false; ?>
                                    @foreach($image->likes as $like)
                                        @if($like->user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                                <?php $user_like = true; ?>
                                        @endif
                                    @endforeach

                                    <div class="likes">
                                        @if($user_like)
                                            <img class="icon-heart icon-heart--detail btn-dislike" data-id="{{ $image->id }}" src="{{ asset('img/heart-red.svg') }}" alt="heart icon" />
                                        @else
                                            <img class="icon-heart icon-heart--detail btn-like" data-id="{{ $image->id }}" src="{{ asset('img/heart.svg') }}" alt="heart icon" />
                                        @endif
                                        <span class="number-likes" data-id="{{ $image->id }}">{{ count($image->likes) }}</span>
                                            @if(\Illuminate\Support\Facades\Auth::user() && Auth::user()->id == $image->user_id)
                                                <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>
                                                <!--<a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-sm btn-danger">Borrar</a>-->

                                                <!-- Button to Open the Modal -->
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
                                                    Eliminar
                                                </button>

                                                <!-- The Modal -->
                                                <div class="modal" id="myModal">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Espera un momento</h4>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                Si eliminas esta imagen no podras recuperarla, estas seguro de hacer esta acion?
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-sm btn-danger">Eliminar publicacion</a>
                                                                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Cancelar</button>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                    </div>



                                    <div class="comments-detail">
                                        <h2>Comentarios ({{ count($image->comments) }})</h2>
                                        <hr>
                                        <form method="POST" action="{{ route('comment.save') }}">
                                            @csrf

                                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                                            <p>
                                                <textarea class="form-control" name="content" required></textarea>
                                                @error('content')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('content') }}</strong>
                                                </span>
                                                @enderror
                                            </p>

                                            <button class="btn btn-success" type="submit">Enviar</button>
                                        </form>

                                        @foreach($image->comments as $comment)
                                            <hr>
                                            <div class="comment">
                                                <span class="nickname">{{ '@' .$comment->user->nick }}</span>
                                                <span class="times-ago" style="color: gray">
                                                    {{ ' | Publicado '. $comment->created_at->diffForHumans() }}
                                                </span>
                                                <p class="comment_content">{{ $comment->content }}</p>
                                                @if(\Illuminate\Support\Facades\Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                                    <a class="comment_btn btn btn-sm btn-danger" href="{{ route('comment.delete', ['id' => $comment->id]) }}">Eliminar</a>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
