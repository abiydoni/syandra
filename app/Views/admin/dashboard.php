<?php echo $this->extend('admin/layout'); ?>

<?php echo $this->section('content'); ?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">

    <!-- Card Statistik -->
    <div class="glass-card p-5 rounded-[1.5rem] animate__animated animate__fadeInLeft">
        <h3 class="flex items-center gap-2 font-black text-sm mb-4 text-gray-800">
            <ion-icon name="stats-chart-outline" class="text-pink-500"></ion-icon> Statistik
        </h3>
        <div class="grid grid-cols-2 gap-3">
            <div class="bg-white/40 backdrop-blur-sm p-4 rounded-2xl border border-white/50 shadow-sm">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Pendapatan</p>
                <p class="text-xl font-black text-gray-800">Rp <?= number_format($total_donations, 0, ',', '.') ?></p>
            </div>
            <div class="bg-white/40 backdrop-blur-sm p-4 rounded-2xl border border-white/50 shadow-sm">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Dukungan</p>
                <p class="text-xl font-black text-gray-800"><?= $count_donations ?> <span class="text-[10px] font-bold text-gray-500">Donasi</span></p>
            </div>
        </div>
    </div>

    <!-- Card Terbaru -->
    <div class="glass-card p-5 rounded-[1.5rem] animate__animated animate__fadeInRight">
        <h3 class="flex items-center gap-2 font-black text-sm mb-4 text-gray-800">
            <ion-icon name="time-outline" class="text-pink-500"></ion-icon> Terbaru
        </h3>
        <div class="no-scrollbar overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/30 text-[9px] font-black text-gray-400 uppercase tracking-widest">
                        <th class="py-1.5 px-2">Nama</th>
                        <th class="py-1.5 px-2 text-right">Jumlah</th>
                        <th class="py-1.5 px-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="font-bold text-[10px] text-gray-700">
                    <?php if(!empty($recent_transactions)): ?>
                        <?php foreach($recent_transactions as $tx): ?>
                        <tr class="border-b border-white/10 hover:bg-white/20 transition-colors">
                            <td class="py-1.5 px-2"><?= $tx['donor_name'] ?></td>
                            <td class="py-1.5 px-2 text-right">Rp <?= number_format($tx['amount'], 0, ',', '.') ?></td>
                            <td class="py-1.5 px-2 text-center">
                                <span class="px-2 py-0.5 bg-pink-100/50 text-pink-600 rounded-lg text-[8px] font-black uppercase"><?= $tx['status'] ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="py-8 text-center text-gray-400 italic">Belum ada donasi</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php echo $this->endSection(); ?>
