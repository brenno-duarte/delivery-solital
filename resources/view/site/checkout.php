<?php include('header.php'); ?>

<div class="container-fluid">
	<div class="row bg-warning">
		<div class="col-md-12">
			<div class="text-center p-3">
				<p class="display-4">Pagamento</p>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 mb-4">
			<form action="<?= url('checkout.finished.post') ?>" method="POST">
				<?= csrf_token(); ?>
				<div class="row">
					<div class="col-md-12">

						<p class="h3 mt-5">Endereço de entrega</p>

						<div class="row mt-3">
							<div class="col-md-6">
								<p class="form-row">
									<label for="end">Endereço</label>

									<input type="text" placeholder="Logradouro, número e bairro" id="end" name="address" class="form-control" required>
								</p>
							</div>

							<div class="col-md-3">
								<p class="form-row">
									<label for="bairro">Bairro</label>

									<input type="text" placeholder="Cidade" id="bairro" name="district" class="form-control" required>
								</p>
							</div>

							<div class="col-md-3">
								<p class="form-row">
									<label for="cidade">Cidade</label>

									<input type="text" placeholder="Cidade" id="cidade" name="city" class="form-control" required>
								</p>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-2">
								<p class="form-row">
									<label for="num">Número</label>

									<input type="number" placeholder="Número" id="num" name="number" class="form-control" required>
								</p>
							</div>

							<div class="col-sm-4">
								<label for="comp">Complemento</label>

								<input type="text" placeholder="Complemento (opcional)" id="comp" name="complement" class="form-control">
							</div>
						</div>

						<p class="h3 mt-5">Detalhes do Pedido</p>
						<table class="table table-bordered text-center mt-3">
							<thead>
								<tr class="bg-light text-uppercase">
									<th scope="col">Produto</th>
									<th scope="col">Preço</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($cart as $cart) : ?>
									<tr>
										<td class="align-middle">
											<?= $cart->name; ?>
											<span class="font-weight-bold h5">(x<?= $cart->qtd; ?>)</span>
										</td>
										<td class="align-middle price" id="price">
											R$ <span><?= $cart->price * $cart->qtd; ?></span>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr>
									<th class="bg-light text-uppercase align-middle">Total do Pedido</th>
									<td><strong><span class="font-1 align-middle">R$ <?= $total; ?></span></strong></td>
								</tr>
							</tfoot>
						</table>

						<table class="table table-bordered text-center mt-5">
							<thead>
								<tr class="bg-light text-uppercase">
									<th scope="col">Tipo de pagamento</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="align-middle">
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="entrega" value="Pagamento na entrega" name="payment">
											<label class="custom-control-label" for="entrega">Pagamento na entrega</label>
										</div>
									</td>
								</tr>
								<tr>
									<td class="align-middle">
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="cartao" value="Cartão" name="payment">
											<label class="custom-control-label" for="cartao">Cartão</label>
										</div>
									</td>
								</tr>
							</tbody>
						</table>

						<div class="form-row">
							<button type="submit" class="btn btn-warning mx-auto">Continuar</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include('footer-cart.php'); ?>