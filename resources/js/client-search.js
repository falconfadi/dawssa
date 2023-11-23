$(document).ready(function () {
    $('#nationalityId').on('input', function () {
        var query = $(this).val();

        if (query.length >= 2) {
            $.ajax({
                url: '/clients/search',
                type: 'GET',
                data: { query: query },
                success: function (response) {
                    var dropdown = $('#clientDropdown');
                    dropdown.empty();

                    response.forEach(function (client) {
                        dropdown.append($('<option></option>').val(client.first_name + ' ' + client.last_name));
                    });
                }
            });
        }
    });

    $('#clientDropdown').on('change', function () {
        var selectedName = $(this).val().split(' ');
        $('#first_name').val(selectedName[0]);
        $('#last_name').val(selectedName[1]);
    });
});
