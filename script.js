
function searchActor() {
    var actor_id = $(this).val();
    var actor_name = $("#actor option:selected").text();
    $('#actor_id').val(actor_id);
    $('#actor_name').val(actor_name);
    $('#form').val('submit');
    $('#form').submit();
};

function selectActor(event) {
    event.preventDefault();
    $.getJSON("actors.php",
             {'firstname': $('#firstname').val(),
              'lastname': $('#lastname').val() },
              function(data) {
        $('#actor_placeholder').text("Select Actor");
        $('#actor').removeClass('warn');
        $.each(data, function(index, item) {
            $('#actor').append(
            $('<option class="search_result"></option>')
                .text(item.first_name + " " + item.last_name)
                .val(item.id)
            );
        });
    })
    .error(function(jqXHR, textStatus, errorThrown) {
        if (errorThrown == "Not Found") {
            $('#actor option.search_result').remove();
            $('#actor').addClass('warn');
            $('#actor_placeholder').text("No matches; Try another actor's name")
        }        
    })
};

$(document).ready(function() {
    $('#form').submit(selectActor);
    $('#actor').live('change', 'searchActor');
});

