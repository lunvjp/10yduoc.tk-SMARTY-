var idSum;
var countDownDate;

// Update the count down every 1 second
var x = setInterval(function() {
    if (countDownDate) {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        $("#time").html(minutes+":"+seconds);

        if (distance < 0) {
            // clearInterval(x);
            document.getElementById("time").innerHTML = "HẾT GIỜ";
            $("#choiceuser").empty().removeClass('auto-padding');
            setTimeout(function(){
                window.location = '.';
            },1000);
        }
    }
}, 1000);

function doMoreQuestion(id) {
    idSum = id;
    $("#choiceuser-container").css('width','80%');
    $("#choiceuser").empty().removeClass('auto-padding');
    $("#ajax-load").css('display','block');
    $("#time").css('display','none');
    $("#facebook").hide();
    // $("#choiceuser").;
    $.ajax({
        url: 'check.php',
        type: 'POST',
        data: {
            id: id,
            action: 'dotest'
        },
        success: function(data) {
            $("#ajax-load").css('display','none');
            $("#choiceuser").html(data);
        },
        error: function () {
            $("#choiceuser").html("FAIL");
        }
    });
}

function seeResult(id) { // id = testid
    idSum = id;
    $("#choiceuser-container").css('width','40%');
    $("#choiceuser").empty().removeClass('auto-padding');
    $("#ajax-load").css('display','block');
    $("#time").css('display','none');
    $.ajax({
        url: "check.php",
        type: 'POST',
        data: {
            id: id,
            type: 'done'
        },success: function(data) {
            $("#ajax-load").css('display','none');
            $("#choiceuser").html(data);
        },
        error: function () {
            $("#choiceuser").html("FAIL");
        }
    });
    $.ajax({
        url: 'check.php',
        type: 'POST',
        data: {
            id: id,
            type: 'facebook'
        },success: function (data) {
            $("#facebook").html(data);
        },
        error: function () {
            $("#facebook").html("FAIL");
        }
    });
}

function getLink(id) { // id = testid
    idSum = id;
}

$(function(){
    if (!$("#account").html()) {
        location.reload(true);
    }

    $("#yes").click(function(){ // Bắt đầu làm 1 đề mới ở đây
        $("#choiceuser-container").css('width','80%');
        $("#choiceuser").empty().removeClass('auto-padding');
        $("#ajax-load").css('display','block');
        $("#facebook").hide();
        $.ajax({
            url: 'check.php',
            type: 'POST',
            data: {
                id: idSum,
                action: 'dotest'
            },
            success: function(data) {
                $("#ajax-load").css('display','none');
                $("#choiceuser").html(data);
            },
            error: function () {
                $("#choiceuser").html("FAIL");
            }
        });
        $.ajax({
            url: 'check.php',
            type: 'POST',
            data: {
                time: 'getTime'
            },
            success: function(data) {
                countDownDate = data;
                $("#time").css('display','block');
                $("#choiceuser").addClass('auto-padding');
            },
            error: function () {
                $("#choiceuser").html("FAIL");
            }
        });
    });

    $("#wrong-button").click(function () {
        $("#choiceuser-container").css('width','40%');
        $(".right").fadeOut("1400");
        $(".wrong").fadeIn("1400");
    });

    $("#right-button").click(function () {
        $("#choiceuser-container").css('width','40%');
        $(".wrong").fadeOut("1400");
        $(".right").fadeIn("1400");
    });

    $("#submit-button").click(function(){
        $("#form-do-test").submit();
    });

    $("#turnoffface-button").click(function(){
        $("#facebook").fadeToggle("slow");
    });


    $(document).on ("click", "input", function () {
        id = $(this).attr("class");
        temp = 'div#'+id;
//                x = 'input'+'.'+id;
        $(temp).css({'pointer-events':'none','background-color':'antiquewhite'});

//                setTimeout(function(){
//                    $(temp).hide();
//                },200);
    });
    // $("input").click(function(){
    //     id = $(this).attr("class");
    //     temp = 'div#'+id;
    //     x = 'input'+'.'+id;
    //
    //     setTimeout(function(){
    //         $(temp).hide();
    //     },200);
    // });
});
