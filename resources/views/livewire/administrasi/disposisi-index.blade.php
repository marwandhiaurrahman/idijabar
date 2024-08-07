<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-adminlte-card theme="secondary" title="Data Surat Disposisi">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6"></div>
            </div>
            <ul class="products-list product-list-in-card">
                @foreach ($suratmasuks as $item)
                    <li class="item">
                        <a href="{{ route('disposisi.edit') }}?kode={{ $item->id }}">
                            <div class="product-img rounded-circle bg-danger">
                                <i class="fas fa-envelope fa-xl m-2 d-flex p-2 "></i>
                            </div>
                            <div class="product-info">
                                <div class="product-title">
                                    {{ $item->asal_surat }}
                                    <span class="badge badge-danger float-right">Belum</span>
                                </div>
                                <span class="product-description">
                                    <b>{{ $item->perihal }}</b><br>
                                    {{ $item->keterangan }}
                                </span>
                            </div>
                        </a>

                    </li>
                @endforeach
            </ul>
        </x-adminlte-card>
    </div>

</div>
