<?php echo $this->extend('admin/layout'); ?>

<?php echo $this->section('content'); ?>

<div class="glass-card p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] animate__animated animate__fadeInUp">
    <div class="flex items-center justify-between mb-6">
        <h3 class="flex items-center gap-2 font-black text-lg text-gray-800">
            <ion-icon name="cash-outline" class="text-pink-500"></ion-icon> Nominal Dukungan
        </h3>
        <button onclick="openModal()" class="w-9 h-9 bg-pink-500 text-white rounded-xl font-black shadow-lg shadow-pink-100 hover:scale-105 active:scale-95 transition-all flex items-center justify-center">
            <ion-icon name="add-outline" class="text-xl"></ion-icon>
        </button>
    </div>

    <!-- Modal Form -->
    <div id="nominalModal" class="fixed inset-0 z-[60] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-pink-100/20 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="glass-card w-full max-w-sm p-6 rounded-[2rem] relative animate__animated animate__zoomIn animate__faster">
            <h4 id="modalTitle" class="font-black text-lg mb-4 text-gray-800 flex items-center gap-2">
                <ion-icon name="add-circle-outline" class="text-pink-500"></ion-icon> Tambah Nominal
            </h4>
            <form action="<?= base_url('admin/nominal_save') ?>" method="POST" class="space-y-4">
                <input type="hidden" name="id" id="nominal_id">
                <div>
                    <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Jumlah (Rp)</label>
                    <input type="number" name="amount" id="nominal_amount" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none" required placeholder="5000">
                </div>
                <div>
                    <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Label (Teks)</label>
                    <input type="text" name="label" id="nominal_label" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none" required placeholder="Contoh: 5k">
                </div>
                <div>
                    <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Warna (Tailwind)</label>
                    <input type="text" name="color" id="nominal_color" value="bg-pink-100" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none" required>
                </div>
                <div class="flex gap-2 pt-2">
                    <button type="button" onclick="closeModal()" class="flex-1 bg-gray-400/10 text-gray-500 py-3 rounded-xl font-bold text-xs hover:bg-white transition-all">
                        Batal
                    </button>
                    <button type="submit" class="flex-[2] bg-pink-500 text-white py-3 rounded-xl font-black uppercase text-xs tracking-widest shadow-lg shadow-pink-100 hover:scale-105 active:scale-95 transition-all">
                        Simpan ✨
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="no-scrollbar overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/30 text-[9px] font-black text-gray-400 uppercase tracking-widest">
                    <th class="py-2 px-2">Label</th>
                    <th class="py-2 px-2">Jumlah</th>
                    <th class="py-2 px-2">Warna</th>
                    <th class="py-2 px-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-bold text-[10px] text-gray-700">
                <?php foreach($nominals as $n): ?>
                <tr class="border-b border-white/10 hover:bg-white/10 transition-colors">
                    <td class="py-2 px-2 whitespace-nowrap"><?= $n['label'] ?></td>
                    <td class="py-2 px-2 text-pink-600 whitespace-nowrap">Rp <?= number_format($n['amount'], 0, ',', '.') ?></td>
                    <td class="py-2 px-2">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full <?= $n['color'] ?> shadow-sm border border-white/50"></span>
                            <span class="text-[9px] text-gray-400 uppercase tracking-tighter opacity-70"><?= $n['color'] ?></span>
                        </div>
                    </td>
                    <td class="py-2 px-2">
                        <div class="flex justify-center gap-1">
                            <button onclick="editNominal(<?= $n['id'] ?>, '<?= $n['amount'] ?>', '<?= $n['label'] ?>', '<?= $n['color'] ?>')" class="p-1.5 bg-pink-100 text-pink-600 rounded-md hover:bg-pink-200 transition-colors">
                                <ion-icon name="create-outline"></ion-icon>
                            </button>
                            <a href="<?= base_url('admin/nominal_delete/'.$n['id']) ?>" onclick="return confirm('Hapus nominal ini?')" class="p-1.5 bg-rose-100 text-rose-600 rounded-md hover:bg-rose-200 transition-colors">
                                <ion-icon name="trash-outline"></ion-icon>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function openModal() {
        resetForm();
        document.getElementById('modalTitle').innerText = 'Tambah Nominal';
        document.getElementById('nominalModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('nominalModal').classList.add('hidden');
    }
    function editNominal(data) {
        document.getElementById('nominal_id').value = data.id;
        document.getElementById('nominal_amount').value = data.amount;
        document.getElementById('nominal_label').value = data.label;
        document.getElementById('nominal_color').value = data.color;
        document.getElementById('modalTitle').innerText = 'Edit Nominal';
        document.getElementById('nominalModal').classList.remove('hidden');
    }
    function resetForm() {
        document.getElementById('nominal_id').value = '';
        document.getElementById('nominal_amount').value = '';
        document.getElementById('nominal_label').value = '';
        document.getElementById('nominal_color').value = 'bg-pink-100';
    }
</script>

<?php echo $this->endSection(); ?>
