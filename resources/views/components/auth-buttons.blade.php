@auth
    <div class="flex items-center lg:order-2">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-blue-button :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Выход') }}
            </x-blue-button>
        </form>
    </div>
@else
    <div class="flex items-center lg:order-2">
        <x-blue-button :href="route('login')">
            Вход
        </x-blue-button>
        <x-blue-button :href="route('register')">
            Регистрация
        </x-blue-button>
    </div>
@endauth