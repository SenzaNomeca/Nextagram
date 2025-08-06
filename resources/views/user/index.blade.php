@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1 class="align-items-center">Gente</h1>
                <form id="buscador" method="GET" action="{{ route('user.index') }}" class="mb-4">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <input class="form-control" type="text" id="search"  placeholder="Buscar usuario...">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
                <hr>

                @foreach($users as $user)
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
                            <h2><a href="{{ route('user.profile', ['id' => $user->id] )}}" class="profile_name">{{ $user->name .' ' .$user->surname }}</a></h2>
                        </div>
                    </div>
                @endforeach

                <!-- Paginación -->
                <div class="clearfix"></div>
                {{ $users->links() }}

            </div>
        </div>
    </div>
@endsection
