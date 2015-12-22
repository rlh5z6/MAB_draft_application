


function openModal(aid, gender, age){
    $('#addToWishList').modal("show");
    // clear
    $("#aidModal").html("");
    $("#genderModal").html("");
    $("#ageModal").html("");
    
    // add info
    $("#aidModal").val(aid);
    $("#genderModal").val(gender);
    $("#ageModal").val(age);
    

}

function openAppModal(aid){
    $('#fullApp').modal("show");
    
    $("#aidAppModal").html("");
    
    $("#aidAppModal").val(aid);
    
    answers(aid);
    
} 


//function viewProfileModal(aid) {
//    $.ajax({
//        url: "ajax/applicantAnswers?applicationId="aid
//    }).done(function(results){
//        results = JSON.parse(results)
//    
//    });
//    
//}
//    

function updateModal(data) {
    var applicationNumDiv = $("#applicationNumDiv");
    var verifiedText = $('#verified');
    var addBtn = $('#addToWishList');
    
    // The application exists
    if (data == 1){
        applicationNumDiv.removeClass("has-success");
        applicationNumDiv.addClass("has-success");
        verifiedText.html("");
        addBtn.prop('disabled', false);
    }
    
    else {
        applicationNumDiv.removeClass("has-success");
        applicationNumDiv.addClass("has-error");
        verifiedText.html("Error: application number not valid!");
        addBtn.prop('disabled', true);
    }
}


function answers(applicationId){
        $.ajax({
            url: 'ajax/applicantAnswers?applicationId=' + applicationId
        }).done(function(results){
            results = JSON.parse(results);
            var outputString = "";
            for(var i = 0; i < results.length; i++){
                outputString = outputString + (i+1) + ": " + results[i].questionText + "\n\n";
                outputString = outputString + results[i].answer + "\n\n";
            }
            $("#answerAppModal1").html(outputString);
            //alert(outputString);
        });
    }


