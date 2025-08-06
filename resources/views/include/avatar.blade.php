@if(\Illuminate\Support\Facades\Auth::user()->image)
    <img class="avatar" style="width: 155px; height: 155px; border-radius: 500px; margin: 17px 4px;" src="{{ route('user.avatar', ['filename' => Auth::user()->image]) }}" alt="userAvatar">
@endif
