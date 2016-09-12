/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    $("#edit").click(function () {
        $.ajax({
            async: "true",
            type: "POST",
            url: "http://www.le-pti-coin.fr/annonces/edit",
            dataType: "text",
            success: function (retour, statut) {

                $("#retour").text(retour);

            }

        });
    });
});