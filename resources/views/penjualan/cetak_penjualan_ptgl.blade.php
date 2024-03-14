<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Cetak Tabel</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      background-color: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
    }

    h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Hapus elemen non-essential saat mencetak */
    @media print {
      body {
        padding: 0;
      }

      .no-print {
        display: none;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div>
      <img
        src="{{ public_path('images/gpos_black.svg') }}"
        style="width: 25%; max-width: 250px"
      />
    </div>
    <h1>Laporan Penjualan Tanggal {{ $tanggal }}</h1>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Pelanggan</th>
          <th>Subtotal</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
         @foreach ($cetakPtgl as $item) 
        <tr>
           <td>{{ $loop->iteration }}</td>
          <td>{{ optional($item->member)->nama }}</td>
          <td>{{ $item->total_harga }}</td>
          <td>{{ $item->created_at->format('Y-m-d') }}</td> 
        </tr>
         @endforeach 
      </tbody>
    </table>
  </div>
  <script type="text/javascript">
    window.print();
  </script>
</body>

</html>