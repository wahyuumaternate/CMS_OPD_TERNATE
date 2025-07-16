@extends('themes.retmu2.layouts.main')

@section('main')
    <!-- Featured Posts Section -->
    <section class="featured-posts" style="position: relative">
        <div class="container">
            <div class="section-header">
                <div class="section-icon">⭐</div>
                <h2>Artikel Unggulan</h2>
            </div>

            <div class="featured-grid">
                <div class="featured-article">
                    <div class="featured-image"></div>
                    <div class="featured-content">
                        <div class="article-category featured">Unggulan</div>
                        <h3>Pencegahan Diabetes di Era Modern</h3>
                        <p>
                            Panduan lengkap mencegah diabetes mellitus melalui pola hidup
                            sehat dan deteksi dini...
                        </p>
                        <div class="article-meta">
                            <span class="date">15 Juli 2025</span>
                            <span class="author">Dr. Sarah Amelia</span>
                        </div>
                    </div>
                </div>

                <div class="featured-article">
                    <div class="featured-image"></div>
                    <div class="featured-content">
                        <div class="article-category featured">Unggulan</div>
                        <h3>Kesehatan Mental Pasca Pandemi</h3>
                        <p>
                            Strategi memulihkan kesehatan mental dan membangun resiliensi
                            setelah pandemi COVID-19...
                        </p>
                        <div class="article-meta">
                            <span class="date">12 Juli 2025</span>
                            <span class="author">Dr. Ahmad Rizki</span>
                        </div>
                    </div>
                </div>

                <div class="featured-article">
                    <div class="featured-image"></div>
                    <div class="featured-content">
                        <div class="article-category featured">Unggulan</div>
                        <h3>Gizi Seimbang untuk Anak</h3>
                        <p>
                            Tips praktis memberikan nutrisi optimal untuk mendukung tumbuh
                            kembang anak yang sehat...
                        </p>
                        <div class="article-meta">
                            <span class="date">10 Juli 2025</span>
                            <span class="author">Dr. Lisa Maharani</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Floating Image - positioned in this section -->
        <div class="scroll-floating-image">
            <img src="{{ asset('themes/retmu2/bg2.png') }}" alt="Floating Health Icon" />
        </div>
    </section>

    <!-- Mouse Follower -->
    <div class="mouse-follower"></div>

    <!-- Featured Posts Section -->
    <section class="featured-posts">
        <div class="container">
            <div class="section-header">
                <div class="section-icon">⭐</div>
                <h2>Artikel Unggulan</h2>
            </div>

            <div class="featured-grid">
                <div class="featured-article">
                    <div class="featured-image"></div>
                    <div class="featured-content">
                        <div class="article-category featured">Unggulan</div>
                        <h3>Pencegahan Diabetes di Era Modern</h3>
                        <p>
                            Panduan lengkap mencegah diabetes mellitus melalui pola hidup
                            sehat dan deteksi dini...
                        </p>
                        <div class="article-meta">
                            <span class="date">15 Juli 2025</span>
                            <span class="author">Dr. Sarah Amelia</span>
                        </div>
                    </div>
                </div>

                <div class="featured-article">
                    <div class="featured-image"></div>
                    <div class="featured-content">
                        <div class="article-category featured">Unggulan</div>
                        <h3>Kesehatan Mental Pasca Pandemi</h3>
                        <p>
                            Strategi memulihkan kesehatan mental dan membangun resiliensi
                            setelah pandemi COVID-19...
                        </p>
                        <div class="article-meta">
                            <span class="date">12 Juli 2025</span>
                            <span class="author">Dr. Ahmad Rizki</span>
                        </div>
                    </div>
                </div>

                <div class="featured-article">
                    <div class="featured-image"></div>
                    <div class="featured-content">
                        <div class="article-category featured">Unggulan</div>
                        <h3>Gizi Seimbang untuk Anak</h3>
                        <p>
                            Tips praktis memberikan nutrisi optimal untuk mendukung tumbuh
                            kembang anak yang sehat...
                        </p>
                        <div class="article-meta">
                            <span class="date">10 Juli 2025</span>
                            <span class="author">Dr. Lisa Maharani</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Posts Section -->
    <section class="latest-posts">
        <div class="container">
            <div class="section-header">
                <div class="section-icon">📰</div>
                <h2>Berita Terbaru</h2>
            </div>

            <div class="latest-grid">
                <div class="latest-article">
                    <div class="latest-image"></div>
                    <div class="latest-content">
                        <div class="article-category latest">Terbaru</div>
                        <h4>Vaksinasi HPV Gratis untuk Remaja Putri</h4>
                        <p>
                            Program vaksinasi HPV gratis dimulai bulan ini untuk mencegah
                            kanker serviks...
                        </p>
                        <span class="date">14 Juli 2025</span>
                    </div>
                </div>

                <div class="latest-article">
                    <div class="latest-image"></div>
                    <div class="latest-content">
                        <div class="article-category latest">Terbaru</div>
                        <h4>Puskesmas Baru di Kelurahan Sasa</h4>
                        <p>
                            Pembukaan puskesmas baru untuk meningkatkan akses layanan
                            kesehatan masyarakat...
                        </p>
                        <span class="date">13 Juli 2025</span>
                    </div>
                </div>

                <div class="latest-article">
                    <div class="latest-image"></div>
                    <div class="latest-content">
                        <div class="article-category latest">Terbaru</div>
                        <h4>Kampanye Anti Narkoba di Sekolah</h4>
                        <p>
                            Sosialisasi bahaya narkoba dan cara pencegahan di lingkungan
                            sekolah...
                        </p>
                        <span class="date">12 Juli 2025</span>
                    </div>
                </div>

                <div class="latest-article">
                    <div class="latest-image"></div>
                    <div class="latest-content">
                        <div class="article-category latest">Terbaru</div>
                        <h4>Pelatihan Kader Posyandu</h4>
                        <p>
                            Meningkatkan kapasitas kader posyandu dalam memberikan pelayanan
                            kesehatan...
                        </p>
                        <span class="date">11 Juli 2025</span>
                    </div>
                </div>

                <div class="latest-article">
                    <div class="latest-image"></div>
                    <div class="latest-content">
                        <div class="article-category latest">Terbaru</div>
                        <h4>Pemeriksaan Kesehatan Gratis</h4>
                        <p>
                            Program pemeriksaan kesehatan gratis untuk lansia di seluruh
                            kelurahan...
                        </p>
                        <span class="date">10 Juli 2025</span>
                    </div>
                </div>

                <div class="latest-article">
                    <div class="latest-image"></div>
                    <div class="latest-content">
                        <div class="article-category latest">Terbaru</div>
                        <h4>Workshop Cuci Tangan yang Benar</h4>
                        <p>
                            Edukasi teknik cuci tangan yang efektif untuk mencegah
                            penyebaran penyakit...
                        </p>
                        <span class="date">9 Juli 2025</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Announcements Section -->
    <section class="announcements">
        <div class="container">
            <div class="section-header">
                <div class="section-icon">📢</div>
                <h2>Pengumuman</h2>
            </div>

            <div class="announcement-grid">
                <div class="announcement-item important">
                    <div class="announcement-icon">🚨</div>
                    <div class="announcement-content">
                        <h3>Perubahan Jam Operasional</h3>
                        <p>
                            Mulai tanggal 15 Juli 2025, jam operasional Puskesmas berubah
                            menjadi 07:00 - 17:00 WIT
                        </p>
                        <span class="announcement-date">14 Juli 2025</span>
                    </div>
                </div>

                <div class="announcement-item">
                    <div class="announcement-icon">💉</div>
                    <div class="announcement-content">
                        <h3>Jadwal Imunisasi Balita</h3>
                        <p>
                            Imunisasi rutin balita dilaksanakan setiap hari Selasa dan Kamis
                            di seluruh Puskesmas
                        </p>
                        <span class="announcement-date">12 Juli 2025</span>
                    </div>
                </div>

                <div class="announcement-item">
                    <div class="announcement-icon">📋</div>
                    <div class="announcement-content">
                        <h3>Pendaftaran Online Aktif</h3>
                        <p>
                            Sistem pendaftaran online telah aktif untuk mempermudah akses
                            layanan kesehatan
                        </p>
                        <span class="announcement-date">10 Juli 2025</span>
                    </div>
                </div>

                <div class="announcement-item">
                    <div class="announcement-icon">🏥</div>
                    <div class="announcement-content">
                        <h3>Layanan Telemedicine</h3>
                        <p>
                            Konsultasi dokter jarak jauh telah tersedia melalui platform
                            digital resmi
                        </p>
                        <span class="announcement-date">8 Juli 2025</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Dinas Kesehatan Kota Ternate</h3>
                <p>
                    Melayani dengan hati untuk kesehatan masyarakat Kota Ternate yang
                    lebih baik.
                </p>
                <div class="social-links">
                    <a href="#" title="Facebook">📘</a>
                    <a href="#" title="Twitter">🐦</a>
                    <a href="#" title="Instagram">📷</a>
                    <a href="#" title="YouTube">📺</a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Layanan</h3>
                <ul>
                    <li><a href="#">Pendaftaran Online</a></li>
                    <li><a href="#">Jadwal Dokter</a></li>
                    <li><a href="#">Informasi Kesehatan</a></li>
                    <li><a href="#">Program Imunisasi</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Fasilitas</h3>
                <ul>
                    <li><a href="#">Rumah Sakit Umum</a></li>
                    <li><a href="#">Puskesmas</a></li>
                    <li><a href="#">Apotek</a></li>
                    <li><a href="#">Laboratorium</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Kontak</h3>
                <ul>
                    <li>📧 dinkes@ternatekota.go.id</li>
                    <li>📞 (0921) 123-456</li>
                    <li>📍 Jl. Kesehatan No. 1, Ternate</li>
                    <li>🕒 Senin - Jumat: 08:00 - 16:00</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>
                &copy; 2025 Dinas Kesehatan Kota Ternate. Semua hak dilindungi
                undang-undang.
            </p>
        </div>
    </footer>
@endsection
