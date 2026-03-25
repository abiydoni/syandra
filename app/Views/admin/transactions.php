<?php echo $this->extend('admin/layout'); ?>

<?php echo $this->section('content'); ?>

<div class="glass-card p-4 sm:p-5 rounded-[1.5rem] animate__animated animate__fadeIn">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h3 class="flex items-center gap-2 font-black text-lg text-gray-800">
            <ion-icon name="receipt" class="text-pink-500"></ion-icon> Daftar Transaksi
        </h3>
    </div>

    <div class="no-scrollbar overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/30 text-[9px] font-black text-gray-400 uppercase tracking-widest">
                    <th class="py-2 px-2">Donatur</th>
                    <th class="py-2 px-2 text-right">Jumlah & Status</th>
                    <th class="py-2 px-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-bold text-[10px] text-gray-700">
                <?php if(!empty($transactions)): ?>
                    <?php foreach($transactions as $tx): ?>
                    <tr class="border-b border-white/10 hover:bg-white/20 transition-colors">
                        <td class="py-2 px-2">
                            <div class="font-black text-[11px] text-gray-800"><?= htmlspecialchars($tx['donor_name']) ?></div>
                            <div class="text-[8px] text-gray-400 mt-0.5"><?= date('d/m/y H:i', strtotime($tx['created_at'])) ?></div>
                        </td>
                        <td class="py-2 px-2 text-right">
                            <div class="font-black text-[11px] text-gray-800"><?= number_format($tx['amount'], 0, ',', '.') ?></div>
                            <div class="mt-0.5">
                                <?php 
                                    $statusClass = 'bg-gray-100 text-gray-600';
                                    if($tx['status'] == 'success') $statusClass = 'bg-green-100/50 text-green-600';
                                    if($tx['status'] == 'pending') $statusClass = 'bg-yellow-100/50 text-yellow-600';
                                    if($tx['status'] == 'failed')  $statusClass = 'bg-rose-100/50 text-rose-600';
                                ?>
                                <span class="px-2 py-0.5 rounded-md text-[7px] font-black uppercase <?= $statusClass ?>">
                                    <?= $tx['status'] ?>
                                </span>
                            </div>
                        </td>
                        <td class="py-2 px-2 text-right">
                            <div class="flex justify-end gap-1">
                                <button onclick="updateStatus(<?= $tx['id'] ?>, '<?= $tx['status'] ?>')" class="p-1.5 bg-pink-100 text-pink-600 rounded-md hover:bg-pink-200 transition-colors" title="Update Status">
                                    <ion-icon name="sync-outline"></ion-icon>
                                </button>
                                <a href="<?= base_url('admin/transaction_delete/'.$tx['id']) ?>" onclick="return confirm('Hapus transaksi ini?')" class="p-1.5 bg-rose-100 text-rose-600 rounded-md hover:bg-rose-200 transition-colors">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400 italic">Belum ada transaksi recorded</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Update Status Modal -->
<div id="statusModal" class="fixed inset-0 z-[150] hidden">
    <div class="absolute inset-0 bg-black/20 backdrop-blur-sm" onclick="closeStatusModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] max-w-xs animate__animated animate__zoomIn">
        <div class="glass-card p-6 rounded-[2rem] shadow-2xl border-white/50">
            <h3 class="text-lg font-black text-gray-800 mb-6 flex items-center gap-2">
                <ion-icon name="sync" class="text-pink-500"></ion-icon> Ubah Status
            </h3>
            <div class="flex flex-col gap-3">
                <a id="btnSuccess" href="#" class="px-4 py-3 bg-green-500 text-white rounded-xl font-black text-[10px] uppercase tracking-widest text-center shadow-lg shadow-green-100 hover:scale-105 transition-all">Success</a>
                <a id="btnPending" href="#" class="px-4 py-3 bg-yellow-500 text-white rounded-xl font-black text-[10px] uppercase tracking-widest text-center shadow-lg shadow-yellow-100 hover:scale-105 transition-all">Pending</a>
                <a id="btnFailed"  href="#" class="px-4 py-3 bg-rose-500 text-white rounded-xl font-black text-[10px] uppercase tracking-widest text-center shadow-lg shadow-rose-100 hover:scale-105 transition-all">Failed</a>
                
                <button onclick="closeStatusModal()" class="mt-4 px-4 py-3 bg-gray-100 text-gray-600 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-gray-200 transition-all">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
function updateStatus(id, currentStatus) {
    const baseUrl = '<?= base_url('admin/transaction_status') ?>';
    document.getElementById('btnSuccess').href = `${baseUrl}/${id}/success`;
    document.getElementById('btnPending').href = `${baseUrl}/${id}/pending`;
    document.getElementById('btnFailed').href  = `${baseUrl}/${id}/failed`;
    document.getElementById('statusModal').classList.remove('hidden');
}

function closeStatusModal() {
    document.getElementById('statusModal').classList.add('hidden');
}
</script>

<?php echo $this->endSection(); ?>
