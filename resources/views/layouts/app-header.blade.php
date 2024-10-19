<header class="bg-purple-700 text-white py-8 relative">
    <div class="container mx-auto px-4">
        <div class="absolute top-4 right-4">
            @if (Auth::user())
                <div class="relative" id="userMenu">
                    <button id="userMenuButton" class="bg-white text-purple-700 px-4 py-2 rounded-lg font-semibold hover:bg-purple-100 transition duration-300 flex items-center">
                        <span class="mr-2">{{ Auth::user()->login }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="userMenuDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden">
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('article.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-900">
                                Добавить статью
                            </a>
                        @endif
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-100 hover:text-purple-900" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Выйти
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('auth') }}" class="bg-white text-purple-700 px-4 py-2 rounded-lg font-semibold hover:bg-purple-100 transition duration-300">Войти</a>
            @endif
        </div>
        <h1 class="text-3xl font-bold text-center mb-6">Ваше название блога</h1>
        <nav class="flex justify-center space-x-8">
            <a href="{{ route('home') }}" class="text-lg pb-2 border-b-2 {{ Route::is('home') ? 'border-white font-semibold' : 'border-transparent' }}">Статьи</a>
            <a href="#" class="text-lg pb-2 border-b-2 border-transparent hover:border-white transition duration-300">Обо мне</a>
        </nav>
        
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userMenu = document.getElementById('userMenu');
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenuDropdown = document.getElementById('userMenuDropdown');
        let isOpen = false;
    
        function showMenu() {
            userMenuDropdown.classList.remove('hidden');
            isOpen = true;
        }
    
        function hideMenu() {
            userMenuDropdown.classList.add('hidden');
            isOpen = false;
        }
    
        userMenuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            if (isOpen) {
                hideMenu();
            } else {
                showMenu();
            }
        });
    
        userMenuButton.addEventListener('mouseenter', showMenu);
        userMenuDropdown.addEventListener('mouseenter', showMenu);
    
        userMenuDropdown.addEventListener('mouseleave', function() {
            hideMenu();
        });
    
        // Закрыть меню при клике вне его
        document.addEventListener('click', function(e) {
            if (!userMenu.contains(e.target)) {
                hideMenu();
            }
        });
    });
    </script>
    