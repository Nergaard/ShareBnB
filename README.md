![pageres](img/readme/shareBNB.png)

ShareBNB er en digital formidlingsløsning av hybler/leiligheter. Hovedoppgaven til nettsiden er å sette potensielle leietakere i kontakt med aktuelle utleiere. 
Ved hjelp av ShareBnB sin funksjonalitet kan utleiere promotere sine hybler/leiligheter slik at de blir lett å finne og attraktiv og leie.
Potensielle leietakere kan finne leiemuligheter i ønsket tidsperiode og geografisk område på en oversiktlig og effektiv måte.

  

# Motivasjon
ShareBnB er et prosjekt som er en del av en skoleoppgave på NTNU. Studenter fra Industriell økonomi og teknologiledelse, Datateknologi, Informatikk og Computer Science (Island) 
har samarbeidet om å løse prosjektoppgaven på en måte som best mulig tilfredsstiller følgende mål om læring:
* Tilegne kunnskap om programvareutviklingsmetoder som prosessmodeller, metoder og teknikker for architecture design, testing, planlegging, konfigurasjonsstyring og kvalitetsstyring.
* Utvikle ferdigheter i å planlegge og administrere små programvareutviklings-prosjekter og delta som designer / programmerer / tester i større programvareprosjekter. 
* Skape forståelse for betydningen av programvareutvikling som yrke.


# Build status
ShareBNB er satt opp med CI/CD system for Kontinuerlig levering og distribusjon. 
Ved hver release (merge til master) vil endringene lastes opp til www.sharebnb.rocks automagisk. Status fra forrige opplasting vises på merket nedenfor. 

