$(function () {

    $('form[name="ticket_store"]').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var action = form.attr("action");
        var data = form.serialize();

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            success: function (su) {
                ajax_load("close");

                if (su.message) {
                    var view = '<div class="message ' + su.message.type + '">' + su.message.message + '</div>';
                    $(".form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }

                if (su.redirect) {     
                    alert("Ticket Cadastrado com Sucesso");               
                    window.location.href = su.redirect.url;
                
                }
            }
        });
        
    });

    $('form[name="ticket_update"]').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var action = form.attr("action");
        var data = form.serialize();

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            success: function (su) {
                ajax_load("close");

                if (su.message) {
                    var view = '<div class="message ' + su.message.type + '">' + su.message.message + '</div>';
                    $(".form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }

                if (su.redirect) { 
                    alert("Ticket Alterado com Sucesso");                
                    window.location.href = su.redirect.url;  
                }
            }
        });
        
    });


    // DELETE
    $("[data-post]").click(function (e) {
        e.preventDefault();

        var clicked = $(this);
        var data = clicked.data();
        

        if (data.confirm) {
            var deleteConfirm = confirm(data.confirm);
            if (!deleteConfirm) {
                return;
            }
        }

        $.ajax({
            url: data.post,
            type: "POST",
            data: data,
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            success: function (response) {

                ajax_load("close");

                if (response.message) {
                    var view = '<div class="message ' + response.message.type + '">' + response.message.message + '</div>';
                    $(".login_form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }
                //redirect
                if (response.redirect) {
                    alert("Ticket Deletado com Sucesso");
                    window.location.href = response.redirect.url;
                }
                
            }
        });
    });


    // Edit Modal
    $('#editTicket').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var ticketId = button.data('whateverticketid') 
        var ticketTitle = button.data('whatevertickettitle')
        var ticketDescription = button.data('whateverticketdescription')        
        
        var modal = $(this)
        // modal.find('.modal-title').text('Editar' + ticketTitle)
        modal.find('#ticketId').val(ticketId)
        modal.find('#title').val(ticketTitle)
        modal.find('#description').val(ticketDescription)
    });


    // View Modal
    $('#viewTicket').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var ticketTitle = button.data('whatevertickettitle');
        var ticketDescription = button.data('whateverticketdescription');       
        var ticketStatus = button.data('whateverticketstatus');       
        
        var modal = $(this)
        modal.find('.modal-title').text('Visualizar ' + ticketTitle)
        modal.find('#ticketViewTitle').text(ticketTitle)
        modal.find('#ticketViewDescription').text(ticketDescription)
        modal.find('#ticketViewStatus').text(ticketStatus)
    });

    function ajax_load(action) {
        ajax_load_div = $(".ajax_load");

        if (action === "open") {
            ajax_load_div.fadeIn(200).css("display", "flex");
        }

        if (action === "close") {
            ajax_load_div.fadeOut(200);
        }
    }

});