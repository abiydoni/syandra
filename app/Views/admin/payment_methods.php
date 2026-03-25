<?php echo $this->extend('admin/layout'); ?>

<?php echo $this->section('content'); ?>

<div class="glass-card p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] animate__animated animate__fadeInUp">
    <div class="flex items-center justify-between mb-6">
        <h3 class="flex items-center gap-2 font-black text-lg text-gray-800">
            <ion-icon name="card-outline" class="text-pink-500"></ion-icon> Metode Pembayaran
        </h3>
        <button onclick="openPMModal()" class="w-9 h-9 bg-pink-500 text-white rounded-xl shadow-lg shadow-pink-100 hover:scale-105 active:scale-95 transition-all flex items-center justify-center">
            <ion-icon name="add-outline" class="text-xl"></ion-icon>
        </button>
    </div>

    <!-- Modal Form -->
    <div id="pmModal" class="fixed inset-0 z-[60] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-pink-100/20 backdrop-blur-sm" onclick="closePMModal()"></div>
        <div class="glass-card w-full max-w-lg p-6 rounded-[2rem] relative animate__animated animate__zoomIn animate__faster">
            <h4 id="pmModalTitle" class="font-black text-lg mb-4 text-gray-800 flex items-center gap-2">
                <ion-icon name="add-circle-outline" class="text-pink-500"></ion-icon> Edit Metode
            </h4>
            <form action="<?= base_url('admin/pm_save') ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="id" id="pm_id">
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Nama Metode</label>
                        <input type="text" name="name" id="pm_name" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none" required>
                    </div>
                    <div>
                        <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Tipe</label>
                        <input type="text" name="type" id="pm_type" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Logo (Modern Upload)</label>
                        <label class="relative group cursor-pointer block">
                            <div class="glass-input flex items-center gap-2 px-3 py-2 rounded-xl transition-all hover:bg-white/40 border border-white/50">
                                <div id="pm_logo_preview" class="w-8 h-8 rounded-lg bg-white border border-pink-100 p-1 flex items-center justify-center overflow-hidden">
                                    <ion-icon name="image-outline" class="text-gray-300 text-lg"></ion-icon>
                                </div>
                                <div class="flex-1 overflow-hidden">
                                    <p class="text-[9px] font-black text-gray-700 truncate">Pilih Logo</p>
                                </div>
                            </div>
                            <input type="file" name="logo" id="pm_logo_input" class="hidden" onchange="previewLogo(this)">
                        </label>
                    </div>
                    <div>
                        <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Latar (Hex)</label>
                        <input type="text" name="bg_color" id="pm_bg" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Fee (%)</label>
                        <input type="number" step="0.01" name="fee_percent" id="pm_fee_percent" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none">
                    </div>
                    <div>
                        <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Fee Flat (Rp)</label>
                        <input type="number" name="fee_fixed" id="pm_fee_fixed" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none">
                    </div>
                </div>

                <div class="flex gap-2 pt-2">
                    <button type="button" onclick="closePMModal()" class="flex-1 bg-gray-400/10 text-gray-500 py-3 rounded-xl font-bold text-xs hover:bg-white transition-all">
                        Batal
                    </button>
                    <button type="submit" class="flex-[2] bg-pink-500 text-white py-3 rounded-xl font-black uppercase text-xs tracking-widest shadow-lg shadow-pink-100 hover:scale-105 active:scale-95 transition-all">
                        Simpan ✨
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
        <?php foreach($methods as $m): ?>
        <div class="glass-card p-3 rounded-xl border border-white/50 flex items-center justify-between group hover:bg-white/40 transition-all relative">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-white rounded-lg p-1.5 shadow-sm border border-pink-50 flex items-center justify-center translate-y-0 group-hover:-translate-y-1 transition-transform">
                    <img src="<?= $m['logo'] ?>" alt="<?= $m['name'] ?>" class="w-full h-full object-contain">
                </div>
                <div>
                    <p class="font-black text-gray-800 text-[10px] leading-tight mb-0.5 whitespace-nowrap overflow-hidden text-ellipsis max-w-[80px]"><?= $m['name'] ?></p>
                    <p class="text-[7px] text-pink-500 uppercase font-black tracking-widest"><?= $m['type'] ?></p>
                </div>
            </div>
            <div class="flex items-center">
                <button onclick="editPM(<?= htmlspecialchars(json_encode($m)) ?>)" class="p-1.5 text-pink-400 hover:text-pink-600 transition-all cursor-pointer" title="Edit">
                    <ion-icon name="create-outline"></ion-icon>
                </button>
                <a href="<?= base_url('admin/pm_delete/'.$m['id']) ?>" onclick="return confirm('Hapus metode ini?')" class="p-1.5 text-rose-400 hover:text-rose-600 transition-all" title="Hapus">
                    <ion-icon name="trash-outline"></ion-icon>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function openPMModal() {
        resetPMForm();
        document.getElementById('pmModalTitle').innerText = 'Tambah Metode';
        document.getElementById('pmModal').classList.remove('hidden');
    }
    function closePMModal() {
        document.getElementById('pmModal').classList.add('hidden');
    }
    function previewLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('pm_logo_preview').innerHTML = `<img src="${e.target.result}" class="w-full h-full object-contain">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function editPM(data) {
        document.getElementById('pm_id').value = data.id;
        document.getElementById('pm_name').value = data.name;
        document.getElementById('pm_type').value = data.type;
        document.getElementById('pm_bg').value = data.bg_color;
        document.getElementById('pm_fee_percent').value = data.fee_percent;
        document.getElementById('pm_fee_fixed').value = data.fee_fixed;
        document.getElementById('pm_logo_preview').innerHTML = `<img src="${data.logo}" class="w-full h-full object-contain">`;
        document.getElementById('pmModalTitle').innerText = 'Edit Metode';
        document.getElementById('pmModal').classList.remove('hidden');
    }
    function resetPMForm() {
        document.getElementById('pm_id').value = '';
        document.getElementById('pm_name').value = '';
        document.getElementById('pm_type').value = '';
        document.getElementById('pm_bg').value = '#ffffff';
        document.getElementById('pm_fee_percent').value = '0.00';
        document.getElementById('pm_fee_fixed').value = '0';
        document.getElementById('pm_logo_input').value = '';
        document.getElementById('pm_logo_preview').innerHTML = '<ion-icon name="image-outline" class="text-gray-300 text-lg"></ion-icon>';
    }
</script>

<?php echo $this->endSection(); ?>
