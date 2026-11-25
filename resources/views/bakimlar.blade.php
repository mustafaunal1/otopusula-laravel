@extends('layouts.admin')

@section('baslik', 'Bakım & Servis Kayıtları')

@section('icerik')
<div class="card card-primary card-outline">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">Servis ve Bakım Geçmişi</h3>
    <button class="btn btn-success btn-sm ml-auto" data-toggle="modal" data-target="#ekleModal">
      <i class="fas fa-plus"></i> Yeni Bakım Kaydı Ekle
    </button>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Araç</th>
          <th>İşlem Türü</th>
          <th>Tarih</th>
          <th>Kilometre</th>
          <th>Tutar</th>
          <th>Açıklama</th>
          <th style="width: 140px;">İşlemler</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($bakimlar as $bakim)
        <tr>
          <td>{{ $bakim->id }}</td>
          <td>{{ $bakim->marka ? $bakim->marka . ' ' . $bakim->model : 'Silinmiş Araç' }}</td>
          <td>{{ $bakim->islem_turu }}</td>
          <td>{{ $bakim->tarih }}</td>
          <td>{{ number_format($bakim->kilometre, 0, ',', '.') }} km</td>
          <td>{{ number_format($bakim->tutar, 2, ',', '.') }} TL</td>
          <td>{{ $bakim->aciklama }}</td>
          <td>
            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#duzenleModal{{ $bakim->id }}">
              <i class="fas fa-edit"></i>
            </button>
            <form action="/bakimlar/sil/{{ $bakim->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Bu bakım kaydını silmek istediğine emin misin?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Yeni Bakım Ekle Modalı -->
<div class="modal fade" id="ekleModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="/bakimlar/ekle" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Yeni Bakım Kaydı Ekle</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Araç Seçin</label>
          <select name="arac_id" class="form-control" required>
            @foreach ($arabalar as $araba)
              <option value="{{ $araba->id }}">{{ $araba->marka }} {{ $araba->model }} ({{ $araba->yil }})</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>İşlem Türü</label>
          <input type="text" name="islem_turu" class="form-control" placeholder="Örn: Periyodik Yağ Bakımı" required>
        </div>
        <div class="form-group">
          <label>Tarih</label>
          <input type="date" name="tarih" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Kilometre</label>
          <input type="number" name="kilometre" class="form-control" placeholder="Örn: 185000" required>
        </div>
        <div class="form-group">
          <label>Tutar (TL)</label>
          <input type="number" step="0.01" name="tutar" class="form-control" placeholder="Örn: 3500" required>
        </div>
        <div class="form-group">
          <label>Açıklama</label>
          <textarea name="aciklama" class="form-control" rows="2" placeholder="Opsiyonel notlar..."></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
        <button type="submit" class="btn btn-success">Kaydet</button>
      </div>
    </form>
  </div>
</div>

<!-- Düzenle Modalları -->
@foreach ($bakimlar as $bakim)
<div class="modal fade" id="duzenleModal{{ $bakim->id }}" tabindex="-1">
  <div class="modal-dialog">
    <form action="/bakimlar/guncelle/{{ $bakim->id }}" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Bakım Kaydı Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Araç</label>
          <select name="arac_id" class="form-control" required>
            @foreach ($arabalar as $araba)
              <option value="{{ $araba->id }}" {{ $bakim->arac_id == $araba->id ? 'selected' : '' }}>
                {{ $araba->marka }} {{ $araba->model }} ({{ $araba->yil }})
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>İşlem Türü</label>
          <input type="text" name="islem_turu" value="{{ $bakim->islem_turu }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Tarih</label>
          <input type="date" name="tarih" value="{{ $bakim->tarih }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Kilometre</label>
          <input type="number" name="kilometre" value="{{ $bakim->kilometre }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Tutar (TL)</label>
          <input type="number" step="0.01" name="tutar" value="{{ $bakim->tutar }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Açıklama</label>
          <textarea name="aciklama" class="form-control" rows="2">{{ $bakim->aciklama }}</textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
        <button type="submit" class="btn btn-primary">Güncelle</button>
      </div>
    </form>
  </div>
</div>
@endforeach
@endsection