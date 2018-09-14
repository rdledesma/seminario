@push('scripts')
<script>
	
	$(document).ready(function(){
		$("#paga_con").hide();
		$("#idventa").hide();
		$("#bt_cobrar").hide();
	});

	
</script>
@endpush


<div class="modal fade modal-slide-in-right" aria-hidem="true" role="dialog" tabindex="-1" id="modal-delete-{{$ven->idventa}}">
	{{Form::open(array('action'=>array('PagoCtaCorrienteController@store'),'method'=>'post'))}}
		
    <div class="modal-dialog">
	<!-- Modal content-->
	<input  class="form-control" id="idventa" name="idventa" value = "{{$ven->idventa}}" hidden>
	<div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          
		  
          <label for="saldo"><span></span> Saldo</label>
		  <input type="text" name="saldo" class="form-control" id="saldo" placeholder="Paga Con" value = "{{$ven->saldo}}" readonly>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form">
            <div class="form-group">
              <label for="importe"><span></span> Importe</label>
              <input type="number" name="importe" class="form-control" id="importe" placeholder="Importe">
            </div>
            <div class="form-group">
              <label for="paga_con"><span class="glyphicon "></span> Paga Con</label>
              <input type="text" class="form-control" name="paga_con" id="paga_con" placeholder="Paga Con">
            </div>
			<div class="form-group">
              <label for="vuelto"><span class="glyphicon "></span> Vuelto</label>
              <input type="text" class="form-control" id="vuelto" name="vuelto" placeholder="Vuelto" readonly>
            </div>
              <button type="submit" class="btn btn-success btn-block" id="bt_cobrar"><span class="glyphicon"></span>Cobrar</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger  pull-center" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        </div>
      </div>
      
    </div>
  </div>
  {!!Form::close()!!}
@push('scripts')
<script>
	
	$(document).ready(function(){
		
		$("#importe").change(function(){
			validarimporte();
			});
	});

	var vuelto = 0;
	importe = 0;
	pago=0;
	vuelto = 0;
	function validarimporte(){
		importe = $("#importe").val();
		saldo = $("#saldo").val();
		if ( parseInt(importe) <= parseInt(saldo))
		{	
			$("#paga_con").show();
			$("#paga_con").change(function(){
				validarpago();
			});
		}
		else{
			$("#paga_con").hide();
			
		}
	}
	
	function validarpago()
	{
		pago = $("#paga_con").val();
		if ( parseInt(pago) >= parseInt(importe))
		{	
			$("#vuelto").val(pago-importe);
			$("#vuelto").show();
			$("#bt_cobrar").show();
		}
		else{
			$("#paga_con").hide();
			
			$("#bt_cobrar").hide();
		}
	}
</script>
@endpush


