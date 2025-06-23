<?php
include "koneksi.php";

// Ambil jumlah pengunjung per hari (7 hari terakhir)
$data_pengunjung = [];
$tanggal = [];

$sql = "SELECT tanggal, COUNT(*) as jumlah 
        FROM tbl_pengunjung 
        WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        GROUP BY tanggal 
        ORDER BY tanggal";

$result = mysqli_query($db, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $tanggal[] = $row['tanggal'];
    $data_pengunjung[] = $row['jumlah'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Personal Web | Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans dark:bg-blue-700 dark:text-white">
    <!-- Header Mewah & Simpel -->
<header class="bg-gradient-to-r from-blue-900 via-blue-700 to-cyan-400 text-white text-center py-8 px-4 shadow-lg">
  <div class="flex flex-col items-center space-y-2 md:flex-row md:space-y-0 md:space-x-4 md:justify-center animate-pulse">
    
    <!-- Ikon Lucu -->
    <div class="text-4xl md:text-5xl animate-bounce drop-shadow-xl">🌐✨</div>

    <!-- Judul -->
    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-3xl font-bold tracking-wide drop-shadow-lg">
      STATISTIK PENGUNJUNG | <span class="text-yellow-300">ARRAFLY AZIZ SAPUTRA</span>
    </h1>
    
  </div>
</header>

   <!-- Navigation -->
<nav class="sticky top-0 z-50 backdrop-blur-sm bg-gradient-to-r from-blue-900 via-blue-700 to-cyan-500 shadow-xl border-b border-blue-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">

      <!-- Brand / Logo -->
      <div class="text-white text-3xl font-bold tracking-widest font-mono drop-shadow-md">
        ⟡ ARRAFLY
      </div>

      <!-- Desktop Menu -->
      <div class="hidden md:flex space-x-10 items-center">
        <a href="index.php" class="text-white text-lg hover:text-yellow-300 transition duration-300 hover:scale-105">Artikel</a>
        <a href="gallery.php" class="text-white text-lg hover:text-yellow-300 transition duration-300 hover:scale-105">Gallery</a>
        <a href="about.php" class="text-white text-lg hover:text-yellow-300 transition duration-300 hover:scale-105">About</a>
        <a href="tanya_admin.php" class="text-white text-lg hover:text-yellow-300 transition duration-300 hover:scale-105">Tanya Admin</a>
        <a href="data_pengunjung.php" class="text-white text-lg hover:text-yellow-300 transition duration-300 hover:scale-105">Data Pengunjung</a>
        <a href="admin/login.php" class="bg-yellow-400 text-blue-900 font-bold px-4 py-2 rounded-xl shadow hover:bg-yellow-300 transition duration-300">Login</a>
      </div>

      <!-- Hamburger -->
      <div class="md:hidden">
        <button id="menuBtn" class="text-white focus:outline-none">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="md:hidden hidden px-6 py-4 text-white bg-gradient-to-br from-blue-900 via-blue-800 to-cyan-600 border-t border-blue-700 space-y-4">
    <a href="index.php" class="block hover:text-yellow-300 transition">Artikel</a>
    <a href="gallery.php" class="block hover:text-yellow-300 transition">Gallery</a>
    <a href="about.php" class="block hover:text-yellow-300 transition">About</a>
    <a href="tanya_admin.php" class="block hover:text-yellow-300 transition">Tanya Admin</a>
    <a href="data_pengunjung.php" class="block hover:text-yellow-300 transition">Data Pengunjung</a>
    <a href="admin/login.php" class="inline-block bg-yellow-400 text-blue-900 font-bold px-4 py-2 rounded-xl hover:bg-yellow-300 transition">Login</a>
  </div>
</nav>

<!-- Script Toggle -->
<script>
  document.getElementById('menuBtn').addEventListener('click', () => {
    document.getElementById('mobileMenu').classList.toggle('hidden');
  });
</script>

<!-- Statistik dan Grafik -->
<section class="max-w-5xl mx-auto p-6 mt-10 rounded-3xl shadow-2xl bg-gradient-to-br from-blue-900 via-blue-700 to-yellow-400 border-4 border-yellow-300 dark:bg-gradient-to-br dark:from-blue-900 dark:via-blue-800 dark:to-yellow-500 transition-all duration-500">

  <!-- Judul -->
  <h2 class="text-3xl font-extrabold text-white text-center mb-6 drop-shadow-md tracking-wide">📊 Statistik Pengunjung</h2>

  <!-- Container Grafik -->
  <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-inner">
    <canvas id="statChart" class="w-full h-64 md:h-80"></canvas>
  </div>

  <!-- Deskripsi Lucu -->
  <p class="mt-6 text-center text-white font-semibold italic text-lg">
    📅 Wah! Banyak yang mampir ya hari ini~ 👀✨
  </p>
</section>


    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center py-5 mt-20">
        &copy; <?php echo date('Y'); ?> | Buatan ArraflyAzizSaputra
        <div class="w-full pt-2 0">
            <div class="flex items-center justify-center mb-5">

                <!-- yutub -->
                <a href="https://youtube.com/@arraflyaziz2?si=MnABgllm3XJwLCvH" target="_blank"
                    class="w-9 h-9 mr-3 rounded-full flex justify-center items-center border border-slate-300 text-slate-300 hover:border-primary hover:bg-primary hover:text-white">
                    <svg role="img" width="20" fill="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <title>YouTube</title>
                        <path
                            d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                    </svg>
                </a>

                <!-- Instagram -->
                <a href="https://www.instagram.com/arrxfinly_a_s_/profilecard/?igsh=MTRndnJ1eDR0anZwdg=="
                    target="_blank" class="w-9 h-9 mr-3 rounded-full flex justify-center items-center border border-slate-300 text-slate-300 hover:border-primary hover:bg-primary hover:text-white">
                    <svg role="img" width="20" fill="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <title>Instagram</title>
                        <path
                            d="M7.0301.084c-1.2768.0602-2.1487.264-2.911.5634-.7888.3075-1.4575.72-2.1228 1.3877-.6652.6677-1.075 1.3368-1.3802 2.127-.2954.7638-.4956 1.6365-.552 2.914-.0564 1.2775-.0689 1.6882-.0626 4.947.0062 3.2586.0206 3.6671.0825 4.9473.061 1.2765.264 2.1482.5635 2.9107.308.7889.72 1.4573 1.388 2.1228.6679.6655 1.3365 1.0743 2.1285 1.38.7632.295 1.6361.4961 2.9134.552 1.2773.056 1.6884.069 4.9462.0627 3.2578-.0062 3.668-.0207 4.9478-.0814 1.28-.0607 2.147-.2652 2.9098-.5633.7889-.3086 1.4578-.72 2.1228-1.3881.665-.6682 1.0745-1.3378 1.3795-2.1284.2957-.7632.4966-1.636.552-2.9124.056-1.2809.0692-1.6898.063-4.948-.0063-3.2583-.021-3.6668-.0817-4.9465-.0607-1.2797-.264-2.1487-.5633-2.9117-.3084-.7889-.72-1.4568-1.3876-2.1228C21.2982 1.33 20.628.9208 19.8378.6165 19.074.321 18.2017.1197 16.9244.0645 15.6471.0093 15.236-.005 11.977.0014 8.718.0076 8.31.0215 7.0301.0839m.1402 21.6932c-1.17-.0509-1.8053-.2453-2.2287-.408-.5606-.216-.96-.4771-1.3819-.895-.422-.4178-.6811-.8186-.9-1.378-.1644-.4234-.3624-1.058-.4171-2.228-.0595-1.2645-.072-1.6442-.079-4.848-.007-3.2037.0053-3.583.0607-4.848.05-1.169.2456-1.805.408-2.2282.216-.5613.4762-.96.895-1.3816.4188-.4217.8184-.6814 1.3783-.9003.423-.1651 1.0575-.3614 2.227-.4171 1.2655-.06 1.6447-.072 4.848-.079 3.2033-.007 3.5835.005 4.8495.0608 1.169.0508 1.8053.2445 2.228.408.5608.216.96.4754 1.3816.895.4217.4194.6816.8176.9005 1.3787.1653.4217.3617 1.056.4169 2.2263.0602 1.2655.0739 1.645.0796 4.848.0058 3.203-.0055 3.5834-.061 4.848-.051 1.17-.245 1.8055-.408 2.2294-.216.5604-.4763.96-.8954 1.3814-.419.4215-.8181.6811-1.3783.9-.4224.1649-1.0577.3617-2.2262.4174-1.2656.0595-1.6448.072-4.8493.079-3.2045.007-3.5825-.006-4.848-.0608M16.953 5.5864A1.44 1.44 0 1 0 18.39 4.144a1.44 1.44 0 0 0-1.437 1.4424M5.8385 12.012c.0067 3.4032 2.7706 6.1557 6.173 6.1493 3.4026-.0065 6.157-2.7701 6.1506-6.1733-.0065-3.4032-2.771-6.1565-6.174-6.1498-3.403.0067-6.156 2.771-6.1496 6.1738M8 12.0077a4 4 0 1 1 4.008 3.9921A3.9996 3.9996 0 0 1 8 12.0077" />
                    </svg>
                </a>

                <!-- X -->
                <a href="https://x.com/arrafly_aziz?t=aUe2zmeNRwIZV9ksai1XUA&s=08" target="_blank" class="w-9 h-9 mr-3 rounded-full flex justify-center items-center border border-slate-300 text-slate-300 hover:border-primary hover:bg-primary hover:text-white">
                    <svg role="img" width="20" fill="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <title>X</title>
                        <path
                            d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z" />
                    </svg>
                </a>

                <!-- Tiktok -->
                <a href="https://www.tiktok.com/@pengen_leptop_gaming?_t=8r6Wx3psHzT&_r=1" target="_blank"
                    class="w-9 h-9 mr-3 rounded-full flex justify-center items-center border border-slate-300 text-slate-300 hover:border-primary hover:bg-primary hover:text-white">
                    <svg role="img" width="20" fill="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <title>TikTok</title>
                        <path
                            d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                    </svg>
                </a>

                <!--spotify-->
                <a href="https://open.spotify.com/user/31otpy7htclwrlrgs5ukzm3tkejq?si=6PoWho7OSC6jFLVGlSCeww"
                    target="_blank" class="w-9 h-9 mr-3 rounded-full flex justify-center items-center border border-slate-300 text-slate-300 hover:border-primary hover:bg-primary hover:text-white">
                    <svg role="img" width="20" fill="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <title>Spotify</title>
                        <path
                            d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z" />
                    </svg>
                </a>

                <!-- github -->
                <a href="https://github.com/Arraflyazizsaputra"
                    target="_blank" class="w-9 h-9 mr-3 rounded-full flex justify-center items-center border border-slate-300 text-slate-300 hover:border-primary hover:bg-primary hover:text-white">
                    <svg width="20" height="20" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8" />
                </svg>
                </a>
            </div>

            <p class="font-medium text-sm text-white text-center">Dibuat dengan <span class="text-pink-500" style='font-size:20px;'>&#129397;</span>
                oleh <a href="http://instagram.com/" target="_blank" class="font-bold text-primary">Arrafly Aziz Saputra</a>, menggunakan
                <a href="https://tailwindcss.com/" target="_blank" class="font-bold text-yellow-300">Cdn Tailwind CSS</a>.
            </p>
        </div>
    </footer>

<!-- Load Chart.js sekali saja -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('statChart').getContext('2d');
  const statChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($tanggal); ?>, // Data label (misal: ['Senin', 'Selasa', ...])
      datasets: [{
        label: '👣 Jumlah Pengunjung',
        data: <?php echo json_encode($data_pengunjung); ?>, // Data angka pengunjung
        backgroundColor: [
          'rgba(253, 224, 71, 0.8)',  // kuning-400
          'rgba(96, 165, 250, 0.8)',  // biru-400
          'rgba(147, 197, 253, 0.8)',
          'rgba(253, 224, 71, 0.8)',
          'rgba(96, 165, 250, 0.8)',
          'rgba(147, 197, 253, 0.8)',
          'rgba(253, 224, 71, 0.8)'
        ],
        borderColor: 'rgba(30, 64, 175, 1)',  // biru navy
        borderWidth: 2,
        borderRadius: 10
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        duration: 1000,
        easing: 'easeOutBounce'
      },
      plugins: {
        legend: {
          display: true,
          labels: {
            color: '#1e3a8a', // biru tua
            font: {
              weight: 'bold',
              size: 14
            }
          }
        },
        tooltip: {
          backgroundColor: 'rgba(30, 58, 138, 0.9)',
          titleColor: '#fde047',
          bodyColor: '#fff',
          borderColor: '#facc15',
          borderWidth: 1
        }
      },
      scales: {
        x: {
          ticks: {
            color: '#1e3a8a',
            font: { weight: '600' }
          }
        },
        y: {
          beginAtZero: true,
          ticks: {
            color: '#1e3a8a',
            stepSize: 1,
            font: { weight: '600' }
          },
          grid: {
            color: 'rgba(255,255,255,0.2)'
          }
        }
      }
    }
  });
</script>

</body>

</html>
