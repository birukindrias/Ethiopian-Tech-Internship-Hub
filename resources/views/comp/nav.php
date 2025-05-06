<nav class="bg-green dark:bg-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                <img class="h-10" src="/assets/ico.png" alt="" srcset=""> 
                <a href="/" class="text-xl font-bold text-primary-600 dark:text-primary-400">
                Gigavel
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/docs" class="text-gray-500 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Documentation</a>
                    <a href="/examples" class="text-gray-500 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Examples</a>
                    <button @click="darkMode = !darkMode" class="p-2 rounded-full focus:outline-none">
                        <svg x-show="!darkMode" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="darkMode" class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
