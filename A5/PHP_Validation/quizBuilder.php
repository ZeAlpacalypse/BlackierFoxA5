<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Validation Exercise</title>
    <style>
        body {
            font-size: 1.25rem;
            line-height: 1.4;
        }

        input,
        option,
        select {
            font-size: 1.25rem;
        }

        .inputControl {
            clear: left;
        }

        .label {
            width: 120px;
            float: left;
        }

        button {
            margin-left: 100px;
            margin-top: 20px;
            font-size: 1.25rem;
            width: 150px;
        }

        .error {
            color: red;
            font-family: monospace;
        }
    </style>
</head>

<body>
    <h1>Step 2 - Create the Question</h1>

    <?php
    session_start();

    $questionIDError = "";
    $titleError = "";
    $answerError = "";
    $choiceError = "";
    $pointsError = "";
    if (isset($_GET["numChoices"])) {
        $numChoices = $_GET["numChoices"];
        $_SESSION["numChoices"] = $numChoices;
    }

    $questionID = "";
    $title = "";
    $choices = [];
    $answer = "";
    $points = "";
    $choicesInput = buildChoicesHTML($_SESSION["numChoices"]);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $questionID = $_POST["questionID"];
        $title = $_POST["title"];
        $answer = $_POST["answer"];
        for ($i = 0; $i < $_SESSION["numChoices"]; $i++) {
            $choices[$i] = $_POST["choice" . $i];
        }
        $points = $_POST["points"];

        $questionIDError = checkQuestionID($questionID);
        $titleError = checkTitle($title);
        $choiceError = checkChoices($choices);
        $answerError = checkAnswer($answer, $choices);
        $pointsError = checkPoints($points);

        $errorsPresent = true;
        for ($i = 0; $i < count($choiceError); $i++) {
            if (!empty($choiceError[$i])) {
                $errorsPresent = false;
                break;
            }
        }


        //if all data are valid, go to results
        if (empty($questionIDError) && empty($titleError) && $errorsPresent && empty($answerError) && empty($pointsError)) {


            $_SESSION["questionID"] = $questionID;
            $_SESSION["title"] = $title;
            $_SESSION["choices"] = $choices;
            $_SESSION["answer"] = $answer;
            $_SESSION["points"] = $points;

            header("location: results.php");

        }


    }
    function checkQuestionID($value)
    {
        $res = "";
        $pattern = "/^QU-\d{3}$/";
        if (empty($value)) {
            $res = "Question ID cannot be empty!";
        } else if (!preg_match($pattern, $value)) {
            $res = "Please match format!";
        }

        return $res;
    }
    function checkTitle($value)
    {
        $res = "";
        if (empty($value)) {
            $res = "Title cannot be empty!";
        }
        return $res;
    }
    function checkAnswer($value, $arr)
    {
        $res = "";
        $match = false;
        if (empty($value)) {
            $res = "Answer cannot be empty!";
        }

        for ($i = 0; $i < count($arr); $i++) {
            if (strtolower($arr[$i]) == strtolower($value)) {
                $match = true;
                break;
            }

        }
        if (!$match) {
            $res = " Answer must match one of the choices!";
        }

        return $res;
    }

    function buildChoicesHTML($number)
    {
        $temp = [];
        for ($i = 0; $i < $number; $i++) {
            $temp[$i] = "<li><input name='choice" . $i . "'/></li>";
        }
        return $temp;
    }
    function checkPoints($value)
    {
        $res = "";
        $points = intval($value);
        if (empty($value)) {
            $res = "Points cannot be empty!";
        } elseif ($points < 0) {
            $res = "Points must be greater than 0!";
        }
        return $res;
    }
    function checkChoices($arr)
    {
        $temp = [];
        for ($i = 0; $i < count($arr); $i++) {
            if (empty($arr[$i])) {
                $temp[$i] = "Choice cannot be empty!";
            } else {
                $temp[$i] = "";
            }
        }
        return $temp;
    }
    ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="inputControl">
            <div class="label">Question ID</div>
            <input name="questionID" value="<?php echo $questionID ?>">
            <span class="error">
                <?php echo $questionIDError ?>
            </span>
        </div>
        <div class="inputControl">
            <div class="label">Title</div>
            <input name="title" value="<?php echo $title ?>">
            <span class="error">
                <?php echo $titleError ?>
            </span>
        </div>
        <div class="inputControl">
            <ol type="A">
                <?php for ($i = 0; $i < $_SESSION["numChoices"]; $i++) {
                    if (!empty($choiceError)) {
                        $error = $choiceError[$i];
                        $choicesInput[$i] .= '<span class="error">' . $error . '</span>';
                    }
                    echo $choicesInput[$i];
                } ?>
            </ol>
        </div>
        <div class="inputControl">
            <div class="label">Answer</div>
            <input name="answer" value="<?php echo $answer ?>">
            <span class="error">
                <?php echo $answerError ?>
            </span>
        </div>
        <div class="inputControl">
            <div class="label">Points</div>
            <input id="points" name="points" value="<?php echo $points ?>" />
            <span class="error">
                <?php echo $pointsError ?>
            </span>
        </div>

        <button type="submit">Done</button>

    </form>

</body>

</html>