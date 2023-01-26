<?php

$message = 'Vamos ver se você acerta o número secreto <br> Você tem 3 tentativas';
$answer = 'Boa sorte, jovem gafanhoto';
$attempts = 3;
$endGame = false;

if (isset($_POST["number"])) {
    $playedNumber = $_POST["number"];
    $randomNumber = $_POST["randomNumber"];

    if (empty($playedNumber)) {
        $message = "Você tem que digitar um número, burro";
        $answer = "Não seja estabanado, jovem gafanhoto";
        $attempts = $_POST["restAttempts"];

    } else {
        if ($playedNumber < $randomNumber) {
            $answer = 'Minha dica, o número secreto é maior';
            $attempts = $_POST["restAttempts"] - 1;
            $message = "Ixi, você errou :( <br> Você tem mais $attempts tentativas";
        } elseif ($playedNumber > $randomNumber) {
            $answer = 'Minha dica, o número secreto é menor';
            $attempts = $_POST["restAttempts"] - 1;
            $message = "Ixi, você errou :( <br> Você tem mais $attempts tentativas";
        } else {
            $answer = '';
            $message = "Parabéns jovem gafanhoto, Você acertou :) <br> O número realmente era o $randomNumber";
            $endGame = true;
        }
    }

    if ($attempts == 0) {
        $message = "Haha, você perdeu, o número secreto era o $randomNumber";
        $endGame = true;
    }

} else {
    $randomNumber = rand(0, 10);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentalista</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./img/favicon_io/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Smooch+Sans:wght@800&display=swap" rel="stylesheet">
</head>

<body>

    <div class="ballon-quote-1">
        <?php
            echo $message;
        ?>
    </div>

    <form class="container-game" method="POST" id="form-game">
        <h1>Mentalista</h1>
        <p>Adivinhe um número de 0 a 10</p>
        <input class="game-input" name="number" type="number" min="0" max="10">
        <button type="submit" form="form-game" <?php if ($endGame) echo "disabled" ?> class="game-button">Adivinhar</button>
        <input type="number" name="restAttempts" hidden value="<?php echo $attempts ?>">
        <input type="number" name="randomNumber" hidden value="<?php echo $randomNumber ?>">
    </form>

    <div class="ballon-quote-2">
        <?php
        if ($endGame) {
            echo "<form class='endGameQuestion' method='POST' id='form-endgame'>";
            echo "<p>Quer Jogar Denovo?</p>";
            echo "<button name='endGameAnswer' form='form-endgame' value='yes'>Sim</button>";
            echo "</form>";
        } else {
            echo $answer;
        }
        ?>
    </div>

</body>
</html>