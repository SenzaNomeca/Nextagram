@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="data-user--profile">
                    <div class="container-avatar--profile">
                        @if($user->image)
                            <img class="avatar--profile" src="{{ route('user.avatar', ['filename' => $user->image]) }}" alt="userAvatar">
                        @else
                            <img class="avatar--profile" src="{{ asset('img/profile-foto-default.jpg') }}" alt="userAvatar"/>
                        @endif
                    </div>

                    <div class="user_info--profile">
                        <h1 class="profile_nick">{{ '@' .$user->nick }}</h1>
                        <h2 class="profile_name">{{ $user->name .' ' .$user->surname }}</h2>
                    </div>
                </div>

                @foreach($user->images as $image)
                    @include('include.image', ['image'=>$image])
                @endforeach

            </div>
        </div>
    </div>
@endsection
