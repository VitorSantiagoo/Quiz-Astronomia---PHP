<!DOCTYPE html>
<html>
<head>
    <title>Quiz PHP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<div class="sistema2">
<body>
    <?php
    $perguntas_texto = array(
        "Quantos planetas tem o nosso sistema?" => "8",
        "Qual o maior planeta do nosso sistema?" => "jupiter",
        "Qual é o nome da galáxia em que vivemos?" => "via lactea"
    );

    $perguntas_seletor = array(
        "Quais planetas do Sistema Solar possuem anéis?" => array("resposta_correta" => "Júpiter Saturno, Urano e Netuno", "opcoes" => "Júpiter Saturno, Urano e Netuno_Urano e Netuno_Urano Netuno e Marte"),
        "Em qual tipo de eclipse a Lua fica entre o Sol e a Terra?" => array("resposta_correta" => "Eclipse Solar", "opcoes" => "Eclipse Lunar_Eclipse Solar"),
        "Como um buraco negro começa a se formar?" => array("resposta_correta" => "Quando uma estrela gigante se passa pelo processo de supernova", "opcoes" => "Quando uma estrela anã amarela morre_Quando uma estrela se choca com outra_Quando uma estrela gigante se passa pelo processo de supernova")
    );

    $pontuacao = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Processamento das respostas de texto
        foreach ($perguntas_texto as $pergunta => $resposta) {
            if (isset($_POST[strtolower(str_replace(" ", "_", $pergunta))])) {
                $resposta_usuario = strtolower(trim($_POST[strtolower(str_replace(" ", "_", $pergunta))]));
                if ($resposta_usuario == $resposta) {
                    $pontuacao++;
                }
            }
        }

        foreach ($perguntas_seletor as $pergunta => $info_resposta) {
            if (isset($_POST[strtolower(str_replace(" ", "_", $pergunta))])) {
                $resposta_usuario = strtolower(trim($_POST[strtolower(str_replace(" ", "_", $pergunta))]));
                $resposta_correta = strtolower($info_resposta['resposta_correta']);
                if ($resposta_usuario == $resposta_correta) {
                    $pontuacao++;
                }
            }
        }
        echo "<h2>Resultado do Quiz</h2>";
        echo "<p>Caro(a) " . $_POST["nome"] . ", você acertou " . $pontuacao . " de 6 perguntas.</p>";
        echo "<form action='' method='get'><button type='submit'>Tentar Novamente</button></form>";
    } else {
    ?>

    <h2>Quiz Astronomia</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="sistema">
        Nome: <input type="text" name="nome" required ><br><br>
        <?php
        
        foreach ($perguntas_texto as $pergunta => $resposta) {
            echo $pergunta . "<br>";
            echo "<input type='text' name='" . strtolower(str_replace(" ", "_", $pergunta)) . "' requiredq><br><br>";
        }

        foreach ($perguntas_seletor as $pergunta => $info_resposta) {
            echo $pergunta . "<br>";
            echo "<select name='" . strtolower(str_replace(" ", "_", $pergunta)) . "' required>";
            echo "<option value=''></option>";
            $opcoes = explode("_", $info_resposta['opcoes']);
            foreach ($opcoes as $opcao) {
                echo "<option value='" . $opcao . "'>" . ucfirst(str_replace("_", " ", $opcao)) . "</option>";
            }
            echo "</select><br><br>";
        }
        ?>
        </div>
        <input type="submit" value="Submit">
    </div>
    </form>
    <?php } ?>
</body>
</html>
