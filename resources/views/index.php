
<div class="bg-gradient-to-r from-gray-50 to-blue-100 min-h-screen">

    <!-- Header -->
    <header class=" bg-gradient-to-r from-blue-700 to-purple-600 text-white py-16 px-4 ">
        <div class="max-w-6xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Ethiopian Tech Internship Hub</h1>
            <p class="text-xl text-blue-100">Discover internships and other tech-related opportunities across Ethiopia
            </p>
            <p class="mt-2 text-sm text-blue-200">New opportunities posted weekly – Last updated: April 28, 2025</p>
        </div>
    </header>

    <!-- Search & Filters -->
    <section class="max-w-6xl mx-auto px-4 -mt-12 mb-8">
        <div class="bg-white rounded-lg shadow-xl p-6 space-y-4">
            <div class="relative">
                <input id="searchInput" onkeyup="filterCompanies()"
               class="w-full p-4 rounded-lg border-2 border-gray-200 focus:border-blue-500 focus:outline-none"
               placeholder="Search companies or technologies…" />
                <i class="fas fa-search absolute right-4 top-5 text-gray-400"></i>
            </div>
            <div class="flex flex-wrap gap-2">
                <button class="filter-btn bg-blue-100 text-blue-800 px-4 py-2 rounded-full" data-filter="all">All</button>
                <!-- <button class="filter-btn bg-green-100 text-green-800 px-4 py-2 rounded-full" data-filter="mern">MERN</button>
                <button class="filter-btn bg-purple-100 text-purple-800 px-4 py-2 rounded-full" data-filter="laravel">Laravel</button>
                <button class="filter-btn bg-orange-100 text-orange-800 px-4 py-2 rounded-full" data-filter="paid">Paid</button>
        -->   </div> 
        </div>
    </section>

    <!-- Companies List -->
    <main class="max-w-6xl mx-auto px-4 py-8">
        <div id="companiesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </main>

    <!-- Submit Opportunity Section -->
    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="bg-white rounded-xl shadow-lg p-8 text-center">
            <h2 class="text-2xl font-bold mb-4">Have an Internship Opportunity?</h2>
            <p class="text-gray-600 mb-6">Help grow Ethiopia's tech community by sharing your openings</p>
           <a href="https://t.me/urdoor"  target="_blank"> <button class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition">
        <i class="fas fa-plus mr-2"></i>Post Opportunity
      </button>
           </a>
            <p class="mt-4 text-sm text-gray-500">Listings are free for educational institutions</p>
            <p class="mt-6 text-sm">
                Join our Telegram community for updates:
                <a href="https://t.me/birukwebx" class="text-blue-600 hover:underline"
                    target="_blank">Here</a>
            </p>
        </div>
    </div>
</div>