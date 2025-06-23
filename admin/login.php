<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location:beranda_admin.php');
}
require_once("../koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Administrator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        glassblue: 'rgba(255, 255, 255, 0.1)'
                    }
                }
            }
        }
    </script>
    <!-- Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-blue-700 to-blue-500 p-4">

    <div class="backdrop-blur-md bg-white/10 border border-blue-200/20 rounded-2xl p-8 shadow-2xl w-full max-w-md">
        <h2 class="text-3xl font-bold text-center text-white mb-8 drop-shadow-lg">Login Administrator</h2>

        <form action="cek_login.php" method="post" class="space-y-6">

            <!-- Username -->
            <div class="relative">
                <label for="username" class="block text-sm font-semibold text-white mb-1">Username</label>
                <div class="flex items-center bg-white/20 rounded-lg px-3">
                    <i class="ri-user-line text-white text-xl mr-2"></i>
                    <input type="text" name="username" id="username" required
                        class="w-full bg-transparent py-2 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="block text-sm font-semibold text-white mb-1">Password</label>
                <div class="flex items-center bg-white/20 rounded-lg px-3">
                    <i class="ri-lock-line text-white text-xl mr-2"></i>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-transparent py-2 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <!-- Button -->
            <div class="flex justify-between space-x-4">
                <input type="submit" name="login" value="Login"
                    class="w-1/2 bg-cyan-400 hover:bg-cyan-300 text-blue-900 font-bold py-2 rounded-xl shadow-md transition duration-300 cursor-pointer">
                <input type="reset" name="cancel" value="Cancel"
                    class="w-1/2 bg-white/20 hover:bg-white/30 text-white border border-white py-2 rounded-xl cursor-pointer transition duration-300">
            </div>
        </form>

        <p class="text-center text-sm text-white/70 mt-6">
            &copy; <?php echo date('Y'); ?> | Buatan ArraflyAzizSaputra
        </p>
    </div>

</body>

</html>
