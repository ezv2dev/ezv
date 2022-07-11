<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>

<style>
    .lozad-gallery-load{
        background: url('{{ LazyLoad::show() }}');
    }
</style>
<script>
    lozad('.lozad', {
        load: function(el) {
            el.src = el.dataset.src;
        }
    }).observe();

    lozad('.lozad-gallery', {
        load:function (el) {
            el.style.background = `url('${el.dataset.src}')`;
        }
    }).observe();
</script>
