@extends('frontend.index')


@section('main-section')

<div class="container center-box">
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <div class="transperant-box locaties">
                <div class="heading-box">
                    <h3>Amstelveen<span>Schiphol</span>Taxi</h3>
                    <p>UW BETROUWBARE PARTNER IN LUCHTHAVEN VERVOER</p>
                </div>
                <p><strong>{{ $page_data->start_to_destination }}</strong></p>
                <p><strong>{{ $page_data->vehicle_price }}</strong></p>
                <p><strong><i>{{ $page_data->person_luggage }}</i></strong></p>
                <p><strong>{{ $page_data->pickup_place }}</strong></p>
                <p><strong>{{ $page_data->min_person }}</strong></p>
                <p><strong>{{ $page_data->max_person }}</strong></p>
                <p><a href="#" class="btn-online">Online Reserveren</a></p>
                <p><a href="#" class="btn-num">085 060 05 05</a></p>
                <div class="button-box">
                    <form action="{{ route('reserve') }}" method="post">
                        @csrf
                        <div class="input-box">
                            <input type="text" placeholder="your Pickup Address" name="pickup_address"
                                class="form-control pg-autocomplete">
                            <button type="button"><i class="fa-solid fa-location-crosshairs"></i></button>
                        </div>

                        <button type="submit" class="reserv">Reserve</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="clr2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="fot-text">
                    <h4>Taxi Schiphol in Amsterdam regio Noord-Holland</h4>
                    <h3>Prijs Amsterdam Noord-Holland naar Schiphol Luchthaven =
                        Vanaf € 30,00</h3>
                </div>
            </div>
        </div>
    </div>
</footer>

<section class="textionline">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="headingfot">
                    <h3>Reserveer de Luchthaven Taxi Via de Website</h3>
                </div>
            </div>
            <div class="col-lg-8 mx-auto text-center">
                <form action="{{ route('reserve') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex taxiinput-box">
                                <input type="text" class="form-control form-control pg-autocomplete"
                                    name="pickup_address" placeholder="Your Pickup Address">
                                <button type="button" class="btn btn-light"><i
                                        class="fa-solid fa-location-crosshairs"></i></button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <button type="sumit" class="btn btn-success w-100 text-uppercase">Reserve</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<footer class="clr2 footer2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="fot-text fot-text2">
                    <h4>Taxi Schiphol in Amsterdam regio Noord-Holland</h4>
                    <h4>Al Voor Slechts Vanaf € 30,00 Vaste Prijs met de Taxi van Amsterdam tot Schiphol!</h4>
                    <h4>Wij hebben u luxe taxi’s naar Schiphol vanuit Amsterdam, maar ook vanuit <a href="#">Ouderkerk aan de Amstel</a>, <a href="#">Amsterdam Oost</a>, <a href="#">Duivendrecht</a>, <a href="#">De Pijp</a>, <a href="#">Amsterdam Centrum</a>, <a href="#">Oud-Diemen</a>, <a href="#">Diemen</a>, <a href="#">Schellingwoude</a>, <a href="#">Amsterdam Zuid</a>, <a href="#">Amsterdam IJburg</a> en meer locaties rondom <a href="#">Amstelveen</a></h4>
                </div>
            </div>
        </div>
    </div>
</footer>

<section class="textionline">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="headingfot">
                    <h3>Of Reserveer de Luchthaven Taxi Telefonisch</h3>
                </div>
            </div>
            <div class="col-lg-8 mx-auto text-center">
                <a href="tel:0850600505" class="btn btn-success bel-btn text-uppercase">BEL 085 060 05 05</a>    
            </div>
        </div>
    </div>
</section>

