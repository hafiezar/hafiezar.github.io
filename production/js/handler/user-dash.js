$(function(){
    const bindKTM = (user) => {
        if(!user.is_mahasiswa){
            $("#unggah-ktm").hide();
        }
    }
    const bindData = (user) => {
        $("#foto-profil").html(`${PROD_API}/${user.foto}`);
        $("#nama-user").html(user.nama);
        $("#email-user").html(user.email);
        $("#instansi-user").html(user.instansi);
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
            url: `${PROD_API}/edit/profile`,
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
        let data = new FormData();
        data.append('file_ktm', $('#form-ktm [name="file_ktm"]')[0].files[0]);
        $.ajax({
            url: `${PROD_API}/upload/ktm`,
            method: 'POST',
            data,
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            processData: false,
            contentType: 'multipart/form-data', 
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