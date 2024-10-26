<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Harga Tiket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Kalkulator Harga Tiket</h2>
        <form method="POST" action="">
            <label for="ticketType">Jenis Tiket:</label>
            <select id="ticketType" name="ticketType" required>
                <option value="dewasa">Dewasa</option>
                <option value="anak">Anak</option>
            </select>

            <label for="ticketCount">Jumlah Tiket:</label>
            <input type="number" id="ticketCount" name="ticketCount" placeholder="Masukkan jumlah tiket" min="1" required>

            <label for="orderDay">Hari Pemesanan:</label>
            <select id="orderDay" name="orderDay" required>
                <option value="senin">Senin</option>
                <option value="selasa">Selasa</option>
                <option value="rabu">Rabu</option>
                <option value="kamis">Kamis</option>
                <option value="jumat">Jumat</option>
                <option value="sabtu">Sabtu</option>
                <option value="minggu">Minggu</option>
            </select>

            <button type="submit" name="calculate">Hitung Harga</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['calculate'])) {
            // Mendapatkan input dari form
            $ticketType = strtolower($_POST['ticketType']);
            $ticketCount = (int)$_POST['ticketCount'];
            $orderDay = strtolower($_POST['orderDay']);

            // Konstanta harga dan diskon
            $adultTicketPrice = 50000;
            $childTicketPrice = 30000;
            $weekendSurcharge = 10000;
            $discountThreshold = 150000;
            $discountRate = 0.10;

            // Menentukan harga dasar berdasarkan jenis tiket
            $ticketPrice = ($ticketType === 'dewasa') ? $adultTicketPrice : $childTicketPrice;

            // Menambahkan biaya tambahan akhir pekan jika hari adalah Sabtu atau Minggu
            if ($orderDay === 'sabtu' || $orderDay === 'minggu') {
                $ticketPrice += $weekendSurcharge;
            }

            // Menghitung total harga
            $totalPrice = $ticketPrice * $ticketCount;

            // Menerapkan diskon jika harga melebihi threshold
            if ($totalPrice > $discountThreshold) {
                $totalPrice -= $totalPrice * $discountRate;
            }

            // Menampilkan hasil
            echo "<div class='result'><h3>Total Harga Tiket:</h3><p>Rp" . number_format($totalPrice, 0, ',', '.') . "</p></div>";
        }
        ?>
    </div>
</body>
</html>
