<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Left Section: Logo + App Name -->
            <div class="flex items-center space-x-2">
                <!-- Fire Icon -->
                <svg class="w-7 h-7 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C10.2 5 6 8 6 13c0 4 3.1 7 7 7s7-3 7-7c0-4-3-7-5-9.5C13.5 1.2 12 2 12 2z"/>
                </svg>

                <!-- App Name -->
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 hover:text-red-600 transition">
                    FireLedger Pro
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex space-x-8">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-nav-link>
                <x-nav-link href="{{ route('projects.index') }}" :active="request()->routeIs('projects.index')">
                    Projects
                </x-nav-link>
                <x-nav-link href="{{ route('entries.create') }}" :active="request()->routeIs('entries.create')">
                    Add Entry
                </x-nav-link>
                <x-nav-link href="{{ route('entries.index') }}" :active="request()->routeIs('entries.index')">
                    Track Entries
                </x-nav-link>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex items-center space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm focus:outline-none">
                            <img class="w-9 h-9 rounded-full object-cover border" 
                                 src="{{ Auth::user()->profile_photo_url }}" 
                                 alt="{{ Auth::user()->name }}">
                            <span class="ml-2 text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 ml-1 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profile.show') }}">
                            Profile
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                @click.prevent="$root.submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'block': ! open}" class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'block': open, 'hidden': ! open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('projects.index') }}" :active="request()->routeIs('projects.index')">Projects</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('entries.create') }}" :active="request()->routeIs('entries.create')">Add Entry</x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('entries.index') }}" :active="request()->routeIs('entries.index')">Track Entries</x-responsive-nav-link>
        </div>
        <div class="border-t border-gray-200 pt-4 pb-2 px-4">
            <div class="flex items-center">
                <img class="w-10 h-10 rounded-full object-cover border" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}">Profile</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">Log Out</x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
