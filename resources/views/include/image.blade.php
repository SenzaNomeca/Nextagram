<div class="card pub_image" style="margin-bottom: 25px">
    <div class="card-header" style="display: flex; align-content: center; align-items: center">
        @if($image->user->image)
            <div class="container-avatar">
                <img class="avatar" style="width: 55px; height: 55px; border-radius: 500px; margin: 17px 4px;" src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" alt="userAvatar">
            </div>
        @else
            <img class="avatar" style="width: 55px; height: 55px; border-radius: 500px; margin: 17px 4px;"  src="{{ asset('img/profile-foto-default.jpg') }}" alt="userAvatar"/>
        @endif
        <div class="data-user" style="font-weight: bold; margin-left: 10px;">
            <a href="{{ route('user.profile', ['id' => $image->user->id]) }}">
                <span class="nick-name date" style="color: gray">
                    {{ $image->user->nick }}
                </span>
            </a>
        </div>
    </div>

    <div class="card-body card-publics">
        <div class="image-container" style=" width: 100%; overflow: hidden; max-height: 100%; align-items: center">
            <a href="{{ route('image.detail', ['id' =>$image->id ]) }}">
                <img class="image-file-user" style="width: 100%; height: 100%; object-fit: contain;" src="{{ route('image.file', ['filename' => $image->imagen_path]) }}" alt="image" />
            </a>
        </div>
        <div class="description">
            <span class="nickname">{{ '@' .$image->user->nick }}</span>
            <span class="nick-name" style="color: gray">
                {{ ' | Publicado '. $image->created_at->diffForHumans() }}
            </span>
            <p>{{ $image->description }}</p>
        </div>

        <div class="buttons-user">
            <!-- Compruebo si el usuario le dio like a la imagen -->
            <?php $user_like = false; ?>
            @foreach($image->likes as $like)
                @if($like->user->id == \Illuminate\Support\Facades\Auth::user()->id)
                        <?php $user_like = true; ?>
                @endif
            @endforeach

            <div class="likes">
                @if($user_like)
                    <img class="icon-heart btn-dislike" data-id="{{ $image->id }}" src="{{ asset('img/heart-red.svg') }}" alt="heart icon" />
                @else
                    <img class="icon-heart btn-like" data-id="{{ $image->id }}" src="{{ asset('img/heart.svg') }}" alt="heart icon" />
                @endif
                <span class="number-likes" data-id="{{ $image->id }}">{{ count($image->likes) }}</span>
            </div>

            <div class="comments">
                <a href="{{ route('image.detail', ['id' =>$image->id ]) }}" class="btn btn-warning btn-coments">Comentarios({{ count($image->comments) }})</a>
            </div>
        </div>
        @if(count($image->comments) > 0)
            <hr>
            @foreach($image->comments as $comment)
                <div class="home-comment">
                    <span class="nickname">{{ '@' .$comment->user->nick }}</span>
                    <span class="times-ago" style="color: gray">
                                        {{ ' | Publicado '. $comment->created_at->diffForHumans() }}
                                    </span>
                    <p class="comment_content">{{ $comment->content }}</p>
                    @if(\Illuminate\Support\Facades\Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                        <a class=" comment_btn btn btn-sm btn-danger" href="{{ route('comment.delete', ['id' => $comment->id]) }}">Eliminar</a>
                    @endif
                </div>
            @endforeach
        @endif


    </div>
</div>
