<!DOCTYPE html>
<html>
<head>
    <title>Update Status Peminjaman</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333;">

    <h2>Halo, {{ $booking->user->name }}</h2>

    <p>Status pengajuan peminjaman laboratorium Anda telah diperbarui oleh Admin.</p>

    <div style="background: #f3f4f6; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 5px solid #3b82f6;">
        <p style="margin: 5px 0;"><strong>Laboratorium:</strong> {{ $booking->lab->nama_lab }}</p>
        <p style="margin: 5px 0;"><strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($booking->tanggal_pinjam)->translatedFormat('d F Y') }}</p>
        <p style="margin: 5px 0;"><strong>Jam:</strong> {{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</p>
        
        <p style="margin: 15px 0 5px 0;"><strong>Status Terbaru:</strong> 
            @if($booking->status == 'approved')
                <span style="color: green; font-weight: bold; font-size: 1.1em;">DISETUJUI (APPROVED) ✅</span>
            @elseif($booking->status == 'rejected')
                <span style="color: red; font-weight: bold; font-size: 1.1em;">DITOLAK (REJECTED) ❌</span>
            @endif
        </p>

        @if($booking->status == 'rejected' && $booking->catatan_penolakan)
            <p style="margin: 5px 0; color: #b91c1c;"><strong>Alasan Penolakan:</strong> {{ $booking->catatan_penolakan }}</p>
        @endif
    </div>

    @if($booking->status == 'approved')
        <p>Silakan login ke aplikasi untuk mencetak <strong>Surat Bukti Peminjaman</strong>.</p>
        <a href="{{ route('login') }}" style="background-color: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 10px;">Login Aplikasi</a>
    @else
        <p>Mohon maaf atas ketidaknyamanannya. Silakan ajukan kembali di waktu atau laboratorium lain.</p>
    @endif

    <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
    <p style="font-size: 0.8em; color: #888;">Email ini dikirim otomatis oleh Sistem Peminjaman Laboratorium.</p>

</body>
</html>