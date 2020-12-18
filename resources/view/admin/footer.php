</section>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<script src="<?= self::loadJs('jquery-3.4.1.min.js'); ?>"></script>
<script src="<?= self::loadJs('jquery.mask.min.js'); ?>"></script>
<script src="<?= self::loadJs('popper.min.js'); ?>"></script>
<script src="<?= self::loadJs('bootstrap.js'); ?>"></script>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    function printArea(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

    $("#phone").mask("(00) 00000-0000")

    /*if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '?php echo $_SERVER['PATH_INFO'];?>');
    }*/
</script>
</body>

</html>