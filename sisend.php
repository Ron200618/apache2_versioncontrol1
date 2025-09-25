<?php
$sisendid_fail = 'sisendid.txt';
$teade = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kasutaja_sisend = trim($_POST['sisend']);
    
    if (!empty($kasutaja_sisend)) {
        // Kontrolli, kas fail on kirjutatav
        if (is_writable($sisendid_fail) || (!file_exists($sisendid_fail) && is_writable(dirname($sisendid_fail)))) {
            // Lisab sisendi faili koos ajatempliga
            $rida = date('Y-m-d H:i:s') . " - " . htmlspecialchars($kasutaja_sisend) . "\n";
            file_put_contents($sisendid_fail, $rida, FILE_APPEND | LOCK_EX);
            $teade = "Sisend salvestati edukalt!";
        } else {
            $teade = "Viga: Faili $sisendid_fail ei saa kirjutada. Kontrolli serveri õigusi.";
        }
    } else {
        $teade = "Sisend ei tohi olla tühi.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sisendi salvestamine</title>
</head>
<body>
    <h1>Sisendi salvestamine faili</h1>
    <p style="color: green;"><?php echo $teade; ?></p>
    
    <form method="POST" action="sisend.php">
        <label for="sisend">Sisesta tekst:</label><br>
        <input type="text" id="sisend" name="sisend" required><br><br>
        <input type="submit" value="Salvesta">
    </form>

    <h2>Salvestatud sisendid:</h2>
    <pre><?php 
        if (file_exists($sisendid_fail)) {
            echo htmlspecialchars(file_get_contents($sisendid_fail));
        } else {
            echo "Faile $sisendid_fail ei leitud.";
        }
    ?></pre>
</body>
</html>
