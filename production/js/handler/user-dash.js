$(function(){
    const bindKTM = (user) => {
        if(!user.is_mahasiswa){
            $("#unggah-ktm").hide();
        }
    }
    const bindData = (user) => {
        $("#nama-user").html(user.nama);
        $("#email-user").html(`${user.email} / ${user.kontak}`);
        $("#instansi-user").html(user.instansi);
        if(user.file_ktm){
            $("#image-ktm").attr('src', user.file_ktm);
        }
        if(user.foto){
            $("#foto-profil").attr('src', user.foto);
        }
    }
    const bindEditProfile = (user) => {
        $("#form-profil [name='nama']").val(user.nama);
        $("#form-profil [name='tanggal_lahir']").val(user.tanggal_lahir);
        $("#form-profil [name='kontak']").val(user.kontak);
        $("#form-profil [name='instansi']").val(user.instansi);
    }
    const bindProfile = async () => {
        const user = await getUser();
        bindKTM(user);
        bindData(user);
        bindEditProfile(user);
    }
    bindProfile()

    $("#form-profil").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: `${DEV_API}/edit/profile`,
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            success: function(res){
                notification('success', res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function(err){
                notification('error', err.responseJSON.message);
            }
        })
    })

    $("#form-ktm").submit(function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: `${DEV_API}/upload/ktm`,
            method: 'POST',
            data: formData,
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            processData: false,
            contentType: false, 
            success: function(res){
                notification('success', res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function(err){
                notification('error', err.responseJSON.message);
            }
        })
    })

    $("#form-foto").submit(function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: `${DEV_API}/upload/foto`,
            method: 'POST',
            data: formData,
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            processData: false,
            contentType: false, 
            success: function(res){
                notification('success', res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function(err){
                notification('error', err.responseJSON.message);
            }
        })
    })
})