<!DOCTYPE html>
<html>
<head>
    <title>Todo Reminder</title>
</head>
<body>
    <p>Hai {{ $todo->penerima->nama }},</p>

    <p>Ingatlah untuk menyelesaikan tugas berikut:</p>
    <p>{{ $todo->pesan }}</p>

    <p>Deadline: {{ $todo->deadline }}</p>

    <p>Salam,<br>
       Tim Pengingat</p>
</body>
</html>
