$(document).ready(function(){


    const $form =  $(".theform");


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

    function longestSentenceOfText(text){
        var max = 0;
        var start = 0;
        var end = 0;
        for(i = 0; i < text.length; i++){
            if(text.charAt(i) === "\n"){
                if(max < end - start) {
                    max = end - start;
                }
                start = end;
            }

            end++;
        }
        if(max < end - start) {
            max = end - start;
        }

        console.log(max);
        return max;
    }

    function numberOfSentencesOfText(text){
        var num = 0;
        for(i = 0; i < text.length; i++) {
            if (text.charAt(i) === "\n") {
                num++;
            }
        }
        console.log(num);
        return num;
    }




    $("#file").on("change", function(event) {

        var file = event.target.files[0];
        //if(file) {
            var reader = new FileReader();

            reader.readAsText(file);

            reader.onload = function (e) {
                var contents = e.target.result;
                contents.split("\n").filter(/./.test, /\@/).join("\n");
                //htmlstring = contents.replace(/(\r\n|\n|\r)/gm, "<br>").replace(" ", "  ");
                newWidth = longestSentenceOfText(contents)*10;
                newHeight = numberOfSentencesOfText(contents)*25;

                $('.outputfilecontent').html(contents)
                    .width(newWidth)
                    .height(newHeight);


            };



    });

    // $("#taskid").change(function() {
    //     //alert( "Handler for .change() taskid called." );
    // });


    $form.on("submit", function(event){

        event.preventDefault();

        $.ajax({
            url: "public/file/upload",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                $(".programOutput").html(data);
            },
            error: function(){}
        });

    });


});

//var request;


// if (request) {
//     request.abort();
// }

//
// const $taskid = $("#taskid").val();
// const $description = $("#description").val();
// const $title = $("#title").val();
// var file_data = $('#file').prop('files')[0];
//
// var form_data = new FormData();
// form_data.append('file', file_data);
//
//
//
//
//  $(".hello").text("a").show();
// var data = $form.serialize();
// //$(".hello").text(data).show();
//
// $.ajax({
//     type: "POST",
//     url: 'public/file/upload',
//     data: data,
//     data: data,
//     cache: false,
//     processData: false, // Don't process the files
//     contentType: false,
//     success: function (data) {
//         $( ".hello" ).text("TAKKKK!") ;
//         $( ".hello" ).append(data) ;
//
//     },
//     error: function (xhr, ajaxOptions, thrownError) {
//         $( ".hello" ).text("NIEEEEEEEEEE!") ;
//         alert(xhr.status);
//         alert(thrownError);
//     }
// });

//
//
// $.ajax({
//     type: "POST",
//     url: 'public/task/check',
//     data: data,
//     success: function (data) {
//         $( ".hello" ).text("TAKKKK!") ;
//        $( ".hello" ).append(data) ;
//
//     },
//     error: function (xhr, ajaxOptions, thrownError) {
//         $( ".hello" ).text("NIEEEEEEEEEE!") ;
//         alert(xhr.status);
//         alert(thrownError);
//     }
// });

//return false;


//Debian based: ln -s libodbcinst.so.1 /usr/lib/x86_64-linux-gnu/libodbcinst.so.2 ln -s libodbcinst.so.1 /usr/lib/i386-linux-gnu/libodbcinst.so.2