<?php echo $this->extend('admin/layout'); ?>

<?php echo $this->section('content'); ?>

<div class="glass-card p-4 sm:p-5 rounded-[1.5rem] animate__animated animate__fadeIn">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h3 class="flex items-center gap-2 font-black text-lg text-gray-800">
            <ion-icon name="people" class="text-pink-500"></ion-icon> Kelola Pengguna
        </h3>
        <button onclick="addUser()" class="w-full sm:w-auto px-5 py-2.5 bg-pink-500 text-white rounded-xl font-bold text-xs uppercase tracking-widest shadow-lg shadow-pink-100 hover:scale-105 active:scale-95 transition-all flex items-center justify-center gap-2">
            <ion-icon name="add-circle" class="text-lg"></ion-icon> Tambah User
        </button>
    </div>

    <div class="no-scrollbar overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/30 text-[9px] font-black text-gray-400 uppercase tracking-widest">
                    <th class="py-2 px-2">Username</th>
                    <th class="py-2 px-2">Email</th>
                    <th class="py-2 px-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="font-bold text-[10px] text-gray-700">
                <?php foreach($users as $user): ?>
                <tr class="border-b border-white/10 hover:bg-white/20 transition-colors">
                    <td class="py-2 px-2"><?= $user['username'] ?></td>
                    <td class="py-2 px-2"><?= $user['email'] ?></td>
                    <td class="py-2 px-2 text-right">
                        <div class="flex justify-end gap-1">
                            <button onclick='editUser(<?= json_encode($user) ?>)' class="p-1.5 bg-blue-100 text-blue-600 rounded-md hover:bg-blue-200 transition-colors">
                                <ion-icon name="create-outline"></ion-icon>
                            </button>
                            <a href="<?= base_url('admin/user_delete/'.$user['id']) ?>" onclick="return confirm('Hapus user ini?')" class="p-1.5 bg-rose-100 text-rose-600 rounded-md hover:bg-rose-200 transition-colors">
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

<!-- Add/Edit User Modal -->
<div id="userModal" class="fixed inset-0 z-[150] hidden">
    <div class="absolute inset-0 bg-black/20 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] max-w-md animate__animated animate__zoomIn">
        <div class="glass-card p-6 rounded-[2rem] shadow-2xl border-white/50">
            <h3 id="modalTitle" class="text-lg font-black text-gray-800 mb-6 flex items-center gap-2">
                <ion-icon name="person-add" class="text-pink-500"></ion-icon> Tambah User
            </h3>
            <form action="<?= base_url('admin/user_save') ?>" method="POST" class="space-y-4">
                <input type="hidden" name="id" id="userId">
                
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Username</label>
                    <input type="text" name="username" id="userName" class="w-full bg-white/50 border border-white/50 rounded-xl px-4 py-2.5 text-xs font-bold focus:outline-none focus:border-pink-500 transition-all" required>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Email</label>
                    <input type="email" name="email" id="userEmail" class="w-full bg-white/50 border border-white/50 rounded-xl px-4 py-2.5 text-xs font-bold focus:outline-none focus:border-pink-500 transition-all" required>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" id="userPass" class="w-full bg-white/50 border border-white/50 rounded-xl px-4 py-2.5 text-xs font-bold focus:outline-none focus:border-pink-500 transition-all">
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal()" class="flex-1 px-4 py-3 bg-gray-100 text-gray-600 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-gray-200 transition-all">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-pink-500 text-white rounded-xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-pink-100 hover:scale-105 active:scale-95 transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function addUser() {
    document.getElementById('modalTitle').innerHTML = '<ion-icon name="person-add" class="text-pink-500"></ion-icon> Tambah User';
    document.getElementById('userId').value = '';
    document.getElementById('userName').value = '';
    document.getElementById('userEmail').value = '';
    document.getElementById('userPass').value = '';
    document.getElementById('userPass').required = true;
    document.getElementById('userModal').classList.remove('hidden');
}

function editUser(user) {
    document.getElementById('modalTitle').innerHTML = '<ion-icon name="create" class="text-pink-500"></ion-icon> Edit User';
    document.getElementById('userId').value = user.id;
    document.getElementById('userName').value = user.username;
    document.getElementById('userEmail').value = user.email;
    document.getElementById('userPass').value = '';
    document.getElementById('userPass').required = false;
    document.getElementById('userModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('userModal').classList.add('hidden');
}
</script>

<?php echo $this->endSection(); ?>
