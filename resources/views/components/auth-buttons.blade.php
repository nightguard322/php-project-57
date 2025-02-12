@auth
    <div class="flex items-center lg:order-2">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-action-button :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Выход') }}
            </x-action-button>
        </form>
    </div>
@else
    <div class="flex items-center lg:order-2">
        <x-action-button :href="route('login')">
            Вход
        </x-action-button>
        <x-action-button :href="route('register')">
            Регистрация
        </x-action-button>
    </div>
@endauth