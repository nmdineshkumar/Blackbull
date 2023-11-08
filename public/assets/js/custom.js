const URL = document.location.origin
const BODY = $('body');
const CsrfToken = $('meta[name="csrf-token"]').attr('content');
function pageLoader(isBlock = false) {
    if (isBlock) {
        $('.spinner-div').css('display', 'block');
    } else {
        $('.spinner-div').css('display', 'none');
    }
}
function successAlert(message) {
    iziToast.success({ timeout: 40000, overlay: true, zindex: 999, title: 'Yeah!', message: message, position: "center", icon: " fas fa-success" });
}

function errorAlert(message) {
    iziToast.error({ timeout: 40000, overlay: true, zindex: 999, title: 'Oops!', message: message, position: "center", icon: " fas fa-danger" });
}
function initializeDataTable(id, url, columns) {
    $('#' + id).DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
        // ajax: url,
        ajax: {
            url: url,
            data: function (d) {
                d.category = $('.search-category :selected').val()
            }
        },
        columns: columns,
        //   order: [[0, 'desc']]
    });
}
function reInitializeDataTable(id, url, columns) {
    $('#' + id).DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        destroy: true,
        // ajax: url,
        ajax: {
            url: url,
            data: function (d) {
                d.category = $('.search-category :selected').val()
            }
        },
        columns: columns,
        //   order: [[0, 'desc']]
    });
}
$('#country').on('change',function(e){
    var state = $('#state');
    state.empty();
    state.append(new Option('---SELECT---',''));
    $.ajax({
        url:URL+'/state/'+e.currentTarget.value,
        type:'GET',
        success:function(data){
            data.forEach(element => {
                $('#state').append(new Option(element.name,element.id))
            });
            $('.selectpicker').selectpicker('refresh');
        }
    })
});

$('#state').on('change',function(e){
    var city = $('#city');
    city.empty();
    city.append(new Option('---SELECT---',''));
    $.ajax({
        url:URL+'/cities/'+e.currentTarget.value,
        type:'GET',
        success:function(data){
            data.forEach(element => {
                city.append(new Option(element.name,element.id))
            });
            $('.selectpicker').selectpicker('refresh');
        }
    })
});
$('#make').on('change',function(e){
    var mySelection = $('#model');
    mySelection.empty();
    mySelection.append(new Option('---SELECT---',''));
    $.ajax({
        url:URL+'/get-car-model/'+e.currentTarget.value,
        type:'GET',
        success:function(data){
            data.forEach(element => {
                mySelection.append(new Option(element.name,element.id))
            });
            $(mySelection).selectpicker('refresh');
        }
    });
});
$('#model').on('change',function(e){
    var mySelection = $('#year');
    mySelection.empty();
    mySelection.append(new Option('---SELECT---',''));
    $.ajax({
        url:URL+'/get-car-year/'+e.currentTarget.value,
        type:'GET',
        success:function(data){
            data.forEach(element => {
                mySelection.append(new Option(element.name,element.id))
            });
            $(mySelection).selectpicker('refresh');
        }
    });
});
function nullAsEmpty(val) {
    if (val) return val;
    return '';
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});

BODY.on('click', '.delete-by-id', function (e) {
    e.preventDefault();
    console.log($(this).data('url'))
    const deleteUrl = $(this).data('url');
    const actionType = nullAsEmpty($(this).data('action-type')).toLowerCase();
    const alertMessage = actionType === 'delete' ? 'Are you sure want to delete the data?' : 'Are you sure want to retrieve the data back?';

    iziToast.question({
        rtl: false,
        layout: 1,
        drag: false,
        timeout: false,
        close: true,
        overlay: true,
        displayMode: 1,
        progressBar: true,
        title: 'Hey',
        message: alertMessage,
        position: 'center',
        buttons: [
            ['<button><b>Yes, '+ actionType +'!</b></button>', function (instance, toast, button, e, inputs) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                var fd = new FormData();
                fd.append('_token', CsrfToken);
                fd.append('_method', "DELETE");
                $.ajax({
                    type: 'POST',
                    data: fd,
                    contentType: false,
                    cache: false,
                    processData: false,
                    url: deleteUrl,
                    dataType: 'json',
                    success: function (d) {
                        if (d.str == 1) {
                            successAlert('Deleted successfully');
                            pageLoader();
                           // $('#datatable').DataTable().draw(false);
                            window.location.reload();
                        } else {
                            errorAlert('Select data not available!');
                            pageLoader();
                        }
                    },
                    error: function (d) {
                        errorAlert('Select data not available!');
                        pageLoader();
                    },
                });
            }, false]
        ]
    });
});