[![pipeline status](https://gitlab.stud.idi.ntnu.no/programvareutvikling-v19/gruppe-13/badges/master/pipeline.svg)](https://gitlab.stud.idi.ntnu.no/programvareutvikling-v19/gruppe-13/commits/master)


# Kodestil
ShareBNB ønsker ren og oversiktlig kode, slik at så mange som mulig kan dra nytte av kodebasen. Vi ønsker derfor å bruke følgende verktøy og overholde følgende kodestandarder: 
* [BEM naming convention](http://getbem.com/naming/)
* [Git-flow](https://datasift.github.io/gitflow/IntroducingGitFlow.html) (Git)
* [Stylelint](https://stylelint.io/) (CSS)
* [Linter](https://atom.io/packages/linter) (JavaScript)
* [PRS-1](https://www.php-fig.org/psr/psr-1/) og [PRS-2](https://www.php-fig.org/psr/psr-2/) (PHP)


# Skjermbilder
Her er noen av ShareBnB sine grunnleggende funksjoner demonstrert <br>
![Sample Video](img/readme/sharebnb.webm)
  

# Teknologi og rammeverk
ShareBNB er bygget fra grunnen og er ikke basert på noe rammeverk foruten det teknologien tilbyr i seg selv. Teknologien som er benyttet i ShareBNB er følgende:

*  [Apache](https://www.apache.org/)
*  [PHP](https://www.php.net/)
    *  [PDO](https://www.php.net/manual/en/book.pdo.php)
*  [JavaSvript](https://www.javascript.com/)
*  [CSS(3)](https://developer.mozilla.org/en-US/docs/Web/CSS/CSS3)


# Features
**Prosjektet tilbyr blant annet:** 
* Søke i leiligheter basert på tid og lokasjon
* Kontinuerlig oppdatert søkeforslag for lokasjon
* Filtrere søk med søkeparametere tilpasset søkeresultatet
* Opprette og endre annonser
* Chat
  * Mellom eier og registrert besøkende
  * Mellom utleier og leietaker
* Forhold mellom eier og fremleier
* Se plassering av leiligheter på kart
* Oversikt over egne leiligheter
* Mulighet til å nekte fremleie
* Mulighet til å opprette kontrakt mellom leietaker og utleier
* Mye mer..
  

# Installasjon

### 1. Apache, MySQL og PHP
Vi anbefaler å bruke MAMP, som er et verktøy som installerer og administrerer Apache, MySQL og PHP. MAMP kjører på Windows og macOS. Ved ønske er det mulig å benytte seg av andre oppsett som gir tilsvarende teknologi.
For å se hvordan man installerer og setter opp prosjektet, se **wikisiden** for [Installasjon: Apache, MySQL, PHP](https://gitlab.stud.idi.ntnu.no/programvareutvikling-v19/gruppe-13/wikis/Installasjon:-Apache,-MySQL,-PHP).




### 2. Klone GitLab prosjekt
Se [GitLabs dokumentasjon](https://docs.gitlab.com/ee/gitlab-basics/command-line-commands.html) for en overordnet oversikt over hvordan man kloner et prosjekt. 

**SSH link :** ``git@gitlab.stud.idi.ntnu.no:programvareutvikling-v19/gruppe-13.git``

**HTTPS link :** ``https://gitlab.stud.idi.ntnu.no/programvareutvikling-v19/gruppe-13.git``

### 3. Oppsett av database
**Notis!** *Det er satt opp en felles database som brukes under utviklingen av ShareBNB. Det er mulig å bruke denne i stedet for å sette opp databasen lokalt. For å bruke utvikler-databasen krever det at du har tilgang på NTNUs intranett. Dette har du ved hjelp av EDUROAM på NTNUs område, eller ved bruk av NTNUs* *[VPN](https://innsida.ntnu.no/wiki/-/wiki/Norsk/Installere+VPN).*

For å få phpMyAdmin-tilgang til utvikler-databasen følger du linken: https://mysqladmin.stud.ntnu.no/  

``Username: toralfto_sharebnb``

``Password: 800nMoJX``

Om du ønsker å sette opp databasen lokalt, kan du følge guiden vår på **wikisiden**: [Oppsett av lokal database](https://gitlab.stud.idi.ntnu.no/programvareutvikling-v19/gruppe-13/wikis/Oppsett-av-lokal-database)

### 4. Se / Åpne prosjektet
Åpne en nettleser. I adressefeltet skriver du inn: `http://localhost:8888/`

**Notis!** Om PHP serveren din (MAMP) ikke har *ShareBNB* som root-mappe, må du tilpasse linken til å ta høyde for dette. Et eksempel på dette kan være `http://localhost:8888/git/ShareBNB`.


# API Reference
Prosjektet bruker Google sitt API for å kunne levere kartfunksjonalitet.
<br>**Google API**
API-key: `AIzaSyBSzKJClNckJGM6N3BuOIpDSBTmspo-970`

# Testing
### Godkjenning
**Gruppen definerer en modul som ferdig dersom:**
* Produktet må ha funksjonalitet i tråd med den/de relevante brukerhistoriene
* Produktet må ha vært gjennom intern testing.
* Produktet må være testet og godkjent av produkteier.

### Kodedekning

|Klasse   |dekning i prosent|
|---------|-----------------|
|Img      |0%               |
|Login    |0%               |
|Message  |0%               |
|Residence|0%               |
|Signup   |100%             |
|User     |12,5%            |
|Totalt:  |18,75%           |

**Kjøre tester**
Kodetester kjøres via nettleser, ved å bruke linken: `localhost:8888/[*sharebnb-lokasjon*]/testing.php`. Dette krever at du har prosjektet satt opp lokalt. (Se punkt "Lokal installasjon").

Testene kjøres ved å velge **Run tests**-knappen øverst på siden. 

**Skrive tester**
Testprogrammet består av to filer:
``[*sharebnb-lokasjon*]/testing.php``
``[*sharebnb-lokasjon*]/include/class_test.php``

Tester skal implementeres med utgangspunkt i følgende mal:
```PHP
$test->start('Testname');
	// Test here...
	// Response:
	if  ()  {
		$test->response_error('Error message');
	}  else  {
		$test->response_ok('OK message');
	}
$test->end();
```

**Eksempel på vellykket test:**             |  **Eksempel på feilet test:**
:-------------------------:|:-------------------------:
![](img/readme/testOK.png)  |  ![](img/readme/testERROR.png)


**CI kodedekning:**  [![coverage report](https://gitlab.stud.idi.ntnu.no/programvareutvikling-v19/gruppe-13/badges/master/coverage.svg)](https://gitlab.stud.idi.ntnu.no/programvareutvikling-v19/gruppe-13/commits/master)

ShareBNB system for automatisk testing er foreløbig **ikke kompatibelt med GitLab CI**. Om du ønsker å bidra til å endre dette, se punktet om "Hvordan bidra". 


### Brukertesting
Før nye elementer implementeres på nettsiden kreves det at det kjøres brukertest på funksjonaliteten. Formålet med brukertestingen er først og fremst for å verifisere funksjonalitet og ikke brukervennlighet.  Formatet for brukertesting skal bruke følgende mal: 

**Use Case:** En *ikke teknisk* beskrivelse av funksjonaliteten
**Beskrivelse:** En beskrivelse av hva som er forventet av kommer til å skje. 
**Aktører:** Hvilken type bruker som kreves for å kjøre testen. 
**Pre betingelser:** Hva / hvilke komponenter kreves for å kjøre testen-
**Post betingelse:** Hvilken respons kreves for at testen kan defineres som vellykket. 
**Hovedscenario:** En punktliste som tar testeren gjennom.


# Kode Eksempler
I prosjektets sentrum ligger en index-fil med en mainseksjon som ser slik ut:

```php
<main class="main_wrapper">
	<?php 
	if (isset($_SESSION['u_id'])) {
	    include('modules/main_menu.php');
	}
	?>
	<?php include('include/include.php'); ?>
</main>
```

Denne seksjonen bruker php til å inkludere en fil med navn include.php. Filen er på denne foremen:
```php
<?php
     if(!isset($_GET['pg'])) {  // sjekker om $_GET['pg'] ikke inneholder en verdi
        $pg = 'main';           // Hvis ikke $_GET['pg'] inneholder en verdi --> Gi variabelen $pg verdien 'main'
     } else {
        $pg = $_GET['pg'];      // Hvis $_GET['pg'] inneholder en verdi --> Gi variabelen $get innholdet i $_GET['pg']
     }
     
   if (isset($_SESSION['u_id'])) {
      if($pg == 'main') include('pages/main.php');
      else if($pg == 'signup') include('pages/signup.php');
      else if($pg == 'search') include('pages/search.php');
      else if($pg == 'apartments') include('pages/apartments.php');
      else if($pg == 'gdpr') include('pages/gdpr.php');
      else if($pg == 'tableToAp') include('pages/tableToAp.php');
      else if($pg == 'v_login') include('include/login_inc.php');
      else if($pg == 'logout') include('include/logout_inc.php');
      else if($pg == '404') include('pages/404.php'); ```
```
Her blir det sjekket om GET inneholder en verdi eller ikke. Hvis det ikke gjør det så inkluderes siden main.php.
Hvis GET inneholder en verdi som eksisterer i if-statmentene så inkluderes den tilhørende php-siden.
På denne måten er det egentlig alltid index.php som vises i brukerens nettleser, men det er ulikt innhold som inkluderes i mainseksjonen.

For å hente ut eller sette inn informasjon fra/til databasen brukes classes som alle benytter en kobling til databasen som lages på denne måten:
```php
<?php
    $servername = "mysql.stud.ntnu.no";
    $db_name = "toralfto_ShareBNB";
    $db_username = "toralfto_sharebnb";
    $db_password = "800nMoJX";
    
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$db_name", $db_username, $db_password);
    } catch (PDOException $e) {
        exit('Database connection error');
    }
```
Den globale variabelen `$pdo`brukes av alle klasser som må kommunisere med databasen. 
Et eksempel på dette kan vi se i denne delen av klassen User:
```php
class User {
    public function getInfoFromDB($approvedByUser) {
        global $pdo;
        $query = $pdo->prepare("SELECT rental_ID, rental_rented_by, rental_time_from, rental_time_to, rental_residence_ID
        FROM rental
        WHERE rental_approved_by = ?");
        $query->bindValue(1, $approvedByUser);
        $query->execute();
        return $query->fetchAll();
    }
```

Her brukes tilkoblingen som er lagret i den globale variabelen til å konstruere en "prepared statement" før den utføres mot databasen.

For å inkludere funksjonalitet fra klasser slik som User til sidene som er inkludert i index.php brukes php-funksjonalitet for å inkludere filer:
```php
<?php
if (isset($_POST['submit_signup'])) {
    echo 'test';
    include_once('include/pdo_con_inc.php');
    include_once('include/class_signup.php');
    $signup = NEW Signup();
```
Her inkluderes pdofilen slik at man kan bruke tilkoblingen til databasen, og signupklassen slik at man kan bruke metodene fra denne klassen.
`$signup` lagrer et nytt objekt av denne klassen slik at man kan bruke metodene på f.eks denne måten:

```php
$signup->check_available_email($email)
```


# How to use?
For fremgangsmåte for hvordan du kan bruke prosjketet se ShareBNBs wikiside: [brukermanual](https://gitlab.stud.idi.ntnu.no/programvareutvikling-v19/gruppe-13/wikis/Leveranse-7-Brukermanual).
  

# Bidra
For fremgangsmåte for hvordan du kan bidra til prosjketet se ShareBNBs wikiside: [Rutiner for evolusjon og endring](https://gitlab.stud.idi.ntnu.no/programvareutvikling-v19/gruppe-13/wikis/Leveranse%207%20Rutiner%20for%20evolusjon%20og%20endring).


# Kreditering
**Inspirasjon** 
- [TDT4240](https://www.ntnu.no/studier/emner/TDT4140/2015#tab=omEmnet) 

**Bidragsytere** 
- [@henriner](https://gitlab.stud.idi.ntnu.no/henriner) 
- [@omarmm](https://gitlab.stud.idi.ntnu.no/omarmm) 
- [@peturjt](https://gitlab.stud.idi.ntnu.no/peturjt) 
- [@solvehl](https://gitlab.stud.idi.ntnu.no/solvehl) 
- [@toralfto](https://gitlab.stud.idi.ntnu.no/toralfto) 

# Lisens
Alt innhold her er lisensiert under [*Attribution-ShareAlike 4.0 International* ***CC BY-SA 4.0*** *lisens*](http://creativecommons.org/licenses/by-sa/4.0//).

<a  rel="license"  href="http://creativecommons.org/licenses/by-sa/4.0/"><img  alt="Creative Commons License"  style="border-width:0"  src="https://i.creativecommons.org/l/by-sa/4.0/88x31.png"  /></a><br  /><a  rel="license"  href="http://creativecommons.org/licenses/by-sa/4.0/"></a>

## Rettigheter:
De viktigste punktene fra ***CC BY-SA 4.0*** gir enhver person fihet til å:

***Dele*** — kopiere, distribuere og spre verket i hvilket som helst medium eller format

***Bearbeide*** — remixe, endre, og bygge videre på materialet
til et hvilket som helst formål, inkludert kommersielle.

*ShareBNB kan ikke kalle tilbake disse frihetene så lenge du respekterer disse lisensvilkårene.*

## Betingelser:
***Navngivelse*** — Du må oppgi korrekt kreditering, oppgi en lenke til lisensen, og indikere om endringer er blitt gjort. Du kan kan gjøre dette på enhver rimelig måte, men uten at det kan forstås slik at lisensgiver bifaller deg eller din bruk av verket.

***Del-på-samme-vilkår*** — Dersom du remixer, bearbeider eller bygger på materialet, må du distribuere dine bidrag under samme lisens som originalen.

***Ingen ytterligere begrensninger*** — Du kan ikke gjøre bruk av juridiske betingelser eller teknologiske tiltak som lovmessig hindrer andre i å gjøre noe som lisensen tillater.

## Notiser:
*Du trenger ikke å rette deg etter lisensen for de deler av materialet som er falt i det fri eller der bruken er tillatt av etter lånereglene i åndsverkloven eller annen gjeldende rett.*

*Ingen garantier er gitt. Lisensen gir deg ikke nødvendigvis alle de tillatelser som er nødvendig for din tiltenkte bruk. For eksempel kan andre rettigheter, som reklame-, personvern-, eller ideelle rettigheter, sette begrensninger på hvordan du kan bruke materialet.*