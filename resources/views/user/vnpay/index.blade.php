@extends('user.layout.main')
@section('title','Payment')
@section('content')   
<link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
<script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
<div class="container">
<form method="POST" action="{{ url('/createpayment') }}" >
    @csrf 
    <div class="form-group">
        <label for="amount">Số tiền</label>
        <input class="form-control" name="amount" type="number" value="10000"/>
    </div>  
    <div class="form-group">
        <label for="bank_code">Ngân hàng</label>
        <select name="bank_code" id="bank_code" class="form-control"> 
            <!-- <option value="VNPAYQR">VNPAYQR</option> -->
            <option value="NCB"> Ngan hang NCB</option>
            <option value="AGRIBANK"> Ngan hang Agribank</option>
            <option value="SCB"> Ngan hang SCB</option>
            <option value="SACOMBANK">Ngan hang SacomBank</option>
            <option value="EXIMBANK"> Ngan hang EximBank</option>
            <option value="MSBANK"> Ngan hang MSBANK</option>
            <option value="NAMABANK"> Ngan hang NamABank</option> 
            <option value="VIETINBANK">Ngan hang Vietinbank</option>
            <option value="VIETCOMBANK"> Ngan hang VCB</option>  
            <option value="TPBANK"> Ngan hang TPBank</option>
            <option value="OJB"> Ngan hang OceanBank</option>
            <option value="BIDV"> Ngan hang BIDV</option> 
            <option value="VPBANK"> Ngan hang VPBank</option>
            <option value="MBBANK"> Ngan hang MBBank</option> 
            <option value="OCB"> Ngan hang OCB</option>
            <option value="IVB"> Ngan hang IVB</option>
            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
        </select>
    </div>  
    <button type="submit" class="btn btn-primary" id="btnPopup">Thanh toán</button> 
</form>
</div>
@endsection