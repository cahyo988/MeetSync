<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Reminder</title>
</head>
<body>
    <p>Hai,</p>
    <p>Ini adalah pengingat untuk rapat yang akan datang:</p>
    <p>Judul Rapat: {{ $agenda->judul_rapat }}</p>
    <p>Tanggal Rapat: {{ $agenda->tanggal_rapat }}</p>

    <p>Terima kasih,</p>
    <p>Tim Pengingat Rapat</p>
</body>
</html>
