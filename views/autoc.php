<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<h1>Music Generator</h1>
<div class="ui-widget">
  <label for="tags">Choose your Genre </label>
  <input id="tags">
</div>

<script>
  $(function() {
    var availableTags = [
      "Rock",
      "Rap",
      "Trova",
      "Blues",
      "Country",
      "Folk",
      "Jass",
      "POP",
      "Electronic"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  });
</script>