<footer class="clr2 footer2">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="fot-text fot-text2">
                    <h4>Vaste Prijs met de Taxi van Amsterdam naar Schiphol!</h4>
                    <h4>Auto Vanaf € 30,00</h4>
                    <h4><i>(3 Personen 3 koffers / 4 Personen 4 trolleys)</i></h4>
                    <h4>Stationwagen Vanaf € 32,50</h4>
                    <h4>Bus tot 6 Pax Vanaf €35,00</h4>
                    <h4>Bus tot 8 Pax Vanaf €40,00</h4>
                </div>
            </div>
            <div class="col-lg-5 text-right">
                <img src="{{ url('images/taxi.jpg') }}" alt="taxi">
            </div>
        </div>
        <div class="midline"></div>
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="fot-text fot-text2">
                    <h4>Waarom kiezen voor Taxi Chauffeur van Amsterdam naar Luchthaven Schiphol?</h4>
                    <h3>Wij bieden Taxi Chauffeurs van Amsterdam Noord-Holland naar luchthaven</h3>
                    <p>
                        Reizen kan plezierig zijn. Je leert bijvoorbeeld een nieuwe stad kennen, probeert nieuw eten en ontmoet unieke nieuwe mensen. Reizen is altijd een opwindende ervaring, dus zorg ervoor dat alles soepel verloopt vanaf het moment dat u naar het vliegveld gaat, of op de luchthaven landt tot u weer onderweg naar huis bent. Daarom is een belangrijke vraag, hoe moet u uw vakantie of zakelijke reis stressvrij beginnen? Uiteraard, neem een luchthaven taxi!</p>
                    <ul class="foot-list1">
                        <li><i class="fa fa-check"></i>Luchthaven zonder gedoe</li>
                        <li><i class="fa fa-check"></i>Online Reserveren</li>
                        <li><i class="fa fa-check"></i>Bespaart uw tijd</li>
                        <li><i class="fa fa-check"></i>Betrouwbare taxichauffeurs</li>
                        <li><i class="fa fa-check"></i>Uitgerust Arriveren</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="container">
                    <div id="accordion" class="accordion">
                        <div class="card mb-0">
                            <div class="card-header collapsed" data-toggle="collapse" href="#collapse1" aria-expanded="false">
                                <a class="card-title">
                                    Luchthaven taxi vervoer zonder gedoe
                                </a>
                            </div>
                            <div id="collapse1" class="card-body collapse" data-parent="#accordion" style="">
                                <p>De Taxichauffeurs op de luchthaven zijn goed vertrouwd met  de verschillende hallen van Schiphol en kunnen nagaan welke luchtvaartmaatschappijen zich wanneer waar bevinden. Dit is natuurlijk zo omdat ze een groot deel van hun tijd op de luchthaven aanwezig zijn.
                                </p>
                                <p>
                                    Die ervaring met de  luchthavendiensten voor het ophalen en wegbrengen van passagiers zal uw reis minder stressvol maken en ook het vervoer van bagage vereenvoudigen. </p>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false">
                                <a class="card-title">
                                    Betrouwbaretaxichauffeurs
                                </a>
                            </div>
                            <div id="collapse2" class="card-body collapse" data-parent="#accordion">
                                <p>Luchthaven taxidiensten hebben veel te winnen bij hun succes. Ze willen hun reputatie niet op het spel zetten of klanten verliezen door onervaren of inefficiënte chauffeurs in te huren. Bovendien zijn deze chauffeurs beminnelijk, hoffelijk en veilig.</p>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false">
                                <a class="card-title">
                                    Uitgerust Arriveren
                                </a>
                            </div>
                            <div id="collapse3" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        Heeft u een limo nodig voor uw groep? Wat dacht u van een eenvoudige maar moderne taxi met eersteklas voorzieningen? Luchthaven taxi’s hebben alles! Wie zegt dat limousines alleen voor beroemdheden zijn als er zoveel moderne voertuigen zijn om uit te kiezen die ruim en goed onderhouden zijn?</p>
                                </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false">
                                <a class="card-title">
                                    Vlucht bewakingsdiensten
                                </a>
                            </div>
                            <div id="collapse4" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        Vliegen kan vervelend zijn als het aankomt op geannuleerde en vertraagde vluchten. Het goede nieuws is dat luchthaven vervoersdiensten vlucht controlediensten aanbieden om ervoor te zorgen dat uw vlucht op tijd aankomt.</p>
                                    <p>
                                        U zal tijd winnen door niet te moeten wachten op de luchthaven.
                                    </p>
                                </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false">
                                <a class="card-title">
                                    Online Schiphol Luchthaven taxi bestellen
                                </a>
                            </div>
                            <div id="collapse5" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        Om het eenvoudig te maken, kunt u online een taxi van Amsterdam naar Schiphol reserveren. Dat is ook ons advies als u niet in de rij wilt staan. Onze luchthaven taxidienst heeft een eenvoudige boeking website.</p>
                                    <p>
                                        Ga daarvoor naar de online boekingsoptie op onze website,  reserveer via Whatsapp, of bel ons. Plan een pick-up, en het voertuig dat u gekozen heeft zal op u wachten wanneer u op de luchthaven aankomt.</p>
                                </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false">
                                <a class="card-title">
                                    Een Luchthaven Taxi Bespaart tijd
                                </a>
                            </div>
                            <div id="collapse6" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        Tijd is niet te koop. Om die reden wilt u het niet kwijtraken.
                                    </p>
                                    <p>
                                        Het voordeel van onze luchthaven taxidienst is dat  ze u rechtstreeks naar uw bestemming brengen zonder omwegen. De chauffeurs zijn ook goed vertrouwd met sluiproutes in het verkeer. In tegenstelling tot een luchthaven-shuttle, die andere passagiers moet oppikken en afzetten, kan een luchthaven taxi u rechtstreeks naar uw bestemming brengen zonder tussenstops.</p>
                                </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="false">
                                <a class="card-title">
                                    Wat zijn onze taxidiensten naar de luchthaven vanuit Amsterdam
                                </a>
                            </div>
                            <div id="collapse7" class="collapse" data-parent="#accordion">
                                <div class="card-body">

                                    <p>Luchthaven taxi diensten zijn eigenlijk precies zoals ze klinken; het zijn taxi diensten vanaf uw locatie Amsterdam naar de luchthaven Schiphol.</p>

                                    <p>En natuurlijk de andere kant op , van het vliegveld naar uw woonplaats.</p>

                                    <p>U hoeft zich uiteraard niet druk te maken over het dragen van zware bagage omdat de taxi chauffeur u van dienst is.</p>

                                    <p>Uiteraard kunnen deze taxi’s worden gebruikt om naar andere locaties, zoals hotels, stations, of eigenlijk alle andere bezienswaardigheden in Amsterdam te reizen,in aanvulling op taxi vervoer van de luchthaven naar uw huis.</p>

                                    <p>Hoewel sommigen denken dat een een taxibedrijf kostbaar is, is dat in de praktijk eigenlijk helemaal niet waar. Zeker niet wanneer u kiest voor SPL.taxi voor uw luchthaven transfer!</p>

                                    <p>Hieronder staan 6 oorzaken waarom het nemen van een luchthaven taxi wenselijk is.</p>
                                    
                                </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false">
                                <a class="card-title">
                                    Transfer vanaf een aangeduide plaats in de buurt van Amsterdam naar de luchthaven Schiphol
                                </a>
                            </div>
                            <div id="collapse8" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <p>
                                        Gewoonlijk parkeert de chauffeur op de door de gebruiker aangegeven plaats en wacht hij naast het voertuig, net zoals een taxi.
