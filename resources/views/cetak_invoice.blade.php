<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $nama_pelanggan }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #2c2a29; padding: 20px; font-size: 14px; }
        .invoice-box { max-width: 750px; margin: auto; border: 1px solid #eee; padding: 30px; background: #fff; }
        .header { display: flex; justify-content: space-between; margin-bottom: 30px; }
        .header h1 { font-size: 28px; margin: 0; letter-spacing: 1px; }
        .meta-info { display: flex; justify-content: space-between; border-top: 1px solid #2c2a29; border-bottom: 1px solid #2c2a29; padding: 15px 0; margin-bottom: 30px; }
        .meta-col h4 { margin: 0 0 5px 0; font-size: 12px; color: #777; text-transform: uppercase; }
        .meta-col p { margin: 0; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th { background-color: #e5e5e5; padding: 10px; text-align: left; font-size: 12px; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .footer-sec { display: flex; justify-content: space-between; }
        .summary-table { width: 250px; }
        .summary-table td { border: none; padding: 5px; }
        .text-right { text-align: right; }
        
        /* CSS KHUSUS HALAMAN 2 (DETAIL ORDER) */
        .page-break { page-break-before: always; margin-top: 50px; border-top: 2px dashed #000; padding-top: 40px; }
        .order-grid { display: flex; gap: 20px; margin-top: 20px; }
        .order-images { display: flex; gap: 15px; width: 60%; }
        .order-images img { width: 48%; height: 280px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd; }
        .order-desc { width: 40%; }
        
        .no-print { background: #1a1a1a; color: white; padding: 10px 20px; border: none; cursor: pointer; font-weight: bold; margin-bottom: 20px; font-size: 14px; }
        @media print { 
            .no-print { display: none; } 
            .invoice-box { border: none; padding: 0; }
            .page-break { border-top: none; margin-top: 0; padding-top: 0; }
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <button class="no-print" onclick="window.print()">Cetak / Simpan Jadi PDF</button>

    <div class="header">
        <div><h1>INVOICE</h1></div>
        <div style="text-align: right; font-weight: bold;">
            KADEKKEBAYA09<br>
            <span style="font-weight: normal; font-size: 13px;">{{ $no_invoice }}</span>
        </div>
    </div>

    <div class="meta-info">
        <div class="meta-col">
            <h4>Issued To:</h4>
            <p>{{ $nama_pelanggan }}</p>
            <p style="font-weight: normal; font-size: 13px;">{{ $no_whatsapp }}</p>
        </div>
        <div class="meta-col">
            <h4>Issued Date:</h4>
            <p>{{ date('d F Y') }}</p>
        </div>
        <div class="meta-col" style="text-align: right;">
            <h4>Due Date:</h4>
            <p>{{ date('d F Y', strtotime('+14 days')) }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item Description</th>
                <th style="text-align: center; width: 40px;">Qty</th>
                <th class="text-right" style="width: 100px;">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $produk_1 }}</td>
                <td style="text-align: center;">1</td>
                <td class="text-right">Rp{{ number_format($harga_1, 0, ',', '.') }}</td>
            </tr>
            @if($produk_2)
            <tr>
                <td>{{ $produk_2 }}</td>
                <td style="text-align: center;">1</td>
                <td class="text-right">Rp{{ number_format($harga_2, 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="footer-sec">
        <div>
            <h4>Payment To:</h4>
            <p>Bank Central Asia (BCA)<br><strong>4160554903</strong><br>a/n Ni Putu Dea Sari</p>
            <p style="font-size: 12px; font-style: italic; color: #555; margin-top: 15px;">
                * Note: Pengiriman dilakukan setelah pelunasan diterima.
            </p>
        </div>
        <div>
            <table class="summary-table">
                <tr><td>Subtotal</td><td class="text-right">Rp{{ number_format($subtotal, 0, ',', '.') }}</td></tr>
                <tr><td>Ongkir</td><td class="text-right">Rp{{ number_format($ongkir, 0, ',', '.') }}</td></tr>
                <tr style="font-weight: bold;"><td>Total Pesanan</td><td class="text-right">Rp{{ number_format($total_pesanan, 0, ',', '.') }}</td></tr>
                <tr style="border-top: 1px solid #000;"><td>DP Diterima</td><td class="text-right">Rp{{ number_format($dp, 0, ',', '.') }}</td></tr>
                <tr style="font-weight: bold; font-size: 15px;"><td>Sisa Pelunasan</td><td class="text-right">Rp{{ number_format($sisa_pelunasan, 0, ',', '.') }}</td></tr>
            </table>
        </div>
    </div>


    <div class="page-break">
        <h2 style="text-transform: uppercase; margin: 0; font-size: 18px; letter-spacing: 1px;">Detail Order</h2>
        
        <div class="order-grid">
            <div class="order-images">
                @if($foto_kain_url)
                    <img src="{{ $foto_kain_url }}" alt="Foto Kain">
                @else
                    <div style="width:48%; height:280px; background:#f0f0f0; display:flex; align-items:center; justify-content:center; color:#aaa; font-size:12px;">Tidak Ada Foto Kain</div>
                @endif

                @if($foto_model_url)
                    <img src="{{ $foto_model_url }}" alt="Foto Model">
                @else
                    <div style="width:48%; height:280px; background:#f0f0f0; display:flex; align-items:center; justify-content:center; color:#aaa; font-size:12px;">Tidak Ada Foto Model</div>
                @endif
            </div>

            <div class="order-desc">
                <p><strong>Material:</strong><br>• {{ $produk_1 }}</p>
                <p><strong>SIZE:</strong> {{ $size }}</p>
                
                <p><strong>Request:</strong></p>
                <ul style="padding-left: 15px; margin: 0; line-height: 1.6;">
                    @if($request_tambahan)
                        @foreach(explode(',', $request_tambahan) as $req)
                            <li>{{ trim($req) }}</li>
                        @endforeach
                    @else
                        <li>Tidak ada request jahit khusus.</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

</div>

</body>
</html>