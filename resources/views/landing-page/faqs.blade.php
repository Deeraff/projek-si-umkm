@extends('layouts.app')

@section('title', 'FAQ (Pertanyaan Umum)')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-8 md:p-10 max-w-4xl mx-auto my-8">

    {{-- Judul Halaman --}}
    <h1 class="text-4xl font-extrabold text-green-700 mb-8 text-center border-b-2 border-green-200 pb-4">
        <i class="fas fa-question-circle text-green-500 mr-3"></i> Pertanyaan yang Sering Diajukan (FAQ)
    </h1>

    <div class="space-y-4">
        {{-- Gunakan @forelse untuk menangani jika tidak ada data FAQ --}}
        @forelse ($faqs as $faq)
            {{-- Elemen <details> untuk membuat accordion tanpa JavaScript --}}
            <details class="group bg-gray-50 rounded-lg p-4 transition-all duration-300 hover:bg-green-50" {{-- Hapus 'open' jika tidak ingin item pertama terbuka otomatis --}} @if($loop->first) open @endif>
                
                {{-- Bagian Pertanyaan yang selalu terlihat --}}
                <summary class="flex justify-between items-center cursor-pointer list-none">
                    <h2 class="text-lg font-semibold text-green-800">
                        {{-- Pastikan nama kolom di tabel Anda adalah 'pertanyaan' --}}
                        {{ $faq->pertanyaan }}
                    </h2>
                    <span class="transform transition-transform duration-300 group-open:rotate-180">
                        <i class="fas fa-chevron-down text-green-500"></i>
                    </span>
                </summary>

                {{-- Bagian Jawaban yang tersembunyi --}}
                <div class="mt-4 text-gray-700 leading-relaxed prose max-w-none">
                    {{-- Pastikan nama kolom di tabel Anda adalah 'jawaban' --}}
                    {!! $faq->jawaban !!}
                </div>

            </details>
        @empty
            {{-- Tampilan jika tidak ada FAQ sama sekali --}}
            <div class="text-center py-10">
                <p class="text-gray-600">Belum ada pertanyaan untuk ditampilkan saat ini.</p>
            </div>
        @endforelse
    </div>

    {{-- Link Paginasi (jika ada) --}}
    @if ($faqs->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $faqs->links() }}
        </div>
    @endif
</div>
@endsection