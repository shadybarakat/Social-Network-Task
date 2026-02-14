<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                        {{ __('Homepage') }}
                    </x-nav-link>
                    <x-nav-link :href="route('posts.myPosts')" :active="request()->routeIs('posts.myPosts')">
                        {{ __('My Posts') }}
                    </x-nav-link>
                    <x-nav-link :href="route('connections.requests')" :active="request()->routeIs('connections.requests')">
                        {{ __('Friend Requests') }}
                    </x-nav-link>
                </div>
            </div>
            <div class="flex flex-row items-center">
                <!-- Notifications Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="ms-1">
                                    <svg class="w-[25px] h-[25px] ms-1" fill="#000000" width="256px" height="256px"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M10,20h4a2,2,0,0,1-4,0Zm8-4V10a6,6,0,0,0-5-5.91V3a1,1,0,0,0-2,0V4.09A6,6,0,0,0,6,10v6L4,18H20Z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div id="notifications-dropdown">
                                @if (count(auth()->user()->notifications))
                                    @foreach (auth()->user()->notifications as $notification)
                                        <x-dropdown-link href=" {{ $notification->data['url'] }}">
                                            <p><strong>{{ $notification->data['message'] }}</strong></p>
                                            <small
                                                class="badge badge-pill badge-light text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </x-dropdown-link>
                                    @endforeach
                                @else
                                    <x-dropdown-link>
                                        <p>No Notifications Yet</p>
                                    </x-dropdown-link>
                                @endif
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
                <!-- Search -->
                <div class="sm:items-center sm:ms-6">
                    <form method="get" action="{{ route('users.search') }}">
                        @csrf
                        <div class="flex flex-row gap-3 items-center">
                            <x-text-input id="q" name="q" type="text" placeholder="Search Users"
                                class="mt-1 block w-full" :value="old('q')" required />
                            <x-input-error :messages="$errors->get('q')" />
                            <div class="hidden">
                                <x-primary-button>{{ __('Search') }}</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

                                <img src="{{ Auth::user()->avatar }}" class="w-8 h-8 rounded-full object-cover"
                                    alt="Avatar" />

                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('users.profile', auth()->user())">
                                {{ __('view Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Edit Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('connections.friends')">
                                {{ __('My Friends') }}
                            </x-dropdown-link>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('homepage')" :active="request()->routeIs('homepage')">
                {{ __('Homepage') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('posts.myPosts')" :active="request()->routeIs('posts.myPosts')">
                {{ __('My Posts') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('connections.requests')" :active="request()->routeIs('connections.requests')">
                {{ __('Friend Requests') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('users.profile', auth()->user())">
                    {{ __('view Profile') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Edit Profile') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('connections.friends')">
                    {{ __('My Friends') }}
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
