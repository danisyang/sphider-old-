function changeContent()
{
    var name=document.getElementById("username");
    var password=document.getElementById("password");
    var email=document.getElementById("email");
    var number=document.getElementById("number");
    var time=document.getElementById("time");
    var sex=document.getElementById("sex");
    var names=name.innerHTML;
    var passwords=password.innerHTML;
    var emails=email.innerHTML;
    var numbers=number.innerHTML;
    var times=time.innerHTML;
    var sexs=sex.innerHTML;

    name.innerHTML = "<input type='text' value='" + names + "'/>";
    password.innerHTML = "<input type='password' value='" + passwords + "'/>";
    email.innerHTML = "<input type='email' value='" + emails + "'/>";
    number.innerHTML = "<input type='tel' value='" + numbers + "'/>";
    time.innerHTML="<input type='datetime-localtime' value='" + times + "'/>";
    sex.innerHTML="<input type='radio' value='" + sexs + "' checked/>男 &nbsp&nbsp<input type='radio' value='\" + sex + \"' />女";
}
