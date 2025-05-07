
<div class="bg-gradient-to-r from-gray-50 to-blue-100 min-h-screen">
<?php
    // Dump it in browser for PHP debug (optional)
    // var_dump($internships);

    // Safely convert PHP array to JavaScript
    echo '<script>';
    echo 'const companies = ' . json_encode($internships, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) . ';';
    echo '</script>';
    ?>
    
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

<script>
         const iconMap = {
"node.js": "fab fa-node-js text-green-500 animate-pulse",

"mern": "fab fa-node-js text-green-500 animate-pulse",
"react": "fab fa-react text-cyan-500 animate-spin",
"javascript": "fab fa-js text-yellow-500 animate-bounce",
"flutter": "fas fa-mobile-screen-button text-blue-400 animate-pulse",
"php": "fab fa-php text-purple-500 animate-pulse",
"laravel": "fab fa-laravel text-red-600 animate-bounce",
"python": "fab fa-python text-yellow-500 animate-pulse",
"django": "fas fa-seedling text-green-600 animate-bounce",
"wordpress": "fab fa-wordpress text-blue-800 animate-pulse",
"docker": "fab fa-docker text-blue-600 animate-bounce",
"aws": "fab fa-aws text-orange-500 animate-pulse",
"next.js": "fas fa-bolt text-gray-800 animate-pulse",
"typescript": "fas fa-code text-blue-700 animate-bounce",
"default": "fas fa-briefcase text-gray-600"
};

    function getIconClass(stack) {
      return iconMap[stack.toLowerCase()] || iconMap.default;
    }      console.log(companies);
        
async function loadCompanies() {
    const response = await fetch('get_internships.php?action=read');
    companies = await response.json();
    console.log(companies); // Now companies[] has the full data!
    renderCompanies(companies); // <<< call render here after data is ready
}


function renderCompanies(list) {
    const container = document.getElementById("companiesContainer");
    container.innerHTML = "";
    list.forEach(c => {

        // get the first item from the array Array(3) [ '["JavaScript"', '"PHP"', '"Laravel"]' ]
         
    // console.log( c.techStack);
    
    const techStackArray = JSON.parse(c.techStack); // Parse the JSON string to an array
    const primary = techStackArray[0] || "";
            const iconClass = getIconClass(primary);
        const card = document.createElement("div");
        card.className = `company-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition`;
       
        card.dataset.categories = primary.toLowerCase();
       console.log(card.dataset.categories );

        card.dataset.paid = c.paid ? "yes" : "no";
        card.innerHTML = `
          <a href="${c.website}" target="_blank" class="block p-6">
            <div class="flex items-center mb-4">
              <div class="bg-gray-100 w-12 h-12 rounded-lg flex items-center justify-center mr-4">
                <i class="${iconClass}"></i>
              </div>
              <div>
                <h3 class="text-xl font-bold">${c.name}</h3>
                <span class="text-sm text-gray-500">${c.address}</span>
              </div>
            </div>
            <div class="space-y-2 text-sm text-gray-700">

              <p><strong>Tech:</strong> ${JSON.parse(c.techStack).join(", ")}</p>
              <p><strong>Duration:</strong> ${c.duration}</p>
              <p><strong>Applied via:</strong> ${c.appliedVia}</p>
              <p><strong>Recruitment:</strong> ${c.recruitmentProcess}</p>
              <p><strong>Exam/Test:</strong> ${c.examDetails}</p>
              <p><strong>Advice:</strong> ${c.extraAdvice || "—"}</p>
            </div>
          </a>
        `;
        container.appendChild(card);
    });
}

function filterCompanies() {
    const q = document.getElementById("searchInput").value.toLowerCase();
    const filtered = companies.filter(c =>
        c.name.toLowerCase().includes(q) ||
        c.techStack.join(" ").toLowerCase().includes(q) ||
        c.address.toLowerCase().includes(q)
    );
    renderCompanies(filtered);
}

// Load companies AFTER DOM is ready
document.addEventListener("DOMContentLoaded", loadCompanies);
 
    </script>