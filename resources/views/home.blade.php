<x-layout>
    <div style="display: flex; flex-direction:column; align-items:center;">
        <div>
            <a href="{{ route('user.logout') }}">Выйти</a>
        </div>

        <div>email: {{ $user->email }}</div>
        <div>name: {{ $user->name }}</div>
        <div> Картинка пользователя</div>
        <img style="margin: 8px;" src="{{ $user->avatar ? asset($user->avatar) : asset('images/default.svg') }}" alt="Картинка пользователя не найдена" width="150">
    </div>

    <form action="{{ route('user.avatar.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form">
            <input type="file" name="avatar" id="avatar">
            <button type="submit">Upload</button>
        </div>
    </form>
</x-layout>


