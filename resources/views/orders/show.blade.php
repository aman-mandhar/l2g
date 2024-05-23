@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
<table>
    <tr>
      <td>
         <b>{{ $user->name }}</b><br>
         GST No : {{ $user->gst_no }} <br>
         Order No : {{ $order->id}}<br>
         Date : {{ $order->created_at }}<br>
      </td>
      <td>
         Customer : {{ $customer->name }}<br>
         Order Amount : {{ $order->amount }}<br>
         GST : {{ $order->gst }}<br>
      </td>
   </tr>
</table>




<table>
    <tr>
        <td>Item Name</td>
        <td>Price</td>
        <td>Quantity</td>
        <td>Total</td>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ $product->item_name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->quantity }}{{ $product->item_weight }}</td>
        <td>{{ $product->total }}</td>
   </tr>
   @endforeach
</table>
@endsection