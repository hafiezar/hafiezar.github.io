$(function(){
    $('#form-register').submit(function(e){
        e.preventDefault();
        $("#submit-registrasi").html('Loading...');
        $.ajax({
            url: `${DEV_API}/register`,
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                $("#submit-registrasi").html('Submit');
                notification('success', response.message)
                setTimeout(() => {
                    location.reload()
                }, 2000);
            }, error: function(err){
                $("#submit-registrasi").html('Submit');
                notification('error', err.responseJSON.message);
            }
        })
    })

    $('#form-login').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: `${DEV_API}/login`,
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                notification('success', response.message)
                localStorage.setItem(KEY, response.data.token);
                setTimeout(() => {
                    checkAuth('outside');
                }, 1000);
            }, error: function(err){
                notification('error', err.responseJSON.message);
            }
        })
    })

    $("#logout").click(function(e){
        e.preventDefault();
        $.ajax({
            url: `${DEV_API}/logout`,
            method: 'POST',
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            success: function(response){
                localStorage.removeItem(KEY);
                window.location = './login.html';
            }, error: function(err){
                notification('error', err.responseJSON.message);
            }
        })
    })
});