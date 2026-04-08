@extends('layouts.app')

@section('content')
<div>
  <div class="sec-hd">
    <div>
      <div class="sec-kicker">Kategori</div>
      <h1 class="sec-title ui-section-title">{{ $category->name }}</h1>
    </div>
  </div>

  @if(!empty($search))
    <div class="news-meta" style="margin-bottom: 16px;">
      <span>Arama: "{{ $search }}"</span>
    </div>
  @endif

  <x-news.news-list :paginator="$items" />
</div>
@endsection
