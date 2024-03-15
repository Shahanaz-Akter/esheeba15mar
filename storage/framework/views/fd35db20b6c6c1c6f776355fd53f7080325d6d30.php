<script>
    var language = window.navigator.userLanguage || window.navigator.language;
    if(language=='bn'){
        window.location = "<?php echo e(url('/bn')); ?>";
    }else{
        window.location = "<?php echo e(url('/en')); ?>";
    }
</script><?php /**PATH /home/858192.cloudwaysapps.com/xnrkmuucrp/public_html/resources/views/website/index.blade.php ENDPATH**/ ?>