$(document).ready(function(){


    const $form =  $(".theloginform1");


    $form.on("submit", function(event){


        event.preventDefault();

        alert("hello");

        $.ajax({
            url: "check_login/check",
            type: "POST",
            data:  new FormData(this),
            success: function(data){
                $(".answer").html("abc");
            },
            error: function(){
                $(".answer").html("error");
            }
        });


    });


    // var openFile = function(event) {
    //     var input = event.target;
    //
    //     var reader = new FileReader();
    //     reader.onload = function(){
    //         var dataURL = reader.result;
    //         var output = document.getElementById('output');
    //         output.src = dataURL;
    //     };
    //     reader.readAsDataURL(input.files[0]);
    // };
    //
    // function longestSentenceOfText(text){
    //     var max = 0;
    //     var start = 0;
    //     var end = 0;
    //     for(i = 0; i < text.length; i++){
    //         if(text.charAt(i) === "\n"){
    //             if(max < end - start) {
    //                 max = end - start;
    //             }
    //             start = end;
    //         }
    //
    //         end++;
    //     }
    //     if(max < end - start) {
    //         max = end - start;
    //     }
    //
    //     console.log(max);
    //     return max;
    // }
    //
    // function numberOfSentencesOfText(text){
    //     var num = 0;
    //     for(i = 0; i < text.length; i++) {
    //         if (text.charAt(i) === "\n") {
    //             num++;
    //         }
    //     }
    //     console.log(num);
    //     return num;
    // }
    //
    //
    //
    //
    // $("#file").on("change", function(event) {
    //
    //     var file = event.target.files[0];
    //     //if(file) {
    //         var reader = new FileReader();
    //
    //         reader.readAsText(file);
    //
    //         reader.onload = function (e) {
    //             var contents = e.target.result;
    //             contents.split("\n").filter(/./.test, /\@/).join("\n");
    //             //htmlstring = contents.replace(/(\r\n|\n|\r)/gm, "<br>").replace(" ", "  ");
    //             newWidth = longestSentenceOfText(contents)*10;
    //             newHeight = numberOfSentencesOfText(contents)*25;
    //
    //             $('.outputfilecontent').html(contents)
    //                 .width(newWidth)
    //                 .height(newHeight);
    //
    //
    //         };
    //
    //
    //
    // });
    //
    // // $("#taskid").change(function() {
    // //     //alert( "Handler for .change() taskid called." );
    // // });




});
