tinymce.init({ selector:'textarea' });

//we are targeting input in the view_all_posts.php
// with id="selectAllBoxes" and when admin clicks on that checkbox
// it will check all boxes bellow (set true)
// and we are also targeting class of the other checkboxes

//we need to make sure that jQuery working:
$(document).ready(function() {

    $('#selectAllBoxes').click(function (event) {

        if (this.checked) {

            $('.checkBoxes').each(function () {

                this.checked = true;
            });
        } else {

            $('.checkBoxes').each(function () {

                this.checked = false;
            });
        }
    });
});

// loader jQuery
var divBox = "<div id='load-screen'><div id='loading'></div></div>";

$("body").prepend(divBox);

$('#load-screen').delay(700).fadeOut(600, function () {
    $(this).remove();
});
// we are targeting id load-screen div and delay it 700 seconds
// then we will fade it out in 600 milliseconds and at the end removing that div


// we make a function for sending ajax request
function loadUsersOnLine(){

    $.get("functions.php?onlineUsers=result", function (data) {

        $(".users-online").text(data); // we sent text in the container in admin_nav.php

    }); // this will send a get request to functions.php

}

setInterval(function () {

    loadUsersOnLine();

},500); // we calling that function every half second

loadUsersOnLine(); // we are calling the function


