@if(count($similar ?? []) > 0)
    <div class="mt-4 flex flex-col gap-3">
        @if($hasExactDuplicate)
            <div class="p-4 text-sm font-medium text-red-800 rounded-lg bg-red-50 border border-red-200 shadow-sm">
                <div class="flex items-start">
                    <x-heroicon-s-exclamation-circle class="w-6 h-6 text-red-600 mr-2 flex-shrink-0" />
                    <div>
                        <strong class="font-bold text-base block mb-0.5">⚠️ Bu haber zaten sistemde mevcut.</strong>
                        <p class="text-sm text-red-700">Yeni kayıt açmak yerine aşağıdaki mevcut haberi düzenlemeniz önerilir.</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="p-4 text-sm font-medium text-amber-800 rounded-lg bg-amber-50 border border-amber-200">
            <div class="flex items-start">
                <x-heroicon-s-exclamation-triangle class="w-5 h-5 text-amber-500 mr-2 mt-0.5 flex-shrink-0" />
                <div class="w-full">
                    <strong class="font-bold block text-amber-900 mb-0.5">Benzer haberler bulundu</strong>
                    <p class="text-sm text-amber-700 mb-3 hover:text-amber-800">
                        Bu başlık sistemdeki bazı haberlerle içerik veya yapısal olarak benzerlik gösteriyor. 
                    </p>
                    
                    <ul class="space-y-2">
                        @foreach($similar as $item)
                            @php
                                $isExact = $item->is_exact ?? false;
                                $scorePercent = round(($item->similarity_score ?? 0) * 100);
                                $isStrong = $scorePercent >= 70 && !$isExact;
                            @endphp
                            
                            <li class="bg-white/70 p-2.5 rounded border {{ $isExact ? 'border-red-300 ring-1 ring-red-200' : ($isStrong ? 'border-orange-300' : 'border-amber-100') }} flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="min-w-0 flex-1">
                                    <div class="font-semibold text-gray-900 truncate">
                                        {{ $item->title }}
                                        @if($isExact)
                                            <span class="inline-flex items-center ml-2 px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                                Aynı Kayıt
                                            </span>
                                        @elseif($isStrong)
                                            <span class="inline-flex items-center ml-2 px-2 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-800">
                                                ⚠️ %{{ $scorePercent }} Benzer
                                            </span>
                                        @else
                                            <span class="inline-flex items-center ml-2 px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800">
                                                %{{ $scorePercent }} Benzer
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500 flex flex-wrap items-center mt-1 gap-x-3 gap-y-1">
                                        <span class="flex items-center">
                                            <span class="w-2 h-2 rounded-full mr-1 {{ $item->status === 'published' ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                            {{ $item->status === 'published' ? 'Yayında' : ($item->status === 'draft' ? 'Taslak' : 'İncelemede') }}
                                        </span>
                                        <span class="text-gray-400">•</span>
                                        <span class="flex items-center">
                                            <x-heroicon-m-calendar class="w-3.5 h-3.5 mr-1 text-gray-400" />
                                            {{ $item->published_at ? $item->published_at->format('d.m.Y H:i') : ($item->created_at ? $item->created_at->format('d.m.Y') : 'Belirtilmedi') }}
                                        </span>
                                    </div>
                                    @if($isStrong && !$isExact)
                                        <div class="mt-1.5 text-xs text-orange-700 font-medium bg-orange-50/50 p-1 rounded">
                                            ⚠️ Yeni kayıt açmak yerine bu haberi düzenlemeniz önerilir.
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="{{ \App\Filament\Resources\NewsResource::getUrl('edit', ['record' => $item->id]) }}" target="_blank" class="w-full sm:w-auto flex items-center justify-center px-4 py-1.5 text-xs font-semibold text-white {{ $isExact ? 'bg-red-600 hover:bg-red-700' : 'bg-amber-600 hover:bg-amber-700' }} shadow-sm rounded-md transition whitespace-nowrap">
                                        <x-heroicon-m-pencil-square class="w-4 h-4 mr-1.5" />
                                        {{ $isExact ? 'Bu Haberi Düzenle' : 'Düzenle' }}
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
