/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    $("#annonce").submit(function(event){
        event.preventDefault();
        var formData = $('form').serialize();
        $.ajax({
            async: "true",
            type: "POST",
            url: "http://www.le-pti-coin.fr/annonces/edit",
            dataType: "text",
            data: formData,
            success: function (retour, statut) {

                $("#retour").text(retour);

            }

        });   
    });
//    $("#edit").click(function () {
//        
//        var formulaireAnnonce = {
//            id: $("#monId").text(),
//            titre: $("#annonce_titre").val(),
//            image: $("#annonce_image").attr('files'),
//            description: $("#annonce_description").val(),
//            prix: $("#annonce_prix").val(),
//            vendeur: $("#annonce_vendeur").val(),
//            annee: $("#annonce_dateDeParution_year option:selected").val(),
//            mois: $("#annonce_dateDeParution_month option:selected").val(),
//            jour: $("#annonce_dateDeParution_day option:selected").val(),
//            telephone: $("#annonce_telephone").val(),
//            categorie: $("#annonce_categorie").val(),
//            localite: $("#annonce_localite").val()
//
//        };
//        $.ajax({
//            async: "true",
//            type: "POST",
//            url: "http://www.le-pti-coin.fr/annonces/edit",
//            dataType: "text",
//            data: formulaireAnnonce,
//            success: function (retour, statut) {
//
//                $("#retour").text(retour);
//
//            }
//
//        });
//    });
});