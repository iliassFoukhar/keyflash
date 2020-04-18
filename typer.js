window.addEventListener('load', init);

//DOM elements
var timerDisplay = document.getElementsByClassName("counter");
var wordsDisplay = document.getElementsByClassName("displays");
var inputField = document.getElementsByClassName("typingZone");
var wpmDisplay = document.getElementsByClassName("wpm");
var cpmDisplay = document.getElementsByClassName("cpm");
var errDisplay = document.getElementsByClassName("err");

var spans = document.getElementsByTagName("span");

var button = document.getElementsByClassName("buttonn");

var hiddens = document.getElementsByClassName("hiddens");
//GLOBAL variables
var isPlaying = false;
var timer = 60;
var cpm = 0;
var wpm = 0;
var err = 0;
//wordsVars
var wordsToShow = [];
var maxWords = 120;

//Initialize Game
function init(){
  button[0].disabled = true;
  inputField[0].disabled = false;
  inputField[0].focus();
  isPlaying = false;
  setInterval(countDown, 1000);
  wordsToShow = generateWords();
  showWords();
  setInterval(checky, 20);

}
//randomise words from the first array and make'em
function generateWords(){

  listyWords = [];
  var randomiser;
  for(i=0; i<maxWords; i++){
    randomiser = Math.floor(Math.random()*words.length);
    wordsToShow.push(words[randomiser]);
  }
  return wordsToShow;
}
//counting down the time
function countDown(){
  inputField[0].addEventListener('input', () => {
    isPlaying = true;
  });
  if(timer > 0 && isPlaying == true){
    timer--;
  }
  else if(timer <= 0 && isPlaying == true){
    timer = "Time's up !";
    isPlaying = false;
  }
  timerDisplay[1].innerHTML = timer;
}
//function that shows the words on screen
var quoty = "";
function showWords(){
  //quoty = "";
  for (i=0; i<wordsToShow.length - 10; i++){
    quoty += wordsToShow[i] + " ";
  }
  //to make them spans and to be able to change their colors
  var out = "";
  for(j=0; j<quoty.length;j++){
    var ch = quoty.charAt(j);
    out += "<span>" + ch + "</span>";
  }
  wordsDisplay[0].innerHTML = out;
}
//Function that verifies everything
function checky(){
  //Correct Words
  wpm = 0;
  var wordsWritten = inputField[0].value;
  var wordsToList = wordsWritten.split(" ");
  for(j = 0; j<wordsToList.length; j++){
    if(wordsToList[j] == wordsToShow[j]){
      wpm++;
    }
  }
  //Correct Characters
  cpm = 0;
  err = 0;
  for(j = 0; j<wordsToList.length; j++){
    for(i = 0; i <wordsToList[j].length;i++){
      if(wordsToList[j][i] == wordsToShow[j][i]){
        cpm++;
      }
      else{
        err++;
      }
    }
  }
  //Colored Characters
  for(i=0 ; i<quoty.length; i++){
    if(wordsWritten[i] == quoty[i]){
      spans[i+1].classList.add("correct");
      spans[i+1].classList.remove("incorrect");
      spans[i+1].classList.remove("quote");
    }
    else if(wordsWritten[i] != null && wordsWritten[i] != quoty[i]){
      spans[i+1].classList.remove("correct");
      spans[i+1].classList.add("incorrect");
      spans[i+1].classList.remove("quote");
    }
    else if(wordsWritten[i] == null){
      spans[i+1].classList.remove("correct");
      spans[i+1].classList.remove("incorrect");
      spans[i+1].classList.add("quote");
    }
  }
  //Well designed strings FOR WPM
  if(wpm >= 0 && wpm < 10)
    wpmDisplay[0].innerHTML ="00" + wpm.toString();
  else if(wpm >9 && wpm < 100)
    wpmDisplay[0].innerHTML ="0" + wpm.toString();
  else
    wpmDisplay[0].innerHTML =wpm.toString();
  //Well designed strings for CPM
  if(cpm >=0 && cpm <10)
    cpmDisplay[0].innerHTML= "00" + cpm.toString();
  else if(cpm > 9 && cpm < 100)
    cpmDisplay[0].innerHTML = "0" + cpm.toString();
  else
    cpmDisplay[0].innerHTML = cpm.toString();
  //Well designed strings for ERR
  if(err>=0 && err<10)
    errDisplay[0].innerHTML = "00" + err.toString();
  else if(err >9 && err <100)
    errDisplay[0].innerHTML = "0" + err.toString();
  else
    errDisplay[0].innerHTML = err.toString();

    //Make editing the value of the input constant !
    if(timer==0){
        inputField[0].disabled = true;
        button[0].disabled = false;
        hiddens[0].value = cpm;
        hiddens[1].value = wpm;
        hiddens[2].value = err;
    }
}
