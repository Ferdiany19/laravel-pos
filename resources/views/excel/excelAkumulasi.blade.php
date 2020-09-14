<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th>Pemasukan</th>
            <th>Laba</th>
            <th>Belum Terjual</th>
            <th>Retur Pemasukan</th>
            <th>Retur Pengeluaran</th>
            <th>Pengeluaran</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pemasukan }}</td>
                <td>{{ $laba }}</td>
                <td>{{ $belum_terjual }}</td>
                <td>{{ $retur_pemasukan }}</td>
                <td>{{ $retur_pengeluaran }}</td>
                <td>{{ $pengeluaran }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>