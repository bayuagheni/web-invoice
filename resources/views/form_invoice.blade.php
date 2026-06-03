<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Data Invoice & Detail Order</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; }
        .box { max-width: 550px; background: white; padding: 30px; border-radius: 8px; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        h2 { text-align: center; margin-bottom: 20px; }
        .input-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { height: 100px; font-family: Arial, sans-serif; }
        button { width: 100%; padding: 12px; background-color: #1a1a1a; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 16px; margin-top: 10px; }
    </style>
</head>
<body>

<div class="box">
    <h2>Input Data Invoice & Order</h2>
    <form action="{{ route('invoice.generate') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="input-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" placeholder="NANA" required>
        </div>
        <div class="input-group">
            <label>No. WhatsApp</label>
            <input type="text" name="no_whatsapp" placeholder="+62 821-4056-3131" required>
        </div>
        <div class="input-group">
            <label>Nama Kain (Item 1)</label>
            <input type="text" name="produk_1" placeholder="Material Chantily Hijau Lemon" required>
        </div>
        <div class="input-group">
            <label>Harga Kain 1 (Rp)</label>
            <input type="number" name="harga_1" placeholder="120000" required>
        </div>
        <div class="input-group">
            <label>Jasa Jahit (Item 2)</label>
            <input type="text" name="produk_2" placeholder="Custom Jarit & Payet Depan">
        </div>
        <div class="input-group">
            <label>Harga Jasa 2 (Rp)</label>
            <input type="number" name="harga_2" placeholder="200000">
        </div>
        <div class="input-group">
            <label>Ongkos Kirim (Rp)</label>
            <input type="number" name="ongkir" value="0">
        </div>
        <div class="input-group">
            <label>DP Diterima (Rp)</label>
            <input type="number" name="dp" value="0">
        </div>

        <hr style="margin: 20px 0; border: 0; border-top: 1px dashed #ccc;">
        <h3 style="text-align: center;">DETAIL ORDER (SLIDE 2)</h3>

        <div class="input-group">
            <label>Ukuran Baju (SIZE)</label>
            <select name="size">
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L" selected>L</option>
                <option value="XL">XL</option>
                <option value="Custom">Custom</option>
            </select>
        </div>
        <div class="input-group">
            <label>Request Tambahan Catatan (Gunakan tanda koma "," untuk baris baru)</label>
            <textarea name="request_tambahan" placeholder="Referensi model sesuai foto kebaya pink, Payet depan saja, LD 90cm, Panjang Kebaya 50cm"></textarea>
        </div>
        <div class="input-group">
            <label>Upload Foto Bahan/Kain</label>
            <input type="file" name="foto_kain" accept="image/*">
        </div>
        <div class="input-group">
            <label>Upload Foto Model Kebaya</label>
            <input type="file" name="foto_model" accept="image/*">
        </div>

        <button type="submit">BUAT INVOICE + DETAIL ORDER</button>
    </form>
</div>

</body>
</html>