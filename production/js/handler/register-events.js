$(function(){
    $("#register-jaringan").click(function(e){
        e.preventDefault();
        $.ajax({
            url: `${API}/event/register`,
            method: 'POST',
            data: { eventx_id: 1 },
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            success: function(res) {
                notification('success', res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function(err) {
                notification('error', err.responseJSON.message);
            }
        })
    });
    $("#register-web").click(function(e){
        e.preventDefault();
        $.ajax({
            url: `${API}/event/register`,
            method: 'POST',
            data: { eventx_id: 2 },
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            success: function(res) {
                notification('success', res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function(err) {
                notification('error', err.responseJSON.message);
            }
        })
    });
    $("#register-poster").click(function(e){
        e.preventDefault();
        $.ajax({
            url: `${API}/event/register`,
            method: 'POST',
            data: { eventx_id: 3 },
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            success: function(res) {
                notification('success', res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function(err) {
                notification('error', err.responseJSON.message);
            }
        })
    });
    $("#register-movie").click(function(e){
        e.preventDefault();
        $.ajax({
            url: `${API}/event/register`,
            method: 'POST',
            data: $("#form-register-movie").serialize(),
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            success: function(res) {
                notification('success', res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function(err) {
                notification('error', err.responseJSON.message);
            }
        })
    });
    $("#register-uiux").click(function(e){
        e.preventDefault();
        $.ajax({
            url: `${API}/event/register`,
            method: 'POST',
            data: { eventx_id: 7 },
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            success: function(res) {
                notification('success', res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function(err) {
                notification('error', err.responseJSON.message);
            }
        })
    });
    $("#register-seminar").click(function(e){
        e.preventDefault();
        $.ajax({
            url: `${API}/event/register`,
            method: 'POST',
            data: { eventx_id: 6 },
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            success: function(res) {
                notification('success', res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function(err) {
                notification('error', err.responseJSON.message);
            }
        })
    });
    $("#register-esports").click(function(e){
        e.preventDefault();
        $.ajax({
            url: `${API}/event/register`,
            method: 'POST',
            data: $("#form-register-esports").serialize(),
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            success: function(res) {
                notification('success', res.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, error: function(err) {
                notification('error', err.responseJSON.message);
            }
        })
    });
})