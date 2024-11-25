<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <!-- Link CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Link CDN SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold text-center mb-6">Daftar Siswa</h1>

        <!-- Button to open the form (aligned to the left) -->
        <div class="text-left mb-4">
            <button id="addStudentButton" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Tambah Data</button>
        </div>

        <!-- Tabel Daftar Siswa -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left">NISN</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Jenis Kelamin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswakita as $siswa)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $siswa->nisn }}</td>
                            <td class="px-4 py-2">{{ $siswa->nama }}</td>
                            <td class="px-4 py-2">{{ $siswa->jenis_kelamin }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginasi -->
        <div class="mt-6 flex justify-center">
            {{ $siswakita->links() }}
        </div>

        <!-- Form Add Data (hidden by default) -->
        <div id="addStudentForm" class="fixed right-0 top-0 bg-white shadow-lg p-4 rounded-lg w-1/3 h-full hidden">
            <h2 class="text-xl font-semibold mb-4">Tambah Data Siswa</h2>
            <form id="studentForm" action="{{ route('siswa.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nisn" class="block text-gray-700">NISN</label>
                    <input type="text" id="nisn" name="nisn" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <p id="nisnError" class="text-red-500 text-sm hidden">NISN harus terdiri dari 10 angka.</p>
                </div>
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700">Nama</label>
                    <input type="text" id="nama" name="nama" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Pw</label>
                    <input type="text" id="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="jenis_kelamin" class="block text-gray-700">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg">Tambah Siswa</button>
                <button type="button" id="closeFormButton" class="px-4 py-2 bg-red-500 text-white rounded-lg mt-4">Tutup</button>
            </form>
        </div>
    </div>
    <script>
        // Open the form when the button is clicked
        document.getElementById('addStudentButton').onclick = function() {
            document.getElementById('addStudentForm').classList.remove('hidden');
        };
        // Close the form
        document.getElementById('closeFormButton').onclick = function() {
            document.getElementById('addStudentForm').classList.add('hidden');
        };
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
        // NISN Validation (on form submission)
        document.getElementById('studentForm').onsubmit = function(event) {
            let nisn = document.getElementById('nisn').value;
            let nisnError = document.getElementById('nisnError');

            if (nisn.length !== 10 || isNaN(nisn)) {
                event.preventDefault();
                nisnError.classList.remove('hidden');
            } else {
                nisnError.classList.add('hidden');
            }
        };
        // Optional: NISN validation while typing (instant feedback)
        document.getElementById('nisn').oninput = function() {
            let nisn = this.value;
            let nisnError = document.getElementById('nisnError');
            if (nisn.length !== 10 || isNaN(nisn)) {
                nisnError.classList.remove('hidden');
            } else {
                nisnError.classList.add('hidden');
            }
        };
    </script>
</body>
</html>
