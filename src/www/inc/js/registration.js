/**
 * Created by adam on 6/29/15.
 */

function prettify(){
    $(".prettyButton").button();
    $("[name='userSex']").buttonset();
    $("#userSexRadio").buttonset();
}


function bindListeners(){
    $("#agreeButton").bind("click", function(){
        processAgree();
    });

    $("#cancelButton").bind("click", function(){
        processCancel();
    });
}

function processAgree(){
    window.console.log("agree pressed");
    var toSend = new UserInfo();
    window.console.log(toSend);
}

function processCancel(){
    window.console.log("cancel pressed");
}

/**
 * Object which will be sent
 * @constructor
 */
function UserInfo(){
    this.task = "register";
    this.nickname = $("#nickname").val();
    this.email = $("#email").val();
    this.age = $("#userAge :checked").val();
    this.race = $(".userRaceButton:checked").map(function() {
        return this.value;
    }).get();
    this.ethnicity = $(".userEthnicityButton:checked").map(function() {
        return this.value;
    }).get();

}


/**
 * Empties filled fields when user clicks cancel
 */
function clearEntries(){
    $(".clearable").val('');
}