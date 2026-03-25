<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>Instruksi Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #fce7f3; min-height: 100vh; }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(244, 114, 182, 0.1);
        }
        .pm-logo-box {
            background-color: <?= !empty($pm['bg_color']) ? htmlspecialchars($pm['bg_color']) : '#ffffff' ?>;
        }
    </style>
</head>
<body class="p-4 flex flex-col items-center justify-center">

    <div class="w-full max-w-md animate__animated animate__fadeInUp">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">Menunggu Pembayaran ⏳</h1>
            <p class="text-pink-500 font-bold mt-2">Selesaikan transfermu untuk mengirim dukungan!</p>
        </div>

        <div class="glass-card rounded-[2.5rem] p-8 mb-8 relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-pink-400 to-rose-400"></div>
            
            <div class="flex flex-col items-center mb-8">
                <div class="w-24 h-24 rounded-2xl pm-logo-box p-4 flex items-center justify-center shadow-lg mb-4">
                    <img src="<?= $pm['logo'] ?>" alt="<?= $pm['name'] ?>" class="max-w-full max-h-full object-contain">
                </div>
                <h2 class="text-xl font-black text-gray-800 uppercase tracking-widest"><?= $pm['name'] ?></h2>
            </div>
            
            <div class="bg-white/50 rounded-3xl p-6 mb-8 text-center border border-pink-100">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Tansfer</p>
                <p class="text-4xl font-black text-pink-600 mb-2">Rp <?= number_format($transaction['amount'] + $transaction['admin_fee'], 0, ',', '.') ?></p>
                <div class="inline-block bg-pink-100 text-pink-500 text-xs font-black px-3 py-1 rounded-full">
                    Termasuk admin fee
                </div>
            </div>

            <div class="space-y-6">
                <?php if ($pm['type'] === 'va'): ?>
                    <div>
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-2">Nomor Virtual Account</p>
                        <div class="flex items-center justify-between bg-white rounded-2xl p-4 border border-gray-100 shadow-sm">
                            <span class="text-xl font-black text-gray-800 tracking-wider font-mono">8823 4410 9928 331</span>
                            <button onclick="copyToClipboard('882344109928331')" class="w-10 h-10 bg-pink-50 text-pink-500 rounded-xl flex items-center justify-center hover:bg-pink-100 transition-colors">
                                <ion-icon name="copy-outline"></ion-icon>
                            </button>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center">
                        <p class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-4">Scan QRIS Berikut</p>
                        <div class="inline-block bg-white p-4 rounded-3xl shadow-md border border-gray-100">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="GOPAY QR" class="w-48 h-48 opacity-80">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <a href="<?= base_url('/') ?>" class="block w-full text-center bg-gray-800 text-white py-5 rounded-[2rem] font-black text-sm uppercase tracking-widest shadow-xl hover:bg-gray-900 active:scale-95 transition-all">
            Saya Sudah Transfer
        </a>
        <a href="<?= base_url('/') ?>" class="block w-full text-center mt-4 text-gray-500 font-bold text-xs hover:text-pink-500 transition-colors">
            Kembali ke Beranda
        </a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Disalin!',
                    showConfirmButton: false,
                    timer: 1500,
                    iconColor: '#ec4899',
                    customClass: { popup: 'rounded-2xl' }
                });
            });
        }
    </script>
</body>
</html>
