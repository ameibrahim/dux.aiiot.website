// Weight Assignments

let weeklyEvaluationInput = document.querySelector("#weekly-evaluation");
let midtermExamEvaluationInput = document.querySelector("#midterm-exam");
let finalExamEvaluationInput = document.querySelector("#final-exam");

let weeklyEvaluationTotalElement = document.querySelector("#weekly-evaluation-total");
let midtermEvaluationTotalElement = document.querySelector("#midterm-evaluation-total");
let finalEvaluationTotalElement = document.querySelector("#final-evaluation-total");
let totalEvaluationTotalElement = document.querySelector("#total-evaluation-total");

weeklyEvaluationInput.value = 0;
midtermExamEvaluationInput.value = 0;
finalExamEvaluationInput.value = 0;

weeklyEvaluationTotalElement.textContent = 0;
midtermEvaluationTotalElement.textContent = 0; 
finalEvaluationTotalElement.textContent = 0; 
totalEvaluationTotalElement.textContent = 0; 

let weeklyEvaluationValue = 0
let midtermExamEvaluationValue = 0
let finalExamEvaluationValue = 0
let weeklyEvaluationTotalValue = 0

function checkWeightAssignments() {

    let total = 
    Number(weeklyEvaluationTotalValue) + 
    Number(midtermExamEvaluationValue) + 
    Number(finalExamEvaluationValue) ;

    // console.log("total: ", total);

    if(total == 100) return true
    return false;
}

function calculateWeightAssingments(options = "") {

    let remainingPercent;

    switch(options){
        case "weekly":
            calculateMidTermAndFinal();
            break;
        case "midterm":
            calculateWeeklyAndFinal();
            break;
        case "final":
            calculateWeeklyAndMidterm();
            break;
    }

    function calculateMidTermAndFinal(){
        weeklyEvaluationValue = weeklyEvaluationInput.value

        if(weeklyEvaluationValue >= 0 && weeklyEvaluationValue <= 8){
            weeklyEvaluationTotalValue = weeklyEvaluationValue * 12;
            remainingPercent = 100 - weeklyEvaluationTotalValue;
    
            midtermExamEvaluationValue = Math.floor(remainingPercent * 0.3);
    
            finalExamEvaluationValue = remainingPercent - midtermExamEvaluationValue;
            midtermExamEvaluationInput.value = midtermExamEvaluationValue;
            finalExamEvaluationInput.value = finalExamEvaluationValue;
        }
        else{
            weeklyEvaluationValue = Math.floor(Number(weeklyEvaluationTotalElement.textContent) / 12);
            weeklyEvaluationInput.value = weeklyEvaluationValue;
        }
    }

    function calculateWeeklyAndFinal(){

        midtermExamEvaluationValue = midtermExamEvaluationInput.value;

        if(midtermExamEvaluationValue >= 0  && midtermExamEvaluationValue <= 100 ){
            remainingPercent = 100 - midtermExamEvaluationValue;
    
            let [ weekly, remaining ] = suggestRemainingOptionsFrom(remainingPercent);
    
            finalExamEvaluationValue = remaining;
            weeklyEvaluationValue = weekly;
            weeklyEvaluationTotalValue = weeklyEvaluationValue * 12;
    
            finalExamEvaluationInput.value = finalExamEvaluationValue;
            weeklyEvaluationInput.value = weeklyEvaluationValue;
        }
        else{
            midtermExamEvaluationValue = Number(midtermEvaluationTotalElement.textContent)
            midtermExamEvaluationInput.value = midtermExamEvaluationValue;
        }
    }

    function calculateWeeklyAndMidterm(){
        finalExamEvaluationValue = finalExamEvaluationInput.value;
        
        if(finalExamEvaluationValue >= 0  && finalExamEvaluationValue <= 100 ){
            remainingPercent = 100 - finalExamEvaluationValue;

            let [ weekly, remaining ] = suggestRemainingOptionsFrom(remainingPercent);

            midtermExamEvaluationValue = remaining;
            weeklyEvaluationValue = weekly;
            weeklyEvaluationTotalValue = weeklyEvaluationValue * 12;

            midtermExamEvaluationInput.value = midtermExamEvaluationValue;
            weeklyEvaluationInput.value = weeklyEvaluationValue;
        }
        else{
            finalExamEvaluationValue = Number(finalEvaluationTotalElement.textContent);
            finalExamEvaluationInput.value = finalExamEvaluationValue;
        }
    }

    function suggestRemainingOptionsFrom(percent){

        switch(true){
            case (percent >= 0 && percent <= 12):
                return [0, percent]
            case (percent >= 13 && percent <= 49):
                return [1, percent - 12]
            case (percent >= 50 && percent <= 79):
                return [2, percent - 24]
            case (percent >= 80 && percent <= 100):
                return [3, percent - 36]
        }
    }

    weeklyEvaluationTotalElement.textContent = weeklyEvaluationTotalValue;
    midtermEvaluationTotalElement.textContent = midtermExamEvaluationValue;
    finalEvaluationTotalElement.textContent = finalExamEvaluationValue;

    

    totalEvaluationTotalElement.textContent = Number(weeklyEvaluationTotalValue) + 
    Number(midtermExamEvaluationValue) + Number(finalExamEvaluationValue) ;

}

weeklyEvaluationInput.addEventListener("input", () => calculateWeightAssingments("weekly"));
midtermExamEvaluationInput.addEventListener("input", () => calculateWeightAssingments("midterm"));
finalExamEvaluationInput.addEventListener("input", () => calculateWeightAssingments("final"));