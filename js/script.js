function checkUsername(val){
    var check= /^[_a-z]+$/g;
    /*
    if(!check.test(val)){
        document.getElementById('checktext').innerHTML='only lower case latin letters and _ are allowed!';
        document.getElementById('checktext').style.color='red';
        document.getElementById('uname').value='';
    } else{
        document.getElementById('checktext').innerHTML='';

    }
    */
    if(!check.test(val)){
        $('#checktext').html('only lower case latin letters and _ are allowed!');
        $('#checktext').css('color', 'red');
    } else{
        $('#checktext').html('');
    }
}

function checkUser(val){
    $.ajax({
        url: 'duplicateUsers.php',
        method: 'POST',
        data: {
            'username': val
        },
        async: false
    }).done(function (data){
        var check= JSON.parse(data);
        if(check.success==true){
            $('#checkuser').html('This username is already taken!');
            $('#checkuser').css('color', 'red');
            $('#uname').val('');
        } else{
            $('#checkuser').html('Username Available!');
            $('#checkuser').css('color', 'lightgreen');
        }
    });
}