</section>

<footer class="bg-dark text-center">
    <div class="text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="footer-newsletter">
                        <h2 class="mt-3">Newsletter</h2>
                        <p>Inscreva-se na nossa lista de e-mail para receber promoções e ofertas</p>
                        <div class="newsletter-form">
                            <form action="#">
                                <div class="form-group col-md-4 mx-auto">
                                    <input type="email" class="form-control" placeholder="Digite seu e-mail">
                                    <button type="submit" class="btn btn-warning mt-2">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-white mt-3">
                        <p>&copy; <?= date('Y'); ?>.
                            Desenvolvido por <a href="https://smwdigital.com.br" target="_blank" class="text-warning">SMW Digital</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<a href="<?= url('cart'); ?>" class="cart-button-float">
    <span class="product-qtd">
        <?php if (is_null($cart)) : ?>
            0
        <?php else : ?>
            <?= count($cart); ?>
        <?php endif; ?>
    </span>
    <i class="fas fa-shopping-cart"></i>
</a>

<!-- Latest jQuery form server -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="<?= self::loadJs('jquery.mask.min.js'); ?>"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<!-- jQuery sticky menu -->
<script src="<?= self::loadJs('owl.carousel.min.js'); ?>"></script>
<script src="<?= self::loadJs('jquery.sticky.js'); ?>"></script>

<!-- jQuery easing -->
<script src="<?= self::loadJs('jquery.easing.1.3.min.js'); ?>"></script>

<!-- Main Script -->
<script src="<?= self::loadJs('main.js'); ?>"></script>

<!-- Slider -->
<script src="<?= self::loadJs('bxslider.min.js'); ?>"></script>
<script src="<?= self::loadJs('script.slider.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('#phone').mask('(99) 99999-9999')

        $('#loadCep').click(function() {
            $.ajax({
                type: 'GET',
                url: '<?= url('cep.search') ?>',
                data: {
                    cep: $("#cep").val()
                },
                success: function(data) {
                    res = JSON.parse(data)
                    $('#address').val(res['logradouro'])
                    $('#district').val(res['bairro'])
                    $('#city').val(res['localidade'])
                    $('#state').val(res['uf'])
                    $('#complement').val(res['complemento'])
                    $('#cep').val(res['cep'])
                },
                error: function(error) {
                    alert(error)
                }
            });
        })
    })
</script>
</body>

</html>