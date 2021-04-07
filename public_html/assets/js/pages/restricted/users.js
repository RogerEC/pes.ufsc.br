$(document).ready(function () {

    var link = Object();
    
    $(".editButton").on("click", function(event){
        event.preventDefault();
        // troca o botão de exibir para salvar
        $(".editButton").attr("disabled", true);
        $(this).hide();
        $("#saveButton"+$(this).val()).attr("hidden", false);
        // habilita campos para edição
        $("#name"+$(this).val()).attr("disabled", false);
        $("#status"+$(this).val()).attr("disabled", false);
        $("#permanentLink"+$(this).val()).attr("disabled", false);
        $("#url"+$(this).val()).attr("disabled", false);
        // verifica se o link é marcado como expirável
        if(!$("#permanentLink"+$(this).val()).is(':checked')){
            $("#expirationDatetime"+$(this).val()).attr("disabled", false);
        }
        // faz cópia dos valores antes da alteração
        link.name = $("#name"+$(this).val()).val();
        link.status = $("#status"+$(this).val()).is(':checked');
        link.permanentLink = $("#permanentLink"+$(this).val()).is(':checked');
        link.url = $("#url"+$(this).val()).val();
        link.expirationDatetime = $("#expirationDatetime"+$(this).val()).val();
        console.log("SALVA LINK");
        console.log(link);
    });

    $(".saveButton").on("click", function(event){
        if($("#name"+$(this).val()).val() == link.name){
            if($("#url"+$(this).val()).val() == link.url){
                if($("#status"+$(this).val()).is(':checked') == link.status){
                    if($("#permanentLink"+$(this).val()).is(':checked') == link.permanentLink){
                        if($("#permanentLink"+$(this).val()).is(':checked') || (!$("#permanentLink"+$(this).val()).is(':checked') && $("#expirationDatetime"+$(this).val()).val() == link.expirationDatetime)){
                            event.preventDefault();
                            // troca botão salvar para editar e ativa a edição dos demais
                            $(".editButton").attr("disabled", false);
                            $(this).attr("hidden", true);
                            $("#editButton"+$(this).val()).show();
                            // desabilita campos para edição
                            $("#name"+$(this).val()).attr("disabled", true);
                            $("#status"+$(this).val()).attr("disabled", true);
                            $("#permanentLink"+$(this).val()).attr("disabled", true);
                            $("#url"+$(this).val()).attr("disabled", true);
                            $("#expirationDatetime"+$(this).val()).attr("disabled", true);
                            return;
                        }
                    }
                }
            }
        }
    });

    $(".permanentLink").on("click", function(){
        if($("#permanentLink"+$(this).val()).is(':checked')){
            $("#expirationDatetime"+$(this).val()).attr("disabled", true);
        }else{
            $("#expirationDatetime"+$(this).val()).attr("disabled", false);
        }
    });

    $("#buttonAddLink").on("click", function(){
        $(".editButton").attr("disabled", true);
        $(this).hide();
        $("#newName").val('');
        $("#newUrl").val('');
        $("#newExpirationDatetime").val('');
        $("#newStatus").prop("checked", false);
        $("#newPermanentLink").prop("checked", false);
        $("#newExpirationDatetime").attr("disabled", false);
        $("#newLinkBox").show();
    });

    $("#newPermanentLink").on("click", function(){
        if($("#newPermanentLink").is(':checked')){
            $("#newExpirationDatetime").attr("disabled", true);
        }else{
            $("#newExpirationDatetime").attr("disabled", false);
        }
    });

    $("#buttonDeleteNewLink").on("click", function(){
        $(".editButton").attr("disabled", false);
        $("#newLinkBox").hide();
        $("#buttonAddLink").show();
    });

    $(".buttonDelete").on("click", function(event){
        event.preventDefault();
        $(".editButton").attr("disabled", true);
        $(".buttonDelete").attr("disabled", true);
        $("#buttonAddLink").attr("disabled", true);
        $.post('/usuario/gestor/links/delete', { idLink: $("#idLinks"+$(this).val()).val()}).done(function(){
            window.location.reload();
        }).fail(function(){
            alert("Erro ao tentar realizar a exclusão.");
            $(".editButton").attr("disabled", false);
            $(".buttonDelete").attr("disabled", false);
            $("#buttonAddLink").attr("disabled", false);
        });
    })
});