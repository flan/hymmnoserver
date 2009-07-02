{INCLUDE}header.html{/INCLUDE}

<div id="content">

<form id="phraseform" action="{FORM_ACTION}" method="post">

<div id="form">
    <fieldset>
        <h4>Woordgroep (in gelabelde haakjesnotering):</h4>

        <textarea id="data" name="data" cols="70" rows="4">{DATA_VAL}</textarea>
    
        <div id="actions">
            <input type="hidden" name="color" value="on" />
            <input type="hidden" name="antialias" value="on" />
            <input type="hidden" name="autosub" value="on" />
            <input type="hidden" name="triangles" value="on" />
            <button name="drawbtn" type="submit"> Tekenen </button> 
            Open haakjes: 
            <input type="text" class="readonly" name="opencount" size="2" readonly="readonly" value="n/a" />
            Gesloten haakjes: 
            <input type="text" class="readonly" name="closedcount" size="2" readonly="readonly" value="n/a" />
        </div>
    </fieldset>
</div>

</form>

<div id="intro">

<div id="about">

<h2>Over phpSyntaxTree</h2>

<p>
    Met phpSyntaxTree kun je afbeeldingen maken (syntactische bomen) van woordgroepen 
in een gelabelde haakjesnotering. Deze afbeeldingen kun je vervolgens opnemen in huiswerkopdrachten of portfolio's.
</p>
<p>
    Stuur je commentaar en suggesties (in het Engels!) naar 
    <a href="mailto:andre@ironcreek.net">andre@ironcreek.net</a>.
</p>

</div>

<div id="usage">

<h2>Gebruiksaanwijzing</h2>

<p>
    Voer een woordgroep in en gebruik daarbij een gelabelde haakjesnotering. Klik op &quot;Tekenen&quot; om de 
syntactische boom van die woordgroep te laten maken. Klik met de rechtermuisknop om de afbeelding te kopiëren 
en te plakken. Klik met de linkermuisknop op de afbeelding om die te downloaden.
</p>
<p>
    Wil je een knoop tekenen met <b>ondergeschreven</b> tekens? Scheid het ondergeschreven deel 
dan van de standaard-tekst met het teken _. Voorbeeld: &quot;NP_1&quot; ziet er in de afbeelding 
uit als NP<sub>1</sub>. Kies eventueel <b>Nummers</b>: knopen met dezelfde naam worden 
dan automatisch in onderschrift genummerd (NP<sub>1</sub>, NP<sub>2</sub> enz.).
</p>
<p>
    Schakel <B>Kleur</b> en/of <b>Gladde lijnen</b> uit om de afbeelding geschikter te maken voor een zwart-witprinter.
</p>

</div>

</div>

<div id="news">
    {INCLUDE}news.html.nl{/INCLUDE}
</div>

</div>

{INCLUDE}footer.html{/INCLUDE}
