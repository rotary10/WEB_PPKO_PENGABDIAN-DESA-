<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wonderful Indonesia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="nav-container">
            <div class="logo">
                <h1><span class="wonderful">wonderful</span> indonesia</h1>
            </div>
            <nav>
                <ul class="nav-menu">
                    <li><a href="#beranda">🏠 Beranda</a></li>
                    <li><a href="#profil">👤 Profil</a></li>
                    <li><a href="#wisata">🏝️ Wisata</a></li>
                    <li><a href="#kebudayaan">🎭 Kebudayaan</a></li>
                    <li><a href="#informasi">ℹ️ Informasi</a></li>
                    <li><a href="#galeri">📸 Galeri</a></li>
                    <li><a href="#kontak">📞 Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero slide-1">
        <div class="hero-content">
            <div class="location-tag">Kalimantan Timur, Indonesia</div>
            <h1 class="hero-title">Raja Ampat Marine Paradise</h1>
            
            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Destinasi terbaik</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15</div>
                    <div class="stat-label">Kesenian & Kebudayaan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">25</div>
                    <div class="stat-label">Event menarik</div>
                </div>
            </div>
        </div>

        <!-- Play Button -->
        <button class="play-button" onclick="openVideoPopup()"></button>

        <!-- Navigation Arrows -->
        <button class="nav-arrow left" onclick="previousSlide()"></button>
        <button class="nav-arrow right" onclick="nextSlide()"></button>

        <!-- Page Counter -->
        <div class="page-counter">
            <span class="current">01</span> / 05
        </div>
    </section>

    <!-- Video Popup -->
    <div class="video-popup" id="videoPopup">
        <div class="video-container">
            <button class="close-button" onclick="closeVideoPopup()">×</button>
            <video id="promoVideo" controls>
                <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" type="video/mp4">
                <p>Browser Anda tidak mendukung tag video.</p>
            </video>
        </div>
    </div>

    <!-- Social Media Icons -->
    <div class="social-icons">
        <a href="#" class="social-icon">f</a>
        <a href="#" class="social-icon">🐦</a>
        <a href="#" class="social-icon">📷</a>
    </div>

    <script>
        // Destinations data
        const destinations = [
            {
                title: "Raja Ampat Marine Paradise",
                location: "Papua Barat, Indonesia",
                wisata: 12,
                kebudayaan: 15,
                event: 25
            },
            {
                title: "Borobudur Temple Heritage",
                location: "Jawa Tengah, Indonesia", 
                wisata: 8,
                kebudayaan: 20,
                event: 12
            },
            {
                title: "Lake Toba Volcanic Wonder",
                location: "Sumatera Utara, Indonesia",
                wisata: 15,
                kebudayaan: 18,
                event: 22
            },
            {
                title: "Komodo National Park",
                location: "Nusa Tenggara Timur, Indonesia",
                wisata: 10,
                kebudayaan: 12,
                event: 18
            },
            {
                title: "Bromo Tengger Semeru",
                location: "Jawa Timur, Indonesia",
                wisata: 20,
                kebudayaan: 16,
                event: 30
            }
        ];

        let currentSlide = 1;
        const totalSlides = 5;
        let isTransitioning = false;

        function updateSlideContent(slideIndex) {
            if (isTransitioning) return;
            
            isTransitioning = true;
            const destination = destinations[slideIndex - 1];
            const hero = document.querySelector('.hero');
            const content = document.querySelector('.hero-content');
            
            // Add fade out effect
            content.classList.add('fade-out');
            
            setTimeout(() => {
                // Update content
                document.querySelector('.location-tag').textContent = destination.location;
                document.querySelector('.hero-title').textContent = destination.title;
                
                const statNumbers = document.querySelectorAll('.stat-number');
                statNumbers[0].textContent = destination.wisata;
                statNumbers[1].textContent = destination.kebudayaan;
                statNumbers[2].textContent = destination.event;
                
                document.querySelector('.page-counter .current').textContent = slideIndex.toString().padStart(2, '0');
                
                // Change background
                hero.className = `hero slide-${slideIndex}`;
                
                // Fade in content
                content.classList.remove('fade-out');
                content.classList.add('fade-in');
                
                setTimeout(() => {
                    isTransitioning = false;
                    content.classList.remove('fade-in');
                }, 500);
            }, 250);
        }

        function nextSlide() {
            if (isTransitioning) return;
            currentSlide = currentSlide >= totalSlides ? 1 : currentSlide + 1;
            updateSlideContent(currentSlide);
        }

        function previousSlide() {
            if (isTransitioning) return;
            currentSlide = currentSlide <= 1 ? totalSlides : currentSlide - 1;
            updateSlideContent(currentSlide);
        }

        // Video popup functions
        function openVideoPopup() {
            const popup = document.getElementById('videoPopup');
            const video = document.getElementById('promoVideo');
            popup.classList.add('active');
            video.play();
        }

        function closeVideoPopup() {
            const popup = document.getElementById('videoPopup');
            const video = document.getElementById('promoVideo');
            popup.classList.remove('active');
            video.pause();
            video.currentTime = 0;
        }

        // Event listeners
        document.getElementById('videoPopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVideoPopup();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeVideoPopup();
            }
            if (e.key === 'ArrowRight') {
                nextSlide();
            }
            if (e.key === 'ArrowLeft') {
                previousSlide();
            }
        });

        // Auto slide
        let autoSlideInterval = setInterval(nextSlide, 5000);

        // Pause auto slide when user interacts
        function pauseAutoSlide() {
            clearInterval(autoSlideInterval);
            setTimeout(() => {
                autoSlideInterval = setInterval(nextSlide, 5000);
            }, 10000); // Resume after 10 seconds
        }

        document.querySelector('.nav-arrow.left').addEventListener('click', pauseAutoSlide);
        document.querySelector('.nav-arrow.right').addEventListener('click', pauseAutoSlide);

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(0, 0, 0, 0.9)';
            } else {
                header.style.background = 'rgba(0, 0, 0, 0.7)';
            }
        });

        // Initialize
        window.addEventListener('load', function() {
            updateSlideContent(1);
            document.querySelector('.hero-content').style.animation = 'fadeInUp 1s ease';
            document.querySelector('.play-button').style.animation = 'fadeInRight 1s ease 0.5s both';
        });
    </script>
</body>
</html>