Een dag voor de boekingsdatum zal het verkoopkantoor de taxidetails (naam van de chauffeur, contactpersoon en nummerplaat) naar de klant sturen, zodat u de chauffeur kunt contacteren als u de auto niet kunt vinden.
                                    </p>
                                    <p>
                                        Wanneer u in de taxi stapt, brengt de chauffeur u rechtstreeks naar de luchthaven, zodat u ruim de tijd heeft om uw paspoort en vertrekterminalgegevens te controleren.</p>
                                <p>Als u de chauffeur uw vluchtnummer doorgeeft, zet hij u af bij de juiste vertrekhal. Deze diensten zijn uitstekend voor het verminderen van stress.</p>
                                    </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse9" aria-expanded="false">
                                <a class="card-title">
                                    Vliegveld Schiphol Taxi Service: Gemakkelijk vliegveld vervoer
                                </a>
                            </div>
                            <div id="collapse9" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Het belangrijkste voordeel van het gebruik van een airport taxi service is stress reductie. Het inhuren van vervoersdiensten kan de stress en angst die vaak gevoeld wordt bij het reizen naar een verre locatie aanzienlijk verminderen.<br>Landen op een internationale luchthaven en een taxi aanhouden op een onbekende locatie kan moeilijk zijn om verschillende redenen, waaronder een gebrek aan kennis over de vreemde locatie, te veel aangerekend worden door de lokale bevolking, rijden in een onbekend voertuig en een waaier van andere mogelijkheden. Vooraf reserveren van vervoersdiensten garandeert bijna een vlottere rit door minder angst en meer comfort en veiligheid.<br>Bovendien zorgen dergelijke taxidiensten ervoor dat een professionele chauffeur u veilig naar uw gewenste locatie zal vervoeren terwijl u vaste tarieven voor de rit krijgt aangeboden.<br>Luchthaven taxi’s ook tegemoet te komen aan alle behoeften van de klant door het aanbieden van kinderzitjes of babyzitjes voor minderjarige passagiers ook.<br>Het extra voordeel van online boeken van auto’s verder vergemakkelijkt het proces voor klanten, en de verschillende betalingsmogelijkheden zoals visa, credit cards en contant geld verder helpen gasten.</p>
                                    
                                </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse10" aria-expanded="false">
                                <a class="card-title">
                                    Vliegveld Taxi Amsterdam: Reizen met comfort
                                </a>
                            </div>
                            <div id="collapse10" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Navigeren door onbekende straten kan een uitdaging zijn, en veel mensen zijn bezorgd over het vinden van een taxi wanneer ze aankomen.<br>Als u van tevoren een taxiservice boekt, zult u ongetwijfeld een professionele en plezierige reiservaring hebben.</p>
                                    <p>Deze diensten hebben professionele en ervaren chauffeurs in dienst die een positieve relatie met hun passagiers kunnen ontwikkelen en ervoor kunnen zorgen dat ze zich tijdens hun reis op hun gemak voelen.</p>
                                    <p>Een ander voordeel van het gebruik van een taxidienst is dat ze bekend zijn met lokale toeristische attracties die u kunt bezoeken op weg naar uw bestemming.</p>
                                </div>
                            </div>
                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse11" aria-expanded="false">
                                <a class="card-title">
                                    Veiligheid en betrouwbaarheid
                                </a>
                            </div>
                            <div id="collapse11" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <p>Openbaar vervoer verhoogt de kans op het zoekraken van waardevolle spullen zoals tassen, paspoorten, mobiele telefoons, enz. Zo’n incident kan uw reis verpesten, dus het is aan te raden dat u een taxidienst van de luchthaven inhuurt.<br>Zo bent u zeker dat uw bagage veilig in de servicevoertuigen zit en kunt u gerust zijn over uw bagage. Het nemen van openbaar vervoer in een vreemd land kan uw niveau van angst verhogen omdat u omringd zult zijn door vreemden, wat het risico op diefstal verhoogt. Gasten krijgen ook de mogelijkheid om het voertuig te kiezen dat het beste bij hun reiswensen past.</p>
                                    <h4>Het vooraf reserveren van uw taxi van Amsterdam naar vliegveld Schiphol zorgt ervoor dat u een goede tijd heeft en, nog belangrijker, dat uw reis vrij is van de ongemakken die uw reiservaring kunnen verpesten.</h4>
                                    <p>Of u nu een taxi nodig hebt op een binnenlandse of internationale luchthaven, het is bewezen dat het reserveren van onze taxi diensten&nbsp; u als reiziger gemak biedt.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-5 mb-3">
                <div class="fot-text fot-text2">
                    <h4> Slechts Vanaf € 30,00 Vaste Prijs met de Taxi van Amsterdam naar Schiphol!</h4>
                </div>
            </div>
            <div class="col-lg-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d78100.51610246202!2d4.85211!3d52.2862169!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x65c6cb5a6427f303!2sSchiphol%20Taxi!5e0!3m2!1snl!2snl!4v1660218568648!5m2!1snl!2snl" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%" height="450"></iframe>
            </div>
            <div class="col-lg-6">
                <div style="width: 100%"><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Amsterdam+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Population mapping</a></iframe></div>
            </div>
        </div>
    </div>
