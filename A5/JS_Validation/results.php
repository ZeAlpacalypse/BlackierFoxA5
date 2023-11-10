<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>results</title>
</head>

<body>
    <?php
    // class Question
    // {
    //     private $questionID;
    //     private $title;
    //     private $choices;
    //     private $answer;
    //     private $points;
    //     public function __construct($questionID, $title, $choices, $answer, $points)
    //     {
    //         $this->questionID = $questionID;
    //         $this->title = $title;
    //         $this->choices = $choices;
    //         $this->answer = $answer;
    //         $this->points = $points;
    
    //     }
    //     public function getQuestionID()
    //     {
    //         return $this->questionID;
    //     }
    //     public function getTitle()
    //     {
    //         return $this->title;
    //     }
    //     public function getChoices()
    //     {
    //         return $this->choices;
    //     }
    //     public function getAnswer()
    //     {
    //         return $this->answer;
    //     }
    //     public function getPoints()
    //     {
    //         return $this->points;
    //     }
    //     public function jsonSerialize()
    //     {
    //         return get_object_vars($this);
    //     }
    // }
    $id = $_POST["questionID"];
    $qTitle = $_POST["title"];
    $qAnswer = $_POST["answer"];
    $qpoints = $_POST["points"];
    $choiceAmt = $_POST["choices"];
    $qChoices = [];
    for ($i = 0; $i < intval($choiceAmt); $i++) {
        $choice = $_POST["question" . $i];
        array_push($qChoices, $choice);
    }
    $nRes = array("questionID" => $id, "title" => $qTitle, "choices" => $qChoices, "answer" => $qAnswer, "points" => $qpoints);
    // $result = new Question($id, $qTitle, $qChoices, $qAnswer, $qpoints);
    $jsonRes = json_encode($nRes);
    echo $jsonRes;
    ?>
</body>

</html>