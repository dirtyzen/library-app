function approveModalSetId(id){
    $('#approveResponse').html('');
    $('#leaseId').val(id);
}

function leaseApprove(e) {
    e.preventDefault();
    let $form = $('#approveForm');
    let $res = $('#approveResponse');
    $.post($form.attr('action'), $form.serialize(), function (res) {
        $res.html(res);
    });
}

function cancelModalSetId(id){
    $('#cancelResponse').html('');
    $('#cancelId').val(id);
}

function leaseCancel(e) {
    e.preventDefault();
    let $form = $('#cancelForm');
    let $res = $('#cancelResponse');
    $.post($form.attr('action'), $form.serialize(), function (res) {
        $res.html(res);
    });
}