</footer>

<section class="textionline">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center">
                <form action="{{ route('reserve') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex taxiinput-box">
                                <input type="text" name="pickup_address" class="form-control pg-autocomplete"
                                    placeholder="Your Pickup Address">
                                <button type="button" class="btn btn-light"><i
                                        class="fa-solid fa-location-crosshairs"></i></button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-success w-100 text-uppercase">Reserve</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto text-center">
                <div class="headingfot">
                    <h3>Of Reserveer de Luchthaven Taxi Telefonisch</h3>
                </div>
            </div>
            <div class="col-lg-8 mx-auto text-center">
                <a href="#" class="btn btn-success bel-btn text-uppercase boxshadow">BEL 085 060 05 05</a>    
            </div>
            <div class="col-lg-12 text-center mt-4">
                <img src="{{ url('images/cropped-taxi-150x150.png') }}" alt="img">
            </div>
        </div>
    </div>
</section>

{{-- <div class="locaties-detail div-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card locaties">
                    <div class="card-body text-center">
                        <div class="card-header">
                            <h2 class="card-title">Duivendrecht<span>Schiphol</span>Taxi</h2>
                            <p>Uw betrouwbare partner in luchthaven vervoer</p>
                        </div>
                        
                        <div class="locaties-description">Duivendrecht naar Schiphol en retour<br />Auto € 40,00<br />(3 Personen 3 koffers / 4 Personen 4 trolleys)
Vanaf Station € 42,50<br />Bus tot 6 Personen € 45,00<br />Bus tot 8 Personen € 50,00</div>


                    
                    </div>
                </div>                
            </div>
            <div class="col-md-6 text-center">
                <div class="mb-4 online-reservation">
                    <a href="reserve.php" class="button button-dark big">Online Reservation</a>    
                </div>
                <div class="mb-4 online-reservation">
                    <a href="#" class="button button-light big">085 060 05 05</a>  
                </div>
                <div class="location-booking">
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInputGroup">Username</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text loc-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 30 30"><path d="M 14.984375 0.98632812 A 1.0001 1.0001 0 0 0 14 2 L 14 3.0507812 C 8.1822448 3.5345683 3.5345683 8.1822448 3.0507812 14 L 2 14 A 1.0001 1.0001 0 1 0 2 16 L 3.0507812 16 C 3.5345683 21.817755 8.1822448 26.465432 14 26.949219 L 14 28 A 1.0001 1.0001 0 1 0 16 28 L 16 26.949219 C 21.817755 26.465432 26.465432 21.817755 26.949219 16 L 28 16 A 1.0001 1.0001 0 1 0 28 14 L 26.949219 14 C 26.465432 8.1822448 21.817755 3.5345683 16 3.0507812 L 16 2 A 1.0001 1.0001 0 0 0 14.984375 0.98632812 z M 14 5.0488281 L 14 6 A 1.0001 1.0001 0 1 0 16 6 L 16 5.0488281 C 20.732953 5.5164646 24.483535 9.2670468 24.951172 14 L 24 14 A 1.0001 1.0001 0 1 0 24 16 L 24.951172 16 C 24.483535 20.732953 20.732953 24.483535 16 24.951172 L 16 24 A 1.0001 1.0001 0 0 0 14.984375 22.986328 A 1.0001 1.0001 0 0 0 14 24 L 14 24.951172 C 9.2670468 24.483535 5.5164646 20.732953 5.0488281 16 L 6 16 A 1.0001 1.0001 0 1 0 6 14 L 5.0488281 14 C 5.5164646 9.2670468 9.2670468 5.5164646 14 5.0488281 z"></path></svg></div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Location">
                        <input type="button" class="button button-light reserve-form" value="Reserve">
                    </div>
                </div>
                </div>
                

            </div>
        </div>
    </div>
</div>  --}}
@endsection