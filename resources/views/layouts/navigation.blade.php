<nav x-data="{ open: false }" class="shadow-md bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center justify-between">
                <x-nav-link :href="route('dashboard')">
                    {{ __('Задачи') }}
                </x-nav-link>
                <x-nav-link :href="route('dashboard')">
                    {{ __('Статусы') }}
                </x-nav-link>
                <x-nav-link :href="route('dashboard')">
                    {{ __('Метки') }}
                </x-nav-link>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-auth-buttons>
                    <div class="hidden sm:flex sm:items-center sm:ms-6"></div>
                </x-auth-buttons>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->

</nav>
