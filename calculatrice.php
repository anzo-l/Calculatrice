<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Calculatrice</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            margin-top: 20px;
        }
        form {
            border: 2px solid black;
            padding: 10px;
            display: inline-block;
        }
        input, select {
            margin: 5px;
            padding: 5px;
        }
        button {
            background-color: blue;
            color: white;
            padding: 5px 10px;
        }
        .erreur {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Calculatrice</h1>
    <form method="post" action="">
        <input type="text" name="num1" placeholder="Premier nombre">
        <select name="operation">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="text" name="num2" placeholder="Deuxième nombre">
        <button type="submit">Calculer</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];

        $erreur = "";
        $resultat = "";

        if (!is_numeric($num1) || !is_numeric($num2)) {
            $erreur = "Erreur : Veuillez entrer uniquement des chiffres.";
        } else {
            $num1 = floatval($num1);
            $num2 = floatval($num2);

            switch ($operation) {
                case "+":
                    $resultat = $num1 + $num2;
                    break;
                case "-":
                    $resultat = $num1 - $num2;
                    break;
                case "*":
                    $resultat = $num1 * $num2;
                    break;
                case "/":
                    if ($num2 != 0) {
                        $resultat = $num1 / $num2;
                    } else {
                        $erreur = "Erreur : Division par zéro impossible.";
                    }
                    break;
                default:
                    $erreur = "Erreur : Opération non valide.";
            }
        }

        if ($erreur != "") {
            echo "<p class='erreur'>" . $erreur . "</p>";
        } else {
            echo "<p>Le résultat est : " . number_format($resultat, 2) . "</p>";
        }
    }
    ?>
</body>
</html>
