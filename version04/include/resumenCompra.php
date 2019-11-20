<?php /* Este include trabaja en conjunto con cargaCompra.php */ ?>
<p class="text-muted">El valor de envío se calcula de acuerdo a la cantidad y tipo de producto seleccionado.</p>
<div class="table-responsive">
    <table class="table">
    <tbody>
        <tr>
        <td>Subtotal</td>
        <th>$<?=number_format($nSubTotal, 2, ',', '.')?></th>
        </tr>
        <tr>
        <td>Envío</td>
        <th>$<?=number_format($nCostoEnvio, 2, ',', '.')?></th>
        </tr>
        <!-- <tr>
        <td>Impuestos</td>
        <th>$0.00</th>
        </tr> -->
        <tr class="total">
        <td>Total</td>
        <th>$<?=number_format($nMontoTotal, 2, ',', '.')?></th>
        </tr>
    </tbody>
    </table>
</div>
