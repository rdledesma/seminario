<table border="0" width="500" cellspacing="1" cellpadding="4" color="#FFFFFF">
<tbody>
<tr style="height: 22px;">
<td style="height: 22px;" valign="TOP" width="42%">
<p style="text-align: center;"><span style="font-size: 25px;" color=>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
<p style="text-align: center; margin: 0.2%;"><span style="font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
<p style="text-align: center; margin: 0.2%;"><span style="font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
<p style="text-align: center; margin: 0.2%;"><span style="font-size: 9px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
<p style="text-align: center;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>
</td>
<td style="height: 22px; text-align: center;" colspan="2" valign="TOP" width="16%">
<p style="font-size: 50px;" align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</td>
<td style="height: 22px;" valign="TOP" width="42%">
<p align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp; <strong>&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>
<p style="margin: 0.2%;" align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style="font-size: 9px; margin: 0.2%;" align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style="font-size: 9px; margin: 0.2%;" align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style="font-size: 9px; margin: 0.2%;" align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p style="font-size: 9px; margin: 0.2%;" align="CENTER">&nbsp;</p>
<p style="font-size: 9px; margin: 0.2%;" align="CENTER">&nbsp;</p>
<p style="font-size: 15px; margin: 0.2%; text-align: left;" align="CENTER">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$venta->fecha_venta}} </p>
</td>
</tr>
<tr style="height: 4px;">
<td style="height: 4px;" colspan="4" valign="TOP">
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$persona->nombre}} &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$persona->numero_documento}}</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$persona->direccion}} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  SI</p>
</td>
</tr>
<tr style="height: 4px;">
<td style="height: 4px;" colspan="4" valign="TOP">
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$venta->tipo_pago}} {{$venta->forma_pago}}</p>
</td>
</tr>
</tbody>
</table>
<table border="0" width="500" cellspacing="1" cellpadding="4">
<tbody>
<tr style="height: 20px;">
<td style="width: 60px; height: 28px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td style="width: 304px; height: 28px; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td style="width: 163px; height: 28px; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td style="width: 96px; height: 28px; text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>

@foreach($detalle as $det)
    <tr style="height: 20px;">
        <td style="width: 60px; height: 18px;">{{$det->cantidad}}</td>
        <td style="width: 304px; height: 18px;">{{$det->articulo}}</td>
        <td style="width: 304px; height: 18px;">{{$det->precio_venta}}</td>
        <td style="width: 304px; height: 18px;">{{$det->subtotal}}</td>
    </tr>
@endforeach
</tbody>
</table>
