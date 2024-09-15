<x-layout>
    <div>
        Вход выполнен {{ $user->email }}
    </div>

    <div>
        <a href="{{ route('user.logout') }}">Выйти</a>
    </div>
</x-layout>


