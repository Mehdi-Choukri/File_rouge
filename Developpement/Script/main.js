document.getElementById('RIB').value="007590000935400000001631";
 function getSelectedValue(){
     var select = document.getElementById('banque').selectedIndex;
     if(select == 0)
     {
        document.getElementById('RIB').value = "007590000935400000001631";
     }
     else
     {
        document.getElementById('RIB').value = "011590000009210006006980";
     }
       

 }
   

    var OnchangeEvent = document.getElementById('DOC_MONTANT');
 
    
    OnchangeEvent.addEventListener('change',function (e){
       
        document.getElementById('LETTRE_MONTANT').value = NumberToLetter(Number(document.getElementById('DOC_MONTANT').value)) ;
   

    });
    //validation des champs de insertion d'un document !

    var Submit_insert_doc  = document.getElementById('doc_insert_submition');
    var validationErros ;
    var cpt = 0;
    var Ben = document.getElementById('NOM_BEN_PC');
    var Ben_CIN = document.getElementById('CIN_BEN_PC');
    var Ben_RIB = document.getElementById('RIB_BEN');
    //La date du document
    var d = new Date();
    var correctMonth = Number(d.getMonth());

     var correctDateFormat = d.getFullYear()+"-"+(correctMonth+1)+"-"+d.getDate();

    var dateDocument = document.getElementById('DATE');
    dateDocument.value = correctDateFormat;

    function check_fields(field1, field2, field3)
    {
        validationErros = "";

        var ValidName , ValidRIB , ValdCIN ;
        if(field1 != '' && field2 != '')
        {
            ValidName = RegExp('[a-zA-Z]{5,20}');
            ValdCIN =RegExp('[a-zA-Z]{2}[0-9]{6}');
            if(field1.match(ValidName) && field2.match(ValdCIN))
            {
              
                return true;
            }
            else
            {
                cpt++;
                validationErros += " Le nom invalide ou le CIN est invalide";
            }

        }
        else if(field3 != '')
        {
            ValidRIB = RegExp('[0-9]{24}');
            if(field3.match(ValidRIB))
            {
              
                return true;
            }
            else
            {
                cpt++;
                validationErros += " Le RIB est invalide";
            }
        }
       
        return false;

    }

    function check_date(){

    }
    

    Submit_insert_doc.addEventListener('click',function(e){
      
        if(check_fields(Ben.value,Ben_CIN.value,Ben_RIB.value) ){
    
     

        }
        else
        {
            if(cpt>0)
            {
                alert(validationErros);

            }
            
            e.preventDefault();
        }

    });


 
 function NumberToLetter(nombre) {
    	
    var letter = {
        0: "zéro",
        1: "un",
        2: "deux",
        3: "trois",
        4: "quatre",
        5: "cinq",
        6: "six",
        7: "sept",
        8: "huit",
        9: "neuf",
        10: "dix",
        11: "onze",
        12: "douze",
        13: "treize",
        14: "quatorze",
        15: "quinze",
        16: "seize",
        17: "dix-sept",
        18: "dix-huit",
        19: "dix-neuf",
        20: "vingt",
        30: "trente",
        40: "quarante",
        50: "cinquante",
        60: "soixante",
        70: "soixante-dix",
        80: "quatre-vingt",
        90: "quatre-vingt-dix",
    };
    
    var  n, quotient, reste, nb;
     
    var numberToLetter = '';
    //__________________________________

    if (nombre.toString().replace(/ /gi, "").length > 15) return "dépassement de capacité";
    if (isNaN(nombre.toString().replace(/ /gi, ""))) return "Nombre non valide";

    nb = parseFloat(nombre.toString().replace(/ /gi, ""));
    //if (Math.ceil(nb) != nb) return "Nombre avec virgule non géré.";
    if(Math.ceil(nb) != nb){
        nb = nombre.toString().split('.');
        return NumberToLetter(nb[0]) + " virgule " + NumberToLetter(nb[1]);
    }

    n = nb.toString().length;
    switch (n) {
        case 1:
            numberToLetter = letter[nb];
            break;
        case 2:
            if (nb > 19) {
                quotient = Math.floor(nb / 10);
                reste = nb % 10;
                if (nb < 71 || (nb > 79 && nb < 91)) {
                    if (reste == 0) numberToLetter = letter[quotient * 10];
                    if (reste == 1) numberToLetter = letter[quotient * 10] + "-et-" + letter[reste];
                    if (reste > 1) numberToLetter = letter[quotient * 10] + "-" + letter[reste];
                } else numberToLetter = letter[(quotient - 1) * 10] + "-" + letter[10 + reste];
            } else numberToLetter = letter[nb];
            break;
        case 3:
            quotient = Math.floor(nb / 100);
            reste = nb % 100;
            if (quotient == 1 && reste == 0) numberToLetter = "cent";
            if (quotient == 1 && reste != 0) numberToLetter = "cent" + " " + NumberToLetter(reste);
            if (quotient > 1 && reste == 0) numberToLetter = letter[quotient] + " cents";
            if (quotient > 1 && reste != 0) numberToLetter = letter[quotient] + " cent " + NumberToLetter(reste);
            break;
        case 4 :
        case 5 :
        case 6 :
            quotient = Math.floor(nb / 1000);
            reste = nb - quotient * 1000;
            if (quotient == 1 && reste == 0) numberToLetter = "mille";
            if (quotient == 1 && reste != 0) numberToLetter = "mille" + " " + NumberToLetter(reste);
            if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " mille";
            if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " mille " + NumberToLetter(reste);
            break;
        case 7:
        case 8:
        case 9:
            quotient = Math.floor(nb / 1000000);
            reste = nb % 1000000;
            if (quotient == 1 && reste == 0) numberToLetter = "un million";
            if (quotient == 1 && reste != 0) numberToLetter = "un million" + " " + NumberToLetter(reste);
            if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " millions";
            if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " millions " + NumberToLetter(reste);
            break;
        case 10:
        case 11:
        case 12:
            quotient = Math.floor(nb / 1000000000);
            reste = nb - quotient * 1000000000;
            if (quotient == 1 && reste == 0) numberToLetter = "un milliard";
            if (quotient == 1 && reste != 0) numberToLetter = "un milliard" + " " + NumberToLetter(reste);
            if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " milliards";
            if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " milliards " + NumberToLetter(reste);
            break;
        case 13:
        case 14:
        case 15:
            quotient = Math.floor(nb / 1000000000000);
            reste = nb - quotient * 1000000000000;
            if (quotient == 1 && reste == 0) numberToLetter = "un billion";
            if (quotient == 1 && reste != 0) numberToLetter = "un billion" + " " + NumberToLetter(reste);
            if (quotient > 1 && reste == 0) numberToLetter = NumberToLetter(quotient) + " billions";
            if (quotient > 1 && reste != 0) numberToLetter = NumberToLetter(quotient) + " billions " + NumberToLetter(reste);
            break;
    }//fin switch
    /*respect de l'accord de quatre-vingt*/
    if (numberToLetter.substr(numberToLetter.length - "quatre-vingt".length, "quatre-vingt".length) == "quatre-vingt") numberToLetter = numberToLetter + "s";

    return numberToLetter;

}//-----------------------------------------------------------------------

