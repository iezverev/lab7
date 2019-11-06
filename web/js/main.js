function CheckIfRight(a,b,c) {
    $.ajax({
        url: 'http://lab7/web/site/test',
        data:{ans: a, que: b, usr: c},
        type: 'POST',
        success: function(data){
                    if (data[0]==true){
                        // alert(data[0]);
                        // console.log(data);
                        // console.log(data[1]);
                        document.getElementById("Test"+data[1]).className = "TestRight";
                        document.getElementById("Test"+data[1]).removeAttribute("onclick");
                        var OtherElements = document.getElementsByClassName("TestUnClick");
                        for (let i=0; i<OtherElements.length; i++) {
                            OtherElements[i].removeAttribute("onclick");
                        }
                    }else{
                        // alert(data[0]);
                        // console.log(data);
                        // console.log(data[1]);
                        document.getElementById("Test"+data[1]).className = "TestWrong";
                        document.getElementById("Test"+data[1]).removeAttribute("onclick");
                        var OtherElements = document.getElementsByClassName("TestUnClick");
                        for (let i=0; i<OtherElements.length; i++) {
                            OtherElements[i].removeAttribute("onclick");
                        }
                    }
        },
        error: function no (){
            alert("SOMETHING WENT WRONG!!!");
        }
    });
}