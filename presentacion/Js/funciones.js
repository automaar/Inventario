

//VERIFICAR RUT
function revisarDigito( elemento,dvr )
	{	
	dv = dvr + ""	
	if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K')	
	{		
		alert("Debe ingresar un digito verificador valido")
		elemento.focus();
		elemento.select();	
		return false;	
	}	
	return true;
}

function revisarDigito2( elemento,crut )
	{	
	var largo, rut, dv;
	largo = crut.length;	
	if ( largo < 2 )	
	{		
		alert("Debe ingresar el rut completo")
		elemento.focus();
		elemento.select();
		return false;	
	}	
	
	if ( largo > 2 )		
		rut = crut.substring(0, largo - 1);	
	else		
		rut = crut.charAt(0);	
	dv = crut.charAt(largo-1);	
	revisarDigito( elemento,dv );	

	if ( rut == null || dv == null )
		return 0	

	var dvr = '0'	
	suma = 0	
	mul  = 2	

	for (i= rut.length -1 ; i >= 0; i--)	
	{	
		suma = suma + rut.charAt(i) * mul		
		if (mul == 7)			
			mul = 2		
		else    			
			mul++	
	}	
	res = suma % 11	
	if (res==1)		
		dvr = 'k'	
	else if (res==0)		
		dvr = '0'	
	else	
	{		
		dvi = 11-res		
		dvr = dvi + ""	
	}
	if ( dvr != dv.toLowerCase() )	
	{		
		alert("EL rut es incorrecto")
		elemento.focus();
		elemento.select();
		return false;	
	}
	return true;
}

function valida_rut(elemento, texto){
	var tmpstr = "";	
	for ( i=0; i < texto.length ; i++ )		
		if ( texto.charAt(i) != " " && texto.charAt(i) != "." && texto.charAt(i) != "-" )
			tmpstr = tmpstr + texto.charAt(i);	
	texto = tmpstr;	
	largo = texto.length;	

	if ( largo < 2 )	
	{		
		alert("Debe ingresar el rut completo")
		elemento.focus();
		elemento.select();   
		return false;	
	}	

	for (i=0; i < largo ; i++ )	
	{			
		if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i) !="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i) !="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i) !="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i) != "K" )
		 {			
			alert("El valor ingresado no corresponde a un R.U.T valido");
			elemento.focus();
			elemento.select();
			return false;		
		}	
	}	

	var invertido = "";	
	for ( i=(largo-1),j=0; i>=0; i--,j++ )		
		invertido = invertido + texto.charAt(i);	
	var dtexto = "";	
	dtexto = dtexto + invertido.charAt(0);	
	dtexto = dtexto + "-";	
	cnt = 0;	

	for ( i=1,j=2; i<largo; i++,j++ )	
	{		
		if ( cnt == 3 )		
		{			
			dtexto = dtexto + ".";			
			j++;			
			dtexto = dtexto + invertido.charAt(i);			
			cnt = 1;		
		}		
		else		
		{				
			dtexto = dtexto + invertido.charAt(i);			
			cnt++;		
		}	
	}	

	invertido = "";	
	for ( i=(dtexto.length-1),j=0; i>=0; i--,j++ )		
		invertido = invertido + dtexto.charAt(i);	

		elemento.value = invertido.toUpperCase()

	if ( revisarDigito2(elemento, texto) )		
		return true;	

	return false;
}

//VERIFICAR EMAIL
function isValidEmail(email, required) {
    if (required==undefined) {   // if not specified, assume it's required
        required=true;
    }
    if (email==null) {
        if (required) {
            return false;
        }
        return true;
    }
    if (email.length==0) {  
        if (required) {
            return false;
        }
        return true;
    }
    if (! allValidChars(email)) {  // check to make sure all characters are valid
        return false;
    }
    if (email.indexOf("@") < 1) { //  must contain @, and it must not be the first character
        return false;
    } else if (email.lastIndexOf(".") <= email.indexOf("@")) {  // last dot must be after the @
        return false;
    } else if (email.indexOf("@") == email.length) {  // @ must not be the last character
        return false;
    } else if (email.indexOf("..") >=0) { // two periods in a row is not valid
	return false;
    } else if (email.indexOf(".") == email.length) {  // . must not be the last character
	return false;
    }
    return true;
}

function allValidChars(email) {
  var parsed = true;
  var validchars = "abcdefghijklmnopqrstuvwxyz0123456789@.-_";
  for (var i=0; i < email.length; i++) {
    var letter = email.charAt(i).toLowerCase();
    if (validchars.indexOf(letter) != -1)
      continue;
    parsed = false;
    break;
  }
  return parsed;
}

function valida_correo(correo,confCorreo) {
    if (! isValidEmail(correo.value)) {
        // alert("Ingrese Correo Valido!");
		confCorreo=true;
		correo.value="";
		correo.focus();
		return confCorreo;
	}
}

function validarEmail(str) {
	/*if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor)){
		return (true)
	} else {
		return (false);
	}*/
	
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		var lastdot=str.lastIndexOf(dot)
		if (str.indexOf(at)==-1){
		  // alert("Invalid E-mail ID")
		   return false
		}
		if (lstr==0){
		   //alert("Invalid E-mail ID 1")
		   return false
		}		
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   //alert("Invalid E-mail ID")
		   return false
		}
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr || str.substring(lastdot+1)==""){
		    //alert("Invalid E-mail ID")
		    return false
		}
		 
		 if (str.indexOf(at,(lat+1))!=-1){
		    //alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    //alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    //alert("Invalid E-mail ID")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    //alert("Invalid E-mail ID")
		    return false
		 }
		if(CharsInBag(str)==false){
		    //alert("Invalid E-mail ID")
		    return false
		 }
		 var arrEmail=str.split("@")
		 var ldot=arrEmail[1].indexOf(".")
		 if(isInteger(arrEmail[1].substring(ldot+1))==false){
		    //alert("Invalid E-mail ID")
		    return false
		 }
 		 return true			
	
}

//VERIFICAR LLENADO
function validarLlenado(val){

	/*
	p_rut			=document.getElementById(p_rut).value;
	p_nombre		=document.getElementById(p_nombre).value;
	p_apellido		=document.getElementById(p_apellido).value;
	p_direccion		=document.getElementById(p_direccion).value;
	p_telefono		=document.getElementById(p_telefono).value;
	p_correo		=document.getElementById(p_correo).value;
	p_clave			=document.getElementById(p_clave).value;*/

	//console.log(p_rut,p_nombre,p_apellido,p_edad,p_direccion,p_telefono,p_correo,p_clave);
	console.log(val);

	if(val == null || val == 0 || /^\s+$/.test(val) ) {
		return false;
	}
}