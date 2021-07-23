if(document.getElementById("id_submitbutton")){
    //Event listeners that autocomplete the sentence field
    let bnoun = document.getElementById("id_addspacen");
    let badjective = document.getElementById("id_addspacea");
    let bverb = document.getElementById("id_addspacev");
    bnoun.addEventListener("click", ()=>{
        let sentence = document.getElementById("id_sentence");
        sentence.value += ' [wordn] ';
    })
    badjective.addEventListener("click", ()=>{
        let sentence = document.getElementById("id_sentence");
        sentence.value += ' [worda] ';
    })
    bverb.addEventListener("click", ()=>{
        let sentence = document.getElementById("id_sentence");
        sentence.value += ' [wordv] ';
    })
}