@extends('layouts.admin')

@section('baslik', 'Yorumlar Modülü')

@section('icerik')
<div class="card card-primary card-outline">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">Araç Yorumları</h3>
    <button class="btn btn-success btn-sm ml-auto" data-toggle="modal" data-target="#ekleModal">
      <i class="fas fa-plus"></i> Yeni Yorum Ekle
    </button>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Araç</th>
          <th>Yazan Kişi</th>
          <th>Puan</th>
          <th>Yorum</th>
          <th style="width: 140px;">İşlemler</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($yorumlar as $yorum)
        <tr>
          <td>{{ $yorum->id }}</td>
          <td>{{ $yorum->marka ? $yorum->marka . ' ' . $yorum->model : 'Silinmiş Araç' }}</td>
          <td>{{ $yorum->yazan_ad }}</td>
          <td><span class="badge badge-warning">{{ $yorum->puan }} / 5 <i class="fas fa-star"></i></span></td>
          <td>{{ $yorum->yorum }}</td>
          <td>
            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#duzenleModal{{ $yorum->id }}">
              <i class="fas fa-edit"></i>
            </button>
            <form action="/yorumlar/sil/{{ $yorum->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Bu yorumu silmek istediğine emin misin?')">
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

<!-- Yeni Yorum Ekle Modalı -->
<div class="modal fade" id="ekleModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="/yorumlar/ekle" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Yeni Yorum Ekle</h5>
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
          <label>Yazan Kişi</label>
          <input type="text" name="yazan_ad" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Puan (1-5)</label>
          <select name="puan" class="form-control" required>
            <option value="5">5 - Çok İyi</option>
            <option value="4">4 - İyi</option>
            <option value="3">3 - Orta</option>
            <option value="2">2 - Kötü</option>
            <option value="1">1 - Çok Kötü</option>
          </select>
        </div>
        <div class="form-group">
          <label>Yorum</label>
          <textarea name="yorum" class="form-control" rows="3" required></textarea>
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
@foreach ($yorumlar as $yorum)
<div class="modal fade" id="duzenleModal{{ $yorum->id }}" tabindex="-1">
  <div class="modal-dialog">
    <form action="/yorumlar/guncelle/{{ $yorum->id }}" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Yorum Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Araç</label>
          <select name="arac_id" class="form-control" required>
            @foreach ($arabalar as $araba)
              <option value="{{ $araba->id }}" {{ $yorum->arac_id == $araba->id ? 'selected' : '' }}>
                {{ $araba->marka }} {{ $araba->model }} ({{ $araba->yil }})
              </option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label>Yazan Kişi</label>
          <input type="text" name="yazan_ad" value="{{ $yorum->yazan_ad }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Puan (1-5)</label>
          <select name="puan" class="form-control" required>
            @for ($i = 5; $i >= 1; $i--)
              <option value="{{ $i }}" {{ $yorum->puan == $i ? 'selected' : '' }}>{{ $i }} Yıldız</option>
            @endfor
          </select>
        </div>
        <div class="form-group">
          <label>Yorum</label>
          <textarea name="yorum" class="form-control" rows="3" required>{{ $yorum->yorum }}</textarea>
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