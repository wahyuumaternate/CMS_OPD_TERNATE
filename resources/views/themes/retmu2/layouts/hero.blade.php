 <!-- Hero Carousel Section -->
 <section class="hero" style="">
     <!-- Parallax Layers -->
     <div class="parallax-layer parallax-layer-1"></div>
     <div class="parallax-layer parallax-layer-2"></div>

     <div class="carousel-container">
         <div class="carousel-slide active">
             <div class="hero-container">
                 <div class="hero-content">
                     <h1>Kesehatan Prima, Kota Ternate Sejahtera</h1>
                     <p>
                         Memberikan pelayanan kesehatan terbaik untuk seluruh masyarakat
                         Kota Ternate dengan fasilitas modern dan tenaga medis
                         profesional.
                     </p>
                 </div>
                 <div class="hero-image">
                     <!-- Floating icon yang akan berpindah saat scroll -->
                     <div class="floating-icon">
                         <img src="{{ asset('themes/retmu2/bg2.png') }}" alt="Ikon Kesehatan" />
                     </div>
                 </div>
             </div>
         </div>

         <div class="carousel-slide">
             <div class="hero-container">
                 <div class="hero-content">
                     <h1>Program Imunisasi Nasional</h1>
                     <p>
                         Bergabunglah dalam program imunisasi massal untuk melindungi
                         keluarga dan masyarakat dari berbagai penyakit menular.
                     </p>
                 </div>
                 <div class="hero-image">
                     <!-- No floating icon for other slides -->
                 </div>
             </div>
         </div>

         <div class="carousel-slide">
             <div class="hero-container">
                 <div class="hero-content">
                     <h1>Fasilitas Kesehatan Modern</h1>
                     <p>
                         Nikmati pelayanan kesehatan dengan teknologi terdepan dan
                         standar internasional di seluruh Kota Ternate.
                     </p>
                 </div>
                 <div class="hero-image">
                     <!-- No floating icon for other slides -->
                 </div>
             </div>
         </div>
     </div>

     <!-- Carousel Controls -->
     <div class="carousel-controls">
         <button class="carousel-btn prev" onclick="changeSlide(-1)">‹</button>
         <button class="carousel-btn next" onclick="changeSlide(1)">›</button>
     </div>

     <!-- Carousel Indicators -->
     <div class="carousel-indicators">
         <span class="indicator active" onclick="currentSlide(1)"></span>
         <span class="indicator" onclick="currentSlide(2)"></span>
         <span class="indicator" onclick="currentSlide(3)"></span>
     </div>
 </section>
