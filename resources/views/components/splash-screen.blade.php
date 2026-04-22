@if(session('show_splash'))
<div id="splashScreen" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white transition-all duration-500">
    <div class="text-center">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">
            {{ session('splash_message', 'Selamat Datang!') }}
        </h2>
        <div class="w-8 h-8 mx-auto border-2 border-gray-300 border-t-gray-600 rounded-full animate-spin"></div>
    </div>
</div>

<script>
    setTimeout(function() {
        const splash = document.getElementById('splashScreen');
        if (splash) {
            splash.style.opacity = '0';
            setTimeout(() => splash.remove(), 500);
        }
    }, 2000);
</script>
@endif