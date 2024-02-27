$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function loadMore() {
    const page = $('#page').val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: {page},
        url: '/services/load-products',
        success: (result) => { 
            if (result.html !== '') {
                $('#loadData').append(result.html);
                $('page').val(page + 1);
            } else {
                alert('Đã load xong data');
                $('#button-loadData').css('display', 'none');
            }
        }
    });
}