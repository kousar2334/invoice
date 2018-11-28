<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
	<style type="text/css">
	table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
input{
	border:0px;
}

	</style>

</head>
<body>


<center><h2>Invoice</h2></center>
<center><h3 style="color:green;">
	<?php
	$message=Session::get('message');
	if ($message) {
		echo $message;
		Session::put('message',NULL);
	}
	?>

</h3>
</center>
<form>
	{{ csrf_field() }}
<table style="width:100%">
  <tr>
    <th>Name</th>
    <td><input type="text" name="customer_name" required="" id="customer_name"></td>
  </tr>
  <tr>
    <th>Date</th>
    <td>{{ date('d:m:Y') }}</td>
    <input type="hidden" name="service_date" value="{{ date('d:m:Y') }}" id="s_date">
  </tr>
</table>
<br><br>
<table style="width:100%">
	<tr>
		<th>Sl No</th>
		<th>Product Code</th>
		<th>Product Name</th>
		<th>Rate</th>
		<th>Qty</th>
		<th>Line Amount</th>
		<th>Action</th>
	</tr>
	<tr>
		<td>
			<?php
            $i=0;
            $i++;
            echo $i;
			?>
		</td>
		<td>
			<select name="product_code" id="product_code">
				<option>Select Product Code</option>
				@foreach($product_info as $product)
				<option value="{{ $product->product_code }}">{{ $product->product_code }}</option>
				@endforeach
			</select>
		</td>
		<td>
			<p id="product_name" style="font-size: 16px;border: 0px;"></p>
		</td>
		<td><p id="product_rate"></p></td>
		<td style="width:20px"><input type="text" name="qty" id="qty"></td>
		<td><p id="line_amount"></p></td>
		<td>
			<a href="">A</a>
			<a href="">X</a>
		</td>
	</tr>
	<tr>
		<th colspan="5" style="text-align:right;border:0px" >Total</th>
		<td colspan="2"><p id="total1"></p></td>
	</tr>
</table>
<br>
<input  type="button" value="Process" style="float:right;font-size:20px;margin-right: 1px;"id="save_btn">
</form>
<a href="{{URL::to('/view-invoice')}}">View Invoice</a>
</body>
</html>
<script s type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function(){
     $('#product_code').on('change',function(){
      var product_code=$(this).val();
       console.log(product_code); 
        $.ajax({
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
         url:"{{ URL::to('/view-product-info')}}",
         type:"POST",
         data:{'product_code':product_code},
         dataType:'json',
         success:function(data){
          console.log(data);
          $('#product_name').empty();
          $('#product_rate').empty();
            $.each(data,function(index,product_infoObj){
            	$('#product_name').append('<p>'+product_infoObj.product_name+'</p>');
            	$('#product_rate').append('<p>'+product_infoObj.rate+'</p>');
              $('#product_rat').append('<input value="'+product_infoObj.rate+'"></input>');
            })
         },
         error:function(){
          alert("error ase");
        }
      });
    });
   });
     $(document).ready(function(){
     $('#qty').keyup(function(){
      var qty1=$(this).val();
      var qty = parseInt(qty1);
      var rate1=$('#product_rate').text();
      var rate = parseFloat(rate1);
      var line_amount=qty*rate;
      var total=0;
      total=total+line_amount;
       $('#total1').empty();
       $('#line_amount').empty();
       $('#total1').append('<p>'+total+'<p>');
       $('#line_amount').append('<p>'+line_amount+'</p>');
       $('#total').append('<input value="'+total+'" ></input>')

       
    });
   });
     $(document).ready(function(){
         $('#save_btn').click(function(){
         var total1=$('#total1').text();
         var line_amount1=$('#line_amount').text();         
         var qty1=$('#qty').val();
         
         var customer_name=$('#customer_name').val();
         var s_date=$('#s_date').val();
         var product_code=$('#product_code').val();
         var qty = parseInt(qty1);
         var sub_total=parseFloat(line_amount1);
         var total=parseFloat(total1);
         
         $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:"{{URL::to('/store-invoice')}}",
          type:"POST",
          data:{'product_code':product_code,'customer_name':customer_name,'s_date':s_date,'qty':qty,'total':total,'sub_total':sub_total},
          dataType:'json',
          success:function(data){
            console.log("ok");
          },
          error:function(){
           
          },
         });

         });
  
     });
 </script>