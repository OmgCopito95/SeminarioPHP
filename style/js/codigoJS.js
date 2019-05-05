function openTab(tabName) {
  var i;
  var x = document.getElementsByClassName("tab");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(tabName).style.display = "block";  
}



function validarForm(){
	
	// verifico nombre y apellido (solo caracteres alfabeticos)
	var r = /^[A-Z]+$/i;
	var patronNomb = r.exec(document.getElementById('nombre').value);
	var patronAp = r.exec(document.getElementById('apellido').value);
	if (!patronNomb){
   		alert("El nombre solo puede tener caracteres alfabeticos.");
		return false;
	}else{
		if (!patronAp){
			alert("El apellido solo puede tener caracteres alfabeticos.");
			return false;
		}else{
				// verifico el nombre de usuario (6 caracteres alfanumericos)
			r = /....../;
			var patron = r.exec(document.getElementById('username').value);
			if (!patron){
				alert("El nombre de usuario no cumple con los requisitos");
				return false;
			}
			else{
				// verifico el mail
				var r = /\S+@\S+\.\S+/;
				var patron = (r.test(document.getElementById('email').value));
				if (!patron){
					alert("Ingrese un email valido.");
					return false; 
				}else{
					// verifico que las contraseñas sean iguales
					if (document.getElementById('password1').value != document.getElementById('password2').value){
						alert("Las contraseñas no coinciden");
						return false; 
					}else{
						// verifico que la contraseña cumpla con el patron (>=6 caracteres, letras may y min, un num o simb)
						var r = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,20}$/;
						var patron = r.exec(document.getElementById('password1').value);
					    if (!patron){
					    	alert("La contraseña no cumple con los requisitos.");   	
					    	return false;
					    }
					}
				}	
			}
		}
		
	}
	return true;
}
