<!DOCTYPE html>
<html>
<head>
    <title>Bukti Peminjaman Lab</title>
    <style>
        body { font-family: sans-serif; font-size: 12pt; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid black; padding-bottom: 10px; }
        .header h2 { margin: 0; }
        .header p { margin: 2px 0; font-size: 10pt; }
        .content { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table td { padding: 5px; vertical-align: top; }
        .label { width: 150px; font-weight: bold; }
        .status-box { 
            border: 2px solid #22c55e; 
            color: #22c55e; 
            padding: 10px; 
            text-align: center; 
            font-weight: bold; 
            margin: 20px 0;
            display: inline-block;
        }
        .footer { margin-top: 50px; text-align: right; }
        .ttd { height: 80px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>SURAT IZIN PENGGUNAAN LABORATORIUM</h2>
        <p>FAKULTAS TEKNIK - UNIVERSITAS TEKNOLOGI</p>
        <p>Jl. Contoh No. 123, Kota Coding, Indonesia</p>
    </div>

    <div class="content">
        <p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

    <table>
                <tr>
                    <td class="label">Nama Peminjam</td>
                    {{-- Pastikan tabel users kolomnya 'name'. Jika error, coba ganti 'username' --}}
                    <td>: {{ $booking->user->nama }}</td> 
                </tr>
                <tr>
                    <td class="label">Email</td>
                    <td>: {{ $booking->user->email }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Pengajuan</td>
                    <td>: {{ $booking->created_at->format('d F Y') }}</td>
                </tr>
            </table>

            <p>Telah disetujui untuk menggunakan fasilitas laboratorium dengan detail:</p>

            <table>
                <tr>
                    <td class="label">Laboratorium</td>
                    {{-- PERBAIKAN: Ganti 'name' menjadi 'nama_lab' --}}
                    <td>: <strong>{{ $booking->lab->nama_lab }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Keperluan</td>
                    <td>: {{ $booking->keperluan }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Pemakaian</td>
                    <td>: {{ \Carbon\Carbon::parse($booking->tanggal_pinjam)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Waktu</td>
                    <td>: {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                </tr>
            </table>

        <br>
        <div style="text-align: center;">
            <div class="status-box">
                STATUS: DISETUJUI (APPROVED)
            </div>
        </div>

        <p>Harap surat ini ditunjukkan kepada petugas laboratorium/dosen saat hendak menggunakan ruangan.</p>
    </div>

    <div class="footer">
        <p>Mengetahui,<br>Kepala Laboratorium</p>
        <div class="ttd">
            </div>
        <p><strong>( _______________________ )</strong></p>
    </div>

</body>
</html>