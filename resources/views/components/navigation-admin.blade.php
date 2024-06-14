<header class="bg-white shadow">
    <div class="flex items-center justify-between p-4 sm:px-6 lg:px-8">
        <div>{{ $slot }}</div>
        <!-- Profile dropdown -->
        <div class="relative ml-3" x-data="{ open: false }">
            <div>
                <button x-on:click="open = true" type="button"
                    class="relative flex text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="" />
                </button>
            </div>
            <div x-show="open" x-on:click.away="open = false"
                class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <!-- Active: "bg-gray-100", Not Active: "" -->
                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                <a href="{{ route('admin.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    role="menuitem" tabindex="-1" id="user-menu-item-0">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1"
                        id="user-menu-item-2">Sign out</a>
                </form>
            </div>
        </div>
    </div>
</header>
