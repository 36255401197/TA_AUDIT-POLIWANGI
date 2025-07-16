<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Lead Auditor</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="p-6">
    <!-- Judul -->
    <h1 class="text-2xl font-semibold mb-4">Dashboard Lead Auditor</h1>

    <!-- Daftar Audit -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
      <div class="flex justify-between items-center mb-4">
        <div>
          <label class="text-sm font-medium">Sortir:</label>
          <select class="border rounded px-2 py-1 text-sm">
            <option>Status</option>
            <option>Selesai</option>
            <option>Dalam Proses</option>
            <option>Belum Mulai</option>
          </select>

          <label class="ml-4 text-sm font-medium">Periode Audit:</label>
          <input type="date" class="border rounded px-2 py-1 text-sm" />
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          + Buat Audit Baru
        </button>
      </div>

      <table class="w-full text-sm border-collapse">
        <thead>
          <tr class="bg-gray-100 text-left">
            <th class="p-2 border">No</th>
            <th class="p-2 border">Nama Audit</th>
            <th class="p-2 border">Unit</th>
            <th class="p-2 border">Status</th>
            <th class="p-2 border">Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="p-2 border">1</td>
            <td class="p-2 border">Audit Keuangan 2023</td>
            <td class="p-2 border">Finance</td>
            <td class="p-2 border"><span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">Selesai</span></td>
            <td class="p-2 border">01/01/2023</td>
          </tr>
          <tr>
            <td class="p-2 border">2</td>
            <td class="p-2 border">Audit Operasional 2023</td>
            <td class="p-2 border">Operations</td>
            <td class="p-2 border"><span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-xs">Dalam Proses</span></td>
            <td class="p-2 border">15/02/2023</td>
          </tr>
          <tr>
            <td class="p-2 border">3</td>
            <td class="p-2 border">Audit IT 2023</td>
            <td class="p-2 border">IT</td>
            <td class="p-2 border"><span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs">Belum Mulai</span></td>
            <td class="p-2 border">01/03/2023</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Daftar Auditee -->
    <div class="bg-white rounded-lg shadow p-4">
      <h2 class="text-lg font-medium mb-4">Daftar Auditee</h2>
      <table class="w-full text-sm border-collapse">
        <thead>
          <tr class="bg-gray-100 text-left">
            <th class="p-2 border">No</th>
            <th class="p-2 border">Nama Auditee</th>
            <th class="p-2 border">Unit</th>
            <th class="p-2 border">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="p-2 border">1</td>
            <td class="p-2 border">John Doe</td>
            <td class="p-2 border">Finance</td>
            <td class="p-2 border"><span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">Selesai</span></td>
          </tr>
          <tr>
            <td class="p-2 border">2</td>
            <td class="p-2 border">Jane Smith</td>
            <td class="p-2 border">Operations</td>
            <td class="p-2 border"><span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-xs">Dalam Proses</span></td>
          </tr>
          <tr>
            <td class="p-2 border">3</td>
            <td class="p-2 border">Michael Johnson</td>
            <td class="p-2 border">IT</td>
            <td class="p-2 border"><span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs">Belum Mulai</span></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

</body>
</html>
