<!DOCTYPE html>
<html>
<head>
	<title>Invoice list</title>
	<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
</style>
</head>
<body>
	<center><h2>Invoice List</h2></center>
 <table style="width:100%">
  <tr>
    <th>Name:</th>
    <th>Date</td>
    	<th>Action</th>
  </tr>
 
 @foreach($invoice_data as $invoice) <tr>
    <td>{{ $invoice->customer_name }}</td>
     <td>{{ $invoice->s_date }}</td>
     <td>
     	<a href="{{URL::to('/view-invoice/'.$invoice->invoice_id)}}">View</a>
     	<a href="">Delete</a>
     </td>
  </tr>

  @endforeach
</table>


</body>
</html>