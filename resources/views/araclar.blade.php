@extends('layouts.admin')

@section('baslik', 'Araçlar Modülü')

@section('icerik')
<div class="card card-primary card-outline">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title">Kayıtlı Araç Listesi</h3>
    <button class="btn btn-success btn-sm ml-auto" data-toggle="modal" data-target="#ekleModal">
      <i class="fas fa-plus"></i> Yeni Araç Ekle
    </button>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Marka</th>
          <th>Model</th>
          <th>Yıl</th>
          <th>Yakıt Türü</th>
          <th>Motor Gücü</th>
          <th style="width: 160px;">İşlemler</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($arabalar as $araba)
        <tr>
          <td>{{ $araba->id }}</td>
          <td>{{ $araba->marka }}</td>
          <td>{{ $araba->model }}</td>
          <td>{{ $araba->yil }}</td>
          <td>{{ $araba->yakit_turu }}</td>
          <td>{{ $araba->motor_gucu }}</td>
          <td>
            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#duzenleModal{{ $araba->id }}">
              <i class="fas fa-edit"></i>
            </button>
            <form action="/araclar/sil/{{ $araba->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Bu aracı silmek istediğine emin misin?')">
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

<!-- Yeni Araç Ekle Modalı -->
<div class="modal fade" id="ekleModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="/araclar/ekle" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Yeni Araç Ekle</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Marka</label>
          <input type="text" name="marka" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Model</label>
          <input type="text" name="model" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Yıl</label>
          <input type="number" name="yil" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Yakıt Türü</label>
          <input type="text" name="yakit_turu" class="form-control" placeholder="Örn: Benzin / LPG" required>
        </div>
        <div class="form-group">
          <label>Motor Gücü</label>
          <input type="text" name="motor_gucu" class="form-control" placeholder="Örn: 110 HP" required>
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
@foreach ($arabalar as $araba)
<div class="modal fade" id="duzenleModal{{ $araba->id }}" tabindex="-1">
  <div class="modal-dialog">
    <form action="/araclar/guncelle/{{ $araba->id }}" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Araç Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Marka</label>
          <input type="text" name="marka" value="{{ $araba->marka }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Model</label>
          <input type="text" name="model" value="{{ $araba->model }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Yıl</label>
          <input type="number" name="yil" value="{{ $araba->yil }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Yakıt Türü</label>
          <input type="text" name="yakit_turu" value="{{ $araba->yakit_turu }}" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Motor Gücü</label>
          <input type="text" name="motor_gucu" value="{{ $araba->motor_gucu }}" class="form-control" required>
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