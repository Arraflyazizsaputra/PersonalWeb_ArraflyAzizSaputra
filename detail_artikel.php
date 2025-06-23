<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    echo "Artikel tidak ditemukan.";
    exit;
}

$id = mysqli_real_escape_string($db, $_GET['id']);
$sql = "SELECT * FROM tbl_artikel WHERE id_artikel = '$id'";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "Artikel tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($data['nama_artikel']); ?> | Detail Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-700 to-cyan-400 min-h-screen text-white font-sans">

    <!-- Header Mewah -->
    <header class="text-center py-8 shadow-lg">
        <div class="flex flex-col items-center space-y-2 md:flex-row md:space-y-0 md:space-x-4 md:justify-center animate-pulse">
            <div class="text-4xl md:text-5xl animate-bounce drop-shadow-xl">📝✨</div>
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-3xl font-bold tracking-wide drop-shadow-lg">
                DETAIL ARTIKEL | <span class="text-yellow-300">ARRAFLY AZIZ SAPUTRA</span>
            </h1>
        </div>
    </header>

    <!-- Konten Artikel -->
    <main class="max-w-4xl mx-auto p-6 mt-8 bg-white text-gray-800 dark:bg-gray-900 dark:text-white rounded-xl shadow-2xl transition-all duration-500 hover:scale-[1.02]">
        <h2 class="text-3xl font-extrabold text-blue-700 mb-4 border-b-2 border-blue-400 pb-2">
            📚 <?php echo htmlspecialchars($data['nama_artikel']); ?>
        </h2>
        <p class="text-lg leading-relaxed text-justify">
            <?php echo nl2br(htmlspecialchars($data['isi_artikel'])); ?>
        </p>

        <div class="mt-6">
            <a href="index.php" class="inline-block bg-yellow-300 hover:bg-yellow-400 text-blue-900 font-bold px-5 py-2 rounded-lg shadow hover:scale-105 transition duration-300">
                ← Kembali ke Beranda
            </a>
        </div>
    </main>

    <!-- Footer Lucu -->
    <footer class="mt-20 text-center text-sm text-white/80 py-6">
        Made with ❤️ by <span class="font-bold text-yellow-300">Arrafly</span> © <?php echo date("Y"); ?>
    </footer>
</body>
</html>
