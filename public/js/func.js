$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

function leaseRequest(e) {
    e.preventDefault();
    let $form = $('#leaseRequestForm');
    let $res = $('#leaseRequestResponse');
    $.post($form.attr('action'), $form.serialize(), function (res) {
        $res.html(res);
    });
}

function leaseCancel(e) {
    e.preventDefault();
    let $form = $('#leaseCancelForm');
    let $res = $('#leaseCancelResponse');
    $.post($form.attr('action'), $form.serialize(), function (res) {
        $res.html(res);
    });
}
