<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>A5 - Validation - JS Version</title>
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
    <script src="validator.js" type="text/javascript"></script>
</head>

<body>
    <h1>Create a Question</h1>
    <form method="POST" action="results.php">
        <div class="inputControl">
            <div class="label">Question ID</div>
            <input type="text" name="questionID" id="questionID" pattern="^QU-\d{3}$" required>
        </div><br>
        <div class="inputControl">
            <div class="label">Title</div>
            <input type="text" name="title" id="title" required>
        </div><br>
        <div class="inputControl">
            <div class="label">Number of Choices</div>
            <select name="choices" id="choices">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </div><br>
        <div id="container">
            <div class="inputControl" id="questions">
                <ol type="a" id="questions">
                    <li class="label"></li>
                    <input type="text" required class="question" name="question0">
                </ol>
            </div>
        </div>
        <div class="inputControl">
            <div class="label">Answer</div>
            <input type="text" name="answer" id="answer" required>
        </div><br>
        <div class="inputControl">
            <div class="label">Points</div>
            <input type="numeric" name="points" id="points" required min=0>
        </div><br>
        <div class="inputControl">
            <div class="label"></div>
            <button type="submit">Submit</button>
        </div>
    </form>


</body>

</html>