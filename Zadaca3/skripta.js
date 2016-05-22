 window.onload = function Datum()
 {

	var elementi = document.getElementsByClassName("vrijemeObjave");
	for(var i=0; i<elementi.length; i++){
		var s = elementi[i].getAttribute("datetime");
		var ispisi=datumNovosti(s);
		document.getElementsByClassName("vrijemeObjave")[i].innerHTML = ispisi;
	}
}


function datumNovosti(datum)
{
	var pom="";
	var trenutniDatum=new Date();
	var datumObjave=new Date(datum);
	var razlikaVrijeme =trenutniDatum.getTime() - datumObjave.getTime();
	console.log(razlikaVrijeme);
	var razlikaMinute= Math.ceil(razlikaVrijeme/(1000*60));
	var razlikaSati= Math.ceil(razlikaMinute/60);
	var razlikaDani = Math.ceil(razlikaVrijeme / (1000 * 3600 * 24)); 
	
	if (razlikaMinute<=1) pom="prije par sekundi";
	else if (razlikaSati<=1)
	{
		if (razlikaMinute%10==1) pom=sastavi(razlikaMinute.toString(), "minutu");
		else if (razlikaMinute%10>1 && razlikaMinute%10<5) pom=sastavi(razlikaMinute.toString(),"minute");
		else pom=sastavi(razlikaMinute.toString(),"minuta");
	}
	else if (razlikaSati<24)
	{
		if (razlikaSati%10==1) pom=sastavi(razlikaSati.toString(),"sat");
		else if (razlikaSati%10>1 && razlikaSati%10<5) pom=sastavi(razlikaSati.toString(),"sata");
		else pom=sastavi(razlikaSati.toString(),"sati");
	}
	else if (razlikaDani<=7)
	{
		if (razlikaDani%10==1) pom=sastavi(razlikaDani.toString(),"dan");
		else pom=sastavi(razlikaDani.toString(),"dana");
	}
	else if (razlikaDani>7 && razlikaDani<=14) pom="prije 1 sedmicu";
	else if (razlikaDani>14 && razlikaDani<=21) pom="prije 2 sedmice";
	else if (razlikaDani>21 && razlikaDani<=28) pom="prije 3 sedmice";
	else if(razlikaDani>28 && razlikaDani<=31) pom="prije 4 sedmice";
	else pom=ispisDatuma(datumObjave);
	
	return pom;

}
function sastavi(vrijeme,rijec){

	return "prije "+vrijeme+" "+rijec; 
}	
function ispisDatuma(datum){
	var dan=datum.getDate();
	var mjesec=datum.getMonth()+1;
	var sat=datum.getHours();
	var minuta=datum.getMinutes();
	var sekunde=datum.getSeconds();
	if(dan<10) dan="0"+dan;
	if(mjesec<10) mjesec="0"+mjesec;
	if(sat<10) sat="0"+sat;
	if(minuta<10) minuta="0"+minuta;
	if(sekunde<10) sekunde="0"+sekunde;
	return dan+"."+mjesec+"."+datum.getFullYear()+" "+sat+":"+minuta+":"+sekunde;


}

// kontakt

function validirajIme(val)
{
  var ime = document.getElementById("name");
  var tekst = document.getElementById("name").value;
  var reg = /^[A-Z][a-z]+$/gm;
  if(!(reg.test(tekst)))
  {
    ime.style.backgroundColor="red";
  }
  else {
    ime.style.backgroundColor="white";
  }
}

function validirajMail(val)
{  var mail = document.getElementById("email");
  var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	
	if(mail.test(regex))
	{
		document.getElementById("email").style.backgroundColor = "white";
		
		return true;
	}
	else{
		
		document.getElementById("email").style.backgroundColor = "red";
		
		return false;
	}
}


function provjeriPolja(val)
{
  var ime = document.getElementById("name");
  var email= document.getElementById("email");
  var kom = document.getElementById("comment");

  
  if (ime.value != "" && email.value != "") kom.style.display="block";
  else kom.style.display="none";
 
}


  function validirajKomentar(val)
  { 
  	var validno;
  	var komentar=document.getElementById("comment");
  	for (var i = 0; i < komentar.length ; i++) {
       if(komentar[i].value=="" || Komentar[i].value==null)
       	{
       		validno=false;
       		komentar.style.backgroundColor="red";
       	}
    }
    if (!validno)
    {
     alert("Unesite komentar!")
     komentar.style.backgroundColor="red";
 	}
  }




            