/**
 * Created by adam on 6/19/15.
 */
var successSign = "<span class='ui-icon ui-icon-check'></span>";
var failureSign = "<span class='ui-icon-close'></span>";

var prayerSuccessMessage ="Prayer successfully recorded! Thank you for your participation";

var prayerFailureMessage = "Prayer could not be recorded! Please try pressing the button again. If you " +
    "continue to receive this message, please contact the webmaster";

function painRatingsOnLoad(){
    resetFields();
    painRatingStyle();
    bindPainListeners();
}

function prayertaskOnLoad(){
    prayerTaskStyles();
    bindPrayerListeners();
}


function painRatingStyle() {
    $(".buttonify").buttonset();
    $(".prettyButton").button();
}

function prayerTaskStyles(){
    $("#prayerSubmit").button();
}

function bindPainListeners() {
    $(".painChecks").bind("click", function() {
        var toSend = processPainCheck(this);
        send(toSend, showPainCheckSuccess, showPainCheckFail);
    });
}

function bindPrayerListeners(){
    $("#prayerSubmit").bind("click", function(){
        window.console.log("prayer submit clicked");
        var toSend = processPrayer(this);
        send(toSend, showPrayerSuccess, showPrayerFail);
    });
}

function getUserHash(){
    return $("#userHash").val();
}

function getNonce(){
    return $("#nonce").val();
}

/**
 * Need to be sure that the browser hasn't cached
 * anything from before. So sets fields to default state.
 */
function resetFields(){
    $(".itemComplete").val("false");
    $('.buttonify input').removeAttr('checked');
}

// _______________________________ Handlers for pain ratings
/**
 * Checks whether all pain rating tasks are done. If so, calls onComplete
 */
function checkDone(){
    var todo = 0;
    if(todo === 0)
    {
        todo = Number($("#itemCount").val());
    }
    window.console.log('todo', todo);
    var complete = (function() {
        var done = 0;
        $(".itemComplete").each(function(){
           if($(this).val() === "true"){
               done += 1;
           }
        });
        return done;
    })();
    window.console.log('complete', complete);
    if(todo === complete){
        window.console.log('done');
        onComplete();
    }
}

/**
 * Call this when all the pain ratings are done
 */
function onComplete(){
    window.console.log("oncomplete called");
    $(".defaultMessage").slideUp();
    $(".startHidden").slideDown();
}

function processPainCheck(dthis) {
    var Send = {};
    Send.task = "recordPainRating";
    Send.itemId = $(dthis).data('itemid');
    Send.score = $(dthis).val();
    Send.userHash = getUserHash();
    Send.nonce = getNonce();
    window.console.log('paincheck', Send);
    return Send;
}

function showPainCheckSuccess(id){
    $("#itemComplete_" + id).val("true");
    var target = "#painCheckStatus_" + id;
    $(target).empty().append(successSign);
    checkDone();
}

function showPainCheckFail(id){
    var target = "#painCheckStatus_" + id;
    $(target).empty().append(failureSign);
}


//_________________________________ Handlers for prayer

function processPrayer(dthis){
    var Send = {};
    Send.task = "recordPrayer";
    Send.userHash = getUserHash();
    Send.nonce = getNonce();
    window.console.log("prayer submit", Send);
    return Send;
}

function showPrayerSuccess(){
$(".statusMessageArea").empty()
    .removeClass('failure')
    .addClass('success')
    .append(prayerSuccessMessage);
}

function showPrayerFail(){
    $(".statusMessageArea")
        .empty()
        .removeClass('success')
        .addClass('failure').append(prayerFailureMessage);
}

/**
 * Generic submission handler
 * @param toSend
 * @param successCallback
 * @param failureCallback
 */
function send(toSend, successCallback, failureCallback){
    $.post("api.php", toSend,  function(response){
       if(response && response.status){
           switch (response.status){
               case 'success':
                   successCallback(toSend.itemId);
                   break;
               case 'failure':
                   failureCallback(toSend.itemId);
                   break;
           }
       }
    },"JSON");
}