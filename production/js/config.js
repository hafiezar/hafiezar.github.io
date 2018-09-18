const PROD_API = 'http://103.8.12.212:33722';
const DEV_API = 'http://localhost/hafiezar.github.io/service';
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