<script>
    var language = window.navigator.userLanguage || window.navigator.language;
    if(language=='bn'){
        window.location = "{{ url('/bn') }}";
    }else{
        window.location = "{{ url('/en') }}";
    }
</script>