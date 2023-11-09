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
    $numChoices = $_GET["numChoices"];

    $questionID = "";
    $title = "";
    $choices = [];
    $answer = "";
    $points = "";
    $choices = buildChoices($numChoices);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $questionID = $_POST["questionID"];
        $title = $_POST["title"];
        $answer = $_POST["answer"];
        $numChoices = $_POST["numChoices"];

        $questionIDError = checkQuestionID($questionID);
        $titleError = checkTitle($title);
        $answerError = checkAnswer($answer);
        //$choiceError = checkChoices($choices);
    
        //if all data are valid, go to results
        if (empty($questionIDError) && empty($titleError)) {


            $_SESSION["questionID"] = $questionID;
            $_SESSION["title"] = $title;

            header("location: results.php");

        }


    }
    function checkQuestionID($value)
    {
        $res = "";
        if (empty($value)) {
            $res = "Question ID cannot be empty";
        }
        return $res;
    }
    function checkTitle($value)
    {
        $res = "";
        if (empty($value)) {
            $res = "Title cannot be empty";
        }
        return $res;
    }
    function checkAnswer($value)
    {
        $res = "";
        if (empty($value)) {
            $res = "Answer cannot be empty";
        }

        return $res;
    }
    function buildChoices($number)
    {
        $temp = [];
        for ($i = 0; $i < $number; $i++) {
            $temp[$i] = "<li><input name='choice" . $i . "'/></li>";
        }
        return $temp;
    }
    function checkChoices($arr)
    {
        $temp = [];
        for ($i = 0; $i < count($arr); $i++) {
            if (empty($arr[$i])) {
                $temp[$i] = "Choice " . $i . " cannot be empty";
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
                <?php for ($i = 0; $i < $numChoices; $i++) {
                    echo $choices[$i];
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
            <input id="points" name="points" type="number" min="1" max="5" value="<?php echo $points ?>" />
        </div>
        <div> Number of choices
            <input id="numChoices" name="numChoices" type="number" value="<?php echo $numChoices ?>" disabled />
            <!--<?php echo $numChoices ?>-->
        </div>
        <button type="submit">Done</button>

    </form>

</body>

</html>