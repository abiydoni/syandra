<?php echo $this->extend('admin/layout'); ?>

<?php echo $this->section('content'); ?>

<div class="glass-card p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] animate__animated animate__fadeInUp">
    <div class="mb-6">
        <h3 class="flex items-center gap-2 font-black text-lg mb-4 text-gray-800">
            <ion-icon name="person-outline" class="text-pink-500"></ion-icon> Profil Administrator
        </h3>
        
        <form action="<?= base_url('admin/profile_save') ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Modern Photo Upload -->
                <div class="space-y-2">
                    <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest px-2">Foto Profil (1:1)</label>
                    <label class="relative group cursor-pointer block">
                        <div class="glass-input flex items-center gap-3 px-4 py-2 rounded-xl transition-all hover:bg-white/50 border border-white/50">
                            <div class="w-10 h-10 rounded-lg overflow-hidden border border-pink-100 flex-shrink-0">
                                <img id="photo_preview" src="<?= $profile['photo'] ?? 'https://i.pravatar.cc/150' ?>" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="text-[10px] font-black text-gray-700">Pilih Foto Baru</p>
                                <p class="text-[8px] text-gray-400 uppercase">JPG, PNG (Max 2MB)</p>
                            </div>
                            <ion-icon name="cloud-upload-outline" class="text-lg text-pink-400 group-hover:scale-110 transition-transform"></ion-icon>
                        </div>
                        <input type="file" name="photo" class="hidden" onchange="previewImage(this, 'photo_preview')">
                    </label>
                </div>

                <!-- Modern Header Upload -->
                <div class="space-y-2">
                    <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest px-2">Banner Header</label>
                    <label class="relative group cursor-pointer block">
                        <div class="glass-input flex items-center gap-3 px-4 py-2 rounded-xl transition-all hover:bg-white/50 border border-white/50">
                            <div class="w-10 h-10 rounded-lg overflow-hidden border border-pink-100 flex-shrink-0">
                                <img id="header_preview" src="<?= $profile['header_image'] ?? '' ?>" class="w-full h-full object-cover bg-pink-50">
                            </div>
                            <div class="flex-1">
                                <p class="text-[10px] font-black text-gray-700">Pilih Banner</p>
                                <p class="text-[8px] text-gray-400 uppercase">Rasio 16:9 Disarankan</p>
                            </div>
                            <ion-icon name="image-outline" class="text-lg text-pink-400 group-hover:scale-110 transition-transform"></ion-icon>
                        </div>
                        <input type="file" name="header_image" class="hidden" onchange="previewImage(this, 'header_preview')">
                    </label>
                </div>

                <div>
                    <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Username</label>
                    <input type="text" name="username" value="<?= $profile['username'] ?? '' ?>" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none" required>
                </div>
                <div>
                    <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Nama Lengkap</label>
                    <input type="text" name="full_name" value="<?= $profile['full_name'] ?? '' ?>" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Bio Singkat</label>
                    <textarea name="bio" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none" rows="1"><?= $profile['bio'] ?? '' ?></textarea>
                </div>
                <div>
                    <label class="block font-black text-[9px] text-gray-400 uppercase tracking-widest mb-1.5 px-2">Greeting Message</label>
                    <input type="text" name="greeting_message" value="<?= $profile['greeting_message'] ?? '' ?>" class="glass-input w-full px-4 py-2.5 rounded-xl font-bold text-gray-700 text-xs outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                <div>
                    <label class="block font-black text-[8px] text-gray-400 uppercase tracking-widest mb-1 px-2">Instagram</label>
                    <input type="text" name="instagram" value="<?= $profile['instagram'] ?? '' ?>" class="glass-input w-full px-3 py-2 rounded-lg font-bold text-gray-700 text-[10px] outline-none">
                </div>
                <div>
                    <label class="block font-black text-[8px] text-gray-400 uppercase tracking-widest mb-1 px-2">TikTok</label>
                    <input type="text" name="tiktok" value="<?= $profile['tiktok'] ?? '' ?>" class="glass-input w-full px-3 py-2 rounded-lg font-bold text-gray-700 text-[10px] outline-none">
                </div>
                <div>
                    <label class="block font-black text-[8px] text-gray-400 uppercase tracking-widest mb-1 px-2">WhatsApp</label>
                    <input type="text" name="whatsapp" value="<?= $profile['whatsapp'] ?? '' ?>" class="glass-input w-full px-3 py-2 rounded-lg font-bold text-gray-700 text-[10px] outline-none">
                </div>
                <div>
                    <label class="block font-black text-[8px] text-gray-400 uppercase tracking-widest mb-1 px-2">Twitter</label>
                    <input type="text" name="twitter" value="<?= $profile['twitter'] ?? '' ?>" class="glass-input w-full px-3 py-2 rounded-lg font-bold text-gray-700 text-[10px] outline-none">
                </div>
                <div>
                    <label class="block font-black text-[8px] text-gray-400 uppercase tracking-widest mb-1 px-2">YouTube</label>
                    <input type="text" name="youtube" value="<?= $profile['youtube'] ?? '' ?>" class="glass-input w-full px-3 py-2 rounded-lg font-bold text-gray-700 text-[10px] outline-none">
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="bg-pink-500 text-white px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest shadow-lg shadow-pink-100 hover:scale-105 active:scale-95 transition-all flex items-center gap-2">
                    <ion-icon name="checkmark-circle" class="text-base"></ion-icon> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php echo $this->endSection(); ?>
