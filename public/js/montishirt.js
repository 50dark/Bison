// alert('bim');

// au chargement de la page, on lance le chargement des taille avec la valeur initial du select value type
// recuperation de la valeur de l'option selectionne par deffault au chargement de la page

let type_id = $('.change_type').val();
// appel de la fonction
loadTailles(type_id);

let produit_id = $('.change_type').data('id_produit');

$('.change_type').on('change',function(){
    // alert('boum');
let type_id = this.value;
// alert(type_id);
loadTailles(type_id);



});
function loadTailles(type_id){
    axios.post('/backend/produit/select/size',{'type_id':type_id}).then(reponse=>{
        $('.load_tailles').html(reponse.data);
    });
}
