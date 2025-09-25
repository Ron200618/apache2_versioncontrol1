<!-- /var/www/source/form.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['userinput'] ?? '';
    file_put_contents('sisendid.txt', $input . PHP_EOL, FILE_APPEND);
    echo "Sisend salvestatud!";
}
?>

<form method="POST">
    <input type="text" name="userinput" placeholder="Sisesta midagi">
    <button type="submit">Saada</button>
</form>
