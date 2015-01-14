function validarRut(rut, digito){
    /*Validando el digito verificador*/
    var M = 0, S = 1;
    for (; rut; rut = Math.floor(rut / 10)) {
        S = (S + rut % 10 * (9 - M++ % 6)) % 11;
    }
    /*Validando el digito verificador*/
    var verif = S ? S - 1 : 'k';
    if (digito == verif) {
//        alert("Dígito verficador OK");
        return true;
    } else {
        document.form.digito.focus();
        document.form.digito.select();
        document.form.digito.style.background = "pink";
        //document.getElementById('menRut').innerHTML = "Digito verficador incorrecto";  
        alert("Dígito verficador incorrecto");
        return false;
    }
}