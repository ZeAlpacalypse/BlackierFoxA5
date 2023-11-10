window.onload = function () {
  document.querySelector("#choices").addEventListener("change", buildQuestions);
  document.querySelector("form").addEventListener("submit", validateInputs);
};
function buildQuestions(e) {
  let numQuestions = document.querySelector("#choices");
  console.log(numQuestions);
  let numValue = numQuestions.value;
  let int = Number(numValue);
  let htmlString = "";
  for (let i = 1; i < int; i++) {
    htmlString += '<li class="label"></li>';
    htmlString +=
      ' <input type="text" required class="question" name="question' +
      i +
      '" id="question' +
      i +
      '"><br>';
  }
  let container = document.querySelector("#questions");
  console.log(htmlString);
  container.innerHTML += htmlString;
}
function validateInputs(e) {
  let choices = [];
  let answer = document.querySelector("input[name='answer']");
  let questions = document.querySelectorAll(".question");
  for (let i = 0; i < questions.length; i++) {
    choices.push(questions[i].value);
  }
  let bool = false;
  for (let j = 0; j < choices.length; j++) {
    if (choices[i] === answer.value) {
      bool = true;
      break;
    }
  }
  if (!bool) {
    answer.nextElementSibling.innerHTML = "Answer not included in the choices";
    e.preventDefault();
  }
}
