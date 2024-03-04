function showModalBox(title = 'Title', updateBtn = 'Submit', data = '', btnId = '', modalSize = '', target = '#popUpModal') {
    var updateBtnHtml = (updateBtn == '') ? '' : `<div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button id="${btnId}" type="button" class="btn btn-primary">${updateBtn}</button>
                                                </div>`;

    var html =
        `<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ${modalSize}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">${title}</h5>
                        <button style="color:black" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">${data}</div>
                    ${updateBtnHtml}
                </div>
            </div>`;


    $(target).html(html);
}

function removeModal() {
    $('.modal-backdrop.fade.show').remove();
    $('#popUpModal').removeClass('show');
    $('#popUpModal').css('display', 'none');
}

function sweetAlert($msg, $type = 'success') {
    return Swal.fire({
        position: 'top-end',
        icon: $type,
        title: $msg,
        showConfirmButton: false,
        timer: 2000
    })
};

function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}