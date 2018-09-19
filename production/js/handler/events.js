$(function(){
    const getEventsByUser = () => {
        return new Promise((resolve) => {
            $.ajax({
                url: `${API}/event/user`,
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer '+localStorage.getItem(KEY),
                },
                success: function(res) {
                    resolve(res);
                }
            })
        });
    };
    const checkStatus = (status, id) => {
        if(status === 'not_paid'){
            return `<span class="glyphicon glyphicon-remove"></span> Menunggu pembayaran<hr/>
            <a href='verifikasi.html?event_id=${id}' class="text-uppercase s-btn s-btn--sm s-btn--primary-bg g-radius--50 g-padding-x-50--xs konfirmasi" style="font-size: 12px;padding: 0.5rem 0.75rem">Unggah Bukti Pembayaran</a>`;
        }else if(status === 'wait_verified'){
            return '<span class="glyphicon glyphicon-time"></span> Menunggu verifikasi';
        }else if(status === 'paid'){
            return '<span class="glyphicon glyphicon-ok"></span> Pembayaran telah diverifikasi';
        }
    };
    const addToList = (event) => {
        let DOM = `<tr>
            <td class="text-center">
                <span style="font-weight: bold; font-size: 20px">${event.name}</span>
                <hr style="margin: 5px; padding: 0"/>
                <span style="font-size: 12px">Kode Pendaftaran:</span><br/>
                ${event.registration_code}
            </td>
            <td style="vertical-align: middle;">`;
        event.details.forEach((detail) => {
            DOM += `
                <span style="padding: 1.5px 0px;font-weight: bold; font-size: 16px">${detail.title}</span>
                <span style="padding: 1.5px 0px;display: block; font-size: 14px">${detail.description}</span><hr style="margin: 5px; padding: 0"/>`;
        });

        DOM += `
            </td>
            <td style="vertical-align: middle; text-align: center">
                ${checkStatus(event.payment_status, event.eventx_id)}
            </td>
        </tr>`;
        $('#userx-eventx').append(DOM);
    }
    const checkRegister = (events) => {
        if(events.length){
            $('#userx-eventx').html('');
        }
        events.forEach((event) => {
            let type = '';
            switch(event.eventx_id){
                case '1':
                    type = 'networking';
                    break;
                case '2':
                    type = 'web';
                    break;
                case '3':
                    type = 'poster';
                    break;
                case '4':
                    type = 'movie';
                    break;
                case '5':
                    type = 'esport';
                    break;
                case '6':
                    type = 'seminar';
                    break;
                case '7':
                    type = 'uiux';
                    break;
                case '8':
                    type = 'guru';
                    break;
            }
            $(`#reg-${type}`).parent().addClass('hide');

            addToList(event);
        });
    };
    const countSummary = (events) => {
        $("#kegiatan-user").html(events.length);

        const verifikasi = events.filter((event) => event.payment_status === 'wait_verified');
        $("#verifikasi").html(verifikasi.length);

        const verified = events.filter((event) => event.payment_status === 'paid');
        $("#verified").html(verified.length);
    };
    const bindEvents = async () => {
        const { data: events } = await getEventsByUser();
        checkRegister(events);
        countSummary(events);
        
        const eventId = $.urlParam('event_id');
        if(eventId){
            const event = events.filter((event) => event.eventx_id === eventId);
            if (event.length && !event[0].bukti_bayar) {
                $("#nama-event").html(event[0].name);
            } else {
                window.location = 'user-dash.html';
            }
        }
    }
    bindEvents();

    $("#form-bukti-bayar").submit(function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        formData.append('eventx_id', $.urlParam('event_id'));
        $.ajax({
            url: `${API}/upload/bukti-bayar`,
            method: 'POST',
            data: formData,
            headers: {
                'Authorization': 'Bearer '+localStorage.getItem(KEY),
            },
            processData: false,
            contentType: false, 
            success: function(res) {
                notification('success', res.message);
                setTimeout(() => {
                    window.location = 'user-dash.html';
                }, 1000);
            }, error: function(err) {
                notification('error', err.responseJSON.message);
            }
        })
    })
});