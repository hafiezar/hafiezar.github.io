const PROD_API = 'http://103.8.12.212:33722';
const DEV_API = 'http://localhost/hafiezar.github.io/service';
const API = 'http://localhost/hafiezar.github.io/service';
const KEY = 'cmluZHUgZG90YSAy';

const notification = (type, text) => {
    swal({
        type,
        title: type === 'success' ? 'Berhasil!' : 'Terjadi Kesalahan',
        text,
        showConfirmButton: true,
        timer: 2000
    })
}

const checkAuth = (scope) => {
    const key = localStorage.getItem(KEY);
    if(key && scope === 'outside'){
        window.location = './user-dash.html';
    }else if(!key && scope === 'inside'){
        window.location = './login.html';
    }
}

const getUser = () => {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${API}/users`,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            success: function(res) {
                resolve(res);
            }, error: function(err) {
                localStorage.removeItem(KEY);
                notification('error', 'User tidak ditemukan!');
                window.location = 'login.html';
                reject(err);
            }
        });
    });
}

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results) {
        return results[1];
    }
    return 0;
}

const formatRupiah = function(angka, prefix){
    // var number_string = angka.replace(/[^,\d]/g, '').toString(),
    var number_string = angka.toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

const checkNav = (scope) => {
    if (scope === 'outside'){
        $("#login-logout").html("Keluar");
        $("#login-logout").attr('href', '#');
    }
}