<x-layout>
    <x-slot:title>Laporan Sistem-Bertani.com</x-slot:title>

    <div id="tab1" class="tab-content border border-black rounded-md w-full h-auto mt-20">
        <form id="laporanForm" enctype="multipart/form-data" class="p-8 w-full h-auto" action="/laporan/sistem-create" method="post">
            @csrf
            <p class="text-2xl font-bold mb-4">Laporan Sistem</p>

            <div class="mb-4">
                <label for="message" class="block text-xl font-normal mb-2">Deskripsi Laporan</label>
                <textarea name="content_of_report" id="message" rows="3" placeholder="Ketik kendala yang Anda alami pada sistem" class="w-full h-48 p-2 mt-1 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" required></textarea>
            </div>

            <p class="text-xl font-bold mb-2">Foto Bukti Laporan</p>

            <div class="mb-2">
                <input type="file" name="image" id="uploadImage" accept="image/*" class="mt-1 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-700 
                file:text-white hover:file:bg-blue-500 active:scale-95" required>
            </div>
            @error('image')
                {{ $message }}
            @enderror

            <p class="block text-base font-normal mb-2">Saya dengan ini menyatakan bahwa segala informasi yang dilaporkan memang benar</p>

            <div class="flex justify-end space-x-4">
                <button type="button" id="cancelButton" class="inline-flex gap-x-2 px-4 py-2 bg-white rounded-lg border border-black shadow hover:shadow-md transition-shadow hover:bg-orange-300">
                    <img src="/img/laporanbatal.png" alt="icon_batal" class="w-5 h-5">Batal
                </button>
                <button id="laporkan" type="submit" class="inline-flex gap-x-2 px-4 py-2 bg-white-300 rounded-lg border border-black shadow hover:shadow-md transition-shadow hover:bg-orange-300">
                    <img src="/img/laporanlaporkan.png" alt="icon_laporkan" class="w-5 h-5">Laporkan
                </button>
            </div>
        </form>
    </div>

    @if (session('success'))
        <div id="successMessage"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 h-screen w-screen">
            <x-Message-success message="{{ session('success') }}">
                Tanggapan Laporan dikirim melalui Email. Cek balasan Admin secara berkala. Terimakasih
                <button onclick="closeMessage('successMessage')"
                    class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                    <ion-icon name="close-circle-outline" class="text-2xl"></ion-icon>
                </button>
            </x-Message-success>
        </div>
    @endif

    <script>
        const cancelButton = document.getElementById('cancelButton');
        const form = document.getElementById('laporanForm');

        cancelButton.addEventListener('click', () => {
            if (form) {
                form.reset(); // Menghapus semua input yang terisi
            }
        });

        function closeMessage(elementId) {
            const messageElement = document.getElementById(elementId);
            if (messageElement) {
                messageElement.style.display = 'none';
                document.body.style.overflow = ''; // Aktifkan scroll
            }
        }

        window.onload = function () {
            const messageElement = document.getElementById('successMessage');
            if (messageElement) {
                document.body.style.overflow = 'hidden'; // Kunci scroll
                setTimeout(() => {
                    closeMessage('successMessage');
                }, 3000); // 5000 ms = 5 detik
            }
        };
    </script>
</x-layout>
