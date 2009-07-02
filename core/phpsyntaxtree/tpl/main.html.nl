{INCLUDE}header.html{/INCLUDE}

<div id="content">

<form id="phraseform" action="{FORM_ACTION}" method="post">

<div id="form">
    <fieldset>
        <h4>Woordgroep (gelabelde haakjesnotering):</h4>

        <textarea id="data" name="data" cols="70" rows="4">{DATA_VAL}</textarea>
    
        <div id="actions">
            <button name="drawbtn" type="submit"> Tekenen </button> 
            Open haakjes: 
            <input type="text" class="readonly" name="opencount" size="2" readonly="readonly" />
            Gesloten haakjes: 
            <input type="text" class="readonly" name="closedcount" size="2" readonly="readonly" />
        </div>
    </fieldset>
</div>

<div id="phrase">
    {PHRASE}
</div>

<div id="graph">
    {GRAPH}
</div>

{SVG}

<div id="form2">
    <fieldset>
        <div id="options">
            <select name="font">
                <option value="vera_sans" {SELECT_vera_sans}>Bitstream Vera Sans</option>
                <option value="vera_serif" {SELECT_vera_serif}>Bitstream Vera Serif</option>
            </select>
            &nbsp;
            <select name="fontsize">
                <option value="8" {SELECT_size_8}>8</option>
                <option value="10" {SELECT_size_10}>10</option>
                <option value="12" {SELECT_size_12}>12</option>
                <option value="14" {SELECT_size_14}>14</option>
                <option value="16" {SELECT_size_16}>16</option>
                <option value="18" {SELECT_size_18}>18</option>
                <option value="20" {SELECT_size_20}>20</option>
                <option value="24" {SELECT_size_24}>24</option>
                <option value="36" {SELECT_size_36}>36</option>
            </select>
            &nbsp;
            <input type="checkbox" name="color"     {COLOR_VAL}     /> Kleur
            <input type="checkbox" name="antialias" {ANTIALIAS_VAL} /> Gladde lijnen
            <input type="checkbox" name="autosub"   {AUTOSUB_VAL}   /> Nummers
            <input type="checkbox" name="triangles" {TRIANGLES_VAL} /> Driehoeken
        </div>
    </fieldset>
</div>

</form>

<div id="tip">
    <strong>Tip:</strong> Klik op de boom om de afbeelding te downloaden.
</div>

</div>

{INCLUDE}footer.html{/INCLUDE}
