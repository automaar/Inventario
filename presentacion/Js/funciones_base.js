
function fgo_Ajax(){ 
	XMLHttp = false;
	if (window.XMLHttpRequest) {
		//alert('IE7, Mozilla Firefox, Opera, Google Chrome');
		return new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		var versiones = ["Msxml2.XMLHTTP.7.0", "Msxml2.XMLHTTP.6.0", "Msxml2.XMLHTTP.5.0", "Msxml2.XMLHTTP.4.0", "MSXML2.XMLHTTP.3.0", "MSXML2.XMLHTTP", "Microsoft.XMLHTTP"];
		for (var i=0;i<versiones.length;i++) {
			try {
				XMLHttp = new ActiveXObject(versiones[i]);
				if (XMLHttp) {
					//alert('IE6, IE5.5, IE5.01, IE4.01, IE3.0');
					return XMLHttp;
					break;
				}
			} catch (e) {} ;
		}
	}
}

function base64_decode(data) {
  // example 1: base64_decode('S2V2aW4gdmFuIFpvbm5ldmVsZA==');
  // returns 1: 'Kevin van Zonneveld'
  // mozilla has this native
  // - but breaks in 2.0.0.12!
  //if (typeof this.window['atob'] == 'function') {
  //    return atob(data);
  //}
  var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    dec = "",
    tmp_arr = [];

  if (!data) {
    return data;
  }

  data += '';

  do { // unpack four hexets into three octets using index points in b64
    h1 = b64.indexOf(data.charAt(i++));
    h2 = b64.indexOf(data.charAt(i++));
    h3 = b64.indexOf(data.charAt(i++));
    h4 = b64.indexOf(data.charAt(i++));

    bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;

    o1 = bits >> 16 & 0xff;
    o2 = bits >> 8 & 0xff;
    o3 = bits & 0xff;

    if (h3 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1);
    } else if (h4 == 64) {
      tmp_arr[ac++] = String.fromCharCode(o1, o2);
    } else {
      tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
    }
  } while (i < data.length);

  dec = tmp_arr.join('');

  return dec;
}

function base64_encode(data) {
  // *     example 1: base64_encode('Kevin van Zonneveld');
  // *     returns 1: 'S2V2aW4gdmFuIFpvbm5ldmVsZA=='
  // mozilla has this native
  // - but breaks in 2.0.0.12!
  //if (typeof this.window['btoa'] == 'function') {
  //    return btoa(data);
  //}
  var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
    ac = 0,
    enc = "",
    tmp_arr = [];

  if (!data) {
    return data;
  }

  do { // pack three octets into four hexets
    o1 = data.charCodeAt(i++);
    o2 = data.charCodeAt(i++);
    o3 = data.charCodeAt(i++);

    bits = o1 << 16 | o2 << 8 | o3;

    h1 = bits >> 18 & 0x3f;
    h2 = bits >> 12 & 0x3f;
    h3 = bits >> 6 & 0x3f;
    h4 = bits & 0x3f;

    // use hexets to index into b64, and append result to encoded string
    tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
  } while (i < data.length);

  enc = tmp_arr.join('');

  var r = data.length % 3;

  return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);

}


function CargarTiposInput(){
	var tipos = new Array();
	tipos.push("text","hidden","password","checkbox","file");//"radio",
	return tipos;
}

/**
 * FUNCION UTILIZADA EN MODULO DE CAPTURA
 * @author Miguel Lujan B.
 * @param {Object} tipos
 */
function CapturarInputs(tipos){	
	
	var lista_tipos		=new Array();
	var lista_retorno 	=new Array();
	var lista_inputtipo =new Array();
	var i;
	var y;
	var x;
	
	if(!tipos){
		lista_tipos=CargarTiposInput();
	}else{
		lista_tipos=tipos.split(",");
	}
	for (i=0;i<lista_tipos.length;i++){
		eval(lista_tipos[i] + " = new Array();");
		
		if(lista_tipos[i]=="select"){
			var lista_input   	=document.getElementsByTagName("select");
			
			for(y=0;y<lista_input.length;y++){
				eval(lista_tipos[i]).push(lista_input[y]);
			}

		}else{
			var lista_input   	=document.getElementsByTagName("input");
			
			for(y=0;y<lista_input.length;y++){
				if(lista_tipos[i]==lista_input[y].getAttribute('type')){
					eval(lista_tipos[i]).push(lista_input[y]);
				}
			}
		}
		lista_inputtipo.push(eval(lista_tipos[i]));
	}
	return lista_inputtipo;
}

/**
 * Funcion
 * @param {Object} lista_inputs
 * @param {Object} lista_parametros
 */
function EnviarxUrl(lista_inputs,lista_parametros){
	var parametros 		  =new String();
	var lista_parametros1 =new Array();
	var lista_parametros2 =new Array();
	parametros='p_xencodeurl=&';

	//Crea String Lista input.
	for (i=0;i<lista_inputs.length;i++){
		for(y=0;y<lista_inputs[i].length;y++){
			parametros+=lista_inputs[i][y].getAttribute('id');
			parametros+="="+urlEncode(base64_encode(lista_inputs[i][y].value));
			if (! (((lista_inputs.length-1)==i) && ((lista_inputs[i].length-1)==y))){
				parametros+="&";
			}
		}
	}
	//Crea String Lista parametros.
	if(lista_parametros){		
		if(lista_inputs){
			parametros+="&";
		}
		lista_parametros1=lista_parametros.split(",");		
		for(i=0;i<lista_parametros1.length;i++){
			lista_parametros2=lista_parametros1[i].split("=");			
			parametros+=lista_parametros2[0];
			parametros+="="+urlEncode(base64_encode(lista_parametros2[1]));
			if (!((lista_parametros1.length-1)==i)){
				parametros+="&";
			}
		}
	}
	return parametros;
}

