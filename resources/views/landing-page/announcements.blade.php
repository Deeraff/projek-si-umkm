@extends('layouts.app')

@section('title', 'Pengumuman Terbaru')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-8 md:p-10 max-w-4xl mx-auto my-8">

    {{-- Judul Halaman --}}
    <h1 class="text-4xl font-extrabold text-green-700 mb-8 text-center border-b-2 border-green-200 pb-4">
        <i class="fas fa-bullhorn text-green-500 mr-3"></i> Pengumuman Terbaru
    </h1>

    <div class="space-y-6 md:space-y-8">
        @forelse ($announcements as $announcement)
            {{-- Setiap pengumuman dalam kartu yang menarik --}}
            <article class="bg-green-50 rounded-lg shadow-sm hover:shadow-md hover:bg-green-100 transition-all duration-300 p-6 border-l-4 border-green-500">
                <h2 class="text-2xl font-bold text-green-800 mb-2">
                    {{ $announcement->judul }}
                </h2>
                
                <p class="text-sm text-gray-500 mb-4 flex items-center">
                    <i class="far fa-calendar-alt mr-2 text-green-400"></i>
                    Dipublikasikan pada: {{ optional($announcement->tanggal)->format('d F Y') }}
                </p>
                
                {{-- Gunakan {!! !!} jika isi memang mengandung HTML --}}
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! $announcement->isi !!}
                </div>
            </article>
        @empty
            {{-- Tampilan jika tidak ada pengumuman --}}
            <div class="text-center py-10 bg-gray-50 rounded-lg shadow-sm">
                <p class="text-gray-600 text-lg">
                    <i class="fas fa-info-circle text-green-500 mr-2"></i>Belum ada pengumuman untuk ditampilkan saat ini.
                </p>
            </div>
        @endforelse
    </div>

    {{-- Link Paginasi (jika ada) --}}
    @if ($announcements->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $announcements->links() }}
        </div>
    @endif
</div>
@endsection