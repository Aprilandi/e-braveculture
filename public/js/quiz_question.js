// creating an array and passing the number, questions, options, and answers
let questions = [];
function settingQues(dataQues){
    questions = [];
    let index = 1;
    let benar = "";
    Object.entries(dataQues).forEach(([key, value]) => {
        let jawab = [];
        Object.entries(value.answer).forEach(([key2, value2]) => {
            if(value2.benar !== 0){
                benar = value2.jawab;
            }
            jawab.push(value2.jawab);
        });
        let data = { numb: index, question: value.pertanyaan, answer: benar, options: jawab };
        questions.push(data);
        index++;
    });
    // console.log(questions);
}

// console.log(questions);

  // you can uncomment the below codes and make duplicate as more as you want to add question
  // but remember you need to give the numb value serialize like 1,2,3,5,6,7,8,9.....

  //   {
  //   numb: 6,
  //   question: "Your Question is Here",
  //   answer: "Correct answer of the question is here",
  //   options: [
  //     "Option 1",
  //     "option 2",
  //     "option 3",
  //     "option 4"
  //   ]
  // },
