@extends('layouts.app')

@section('title', 'Dashboard Pendaftaran - Mahira Tour')

@section('content')
<section class="bg-[#F9FAFB] min-h-screen pt-32 pb-24" x-data="dashboardApp()">
    
    <!-- Toast Container -->
    <div class="fixed top-24 md:top-6 right-6 z-50 flex flex-col gap-3 pointer-events-none w-full md:w-auto px-4 md:px-0" id="toast-container"></div>

    <div class="container-main">
        
        <!-- Success Message -->
        @if(session('success'))
        <div class="rounded-xl p-4 mb-6 flex items-start gap-3 shadow-sm border border-emerald-100 bg-emerald-50 text-emerald-800" role="alert">
            <svg class="w-5 h-5 shrink-0 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <div>{{ session('success') }}</div>
        </div>
        @endif
        
        @if(session('error'))
        <div class="rounded-xl p-4 mb-6 flex items-start gap-3 shadow-sm border border-red-100 bg-red-50 text-red-800" role="alert">
            <svg class="w-5 h-5 shrink-0 text-red-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            <div>{{ session('error') }}</div>
        </div>
        @endif
        
        <!-- Dashboard Header -->
        <div class="rounded-2xl p-6 md:p-8 mb-8 shadow-xl relative overflow-hidden text-white bg-gradient-to-br from-[#001D5F] to-[#001440]">
            
            {{-- Background Decoration --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>

            <div class="relative z-10">
                <h1 class="text-2xl md:text-3xl font-bold mb-4 font-serif">Dashboard Pendaftaran</h1>
                
                <div class="inline-block bg-white/10 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-lg font-mono text-lg mb-4">
                    {{ $registration->registration_number }}
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-white/90">
                    <div class="bg-white/5 p-4 rounded-xl border border-white/10">
                        <strong class="block text-white/60 text-xs uppercase tracking-wider mb-1">Paket</strong>
                        <span class="font-semibold">{{ $registration->schedule->package_name }}</span>
                    </div>
                    <div class="bg-white/5 p-4 rounded-xl border border-white/10">
                        <strong class="block text-white/60 text-xs uppercase tracking-wider mb-1">Jamaah</strong>
                        <span class="font-semibold">{{ $registration->num_people }} Orang</span>
                    </div>
                    <div class="bg-white/5 p-4 rounded-xl border border-white/10">
                        <strong class="block text-white/60 text-xs uppercase tracking-wider mb-1">Total Biaya</strong>
                        <span class="font-semibold uppercase tracking-tighter">Rp {{ number_format($registration->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($registration->payment_deadline)
                <div class="mt-6 inline-flex items-center gap-2 bg-red-500/10 border border-red-500/20 text-red-100 px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm">
                    <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                    Jatuh Tempo DP: {{ $registration->payment_deadline->format('d M Y') }}
                </div>
                @endif
            </div>
        </div>
        
        <!-- Progress Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-[#001D5F] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Progress Pendaftaran
                </h3>
                <div class="text-xl font-bold text-[#001D5F]">{{ $completion }}%</div>
            </div>
            
            <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden mb-2">
                <div class="h-full bg-emerald-500 rounded-full transition-all duration-1000 ease-out" style="width: {{ $completion }}%"></div>
            </div>
            
            <p class="text-sm text-gray-400">
                {{ $completion < 100 ? 'Lengkapi data untuk melanjutkan proses pendaftaran' : 'Pendaftaran lengkap! Menunggu keberangkatan' }}
            </p>
        </div>
        
        <!-- Action Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8 mb-24">
            
            <!-- Card 1: Data Jamaah -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col h-full">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
                        Data Jamaah
                    </h3>
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide {{ $registration->jamaah->every(fn($j) => $j->completion_status === 'complete') ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-orange-50 text-orange-700 border border-orange-100' }}">
                        {{ $registration->jamaah->where('completion_status', 'complete')->count() }} / {{ $registration->num_people }} Lengkap
                    </span>
                </div>
                
                <div class="p-6 flex-1">
                    @foreach($registration->jamaah as $index => $jamaah)
                    <div class="p-4 border rounded-xl mb-3 flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition-all duration-200 hover:border-blue-300 hover:shadow-sm {{ $jamaah->completion_status === 'complete' ? 'bg-emerald-50/30 border-emerald-100' : 'bg-white border-gray-200' }}">
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">
                                @if($jamaah->isPlaceholder())
                                    Jamaah {{ $index + 1 }} <span class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-0.5 rounded ml-2">Belum Dilengkapi</span>
                                @else
                                    {{ $jamaah->display_name }}
                                @endif
                            </h4>
                            <div class="text-sm flex items-center gap-1.5">
                                @if($jamaah->completion_status === 'complete')
                                    <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    <span class="text-emerald-700 font-medium">Data Lengkap</span>
                                @elseif($jamaah->completion_status === 'partial')
                                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    <span class="text-amber-700 font-medium">Sebagian Lengkap</span>
                                @else
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"></circle></svg>
                                    <span class="text-gray-500">Belum Dilengkapi</span>
                                @endif
                            </div>
                        </div>
                        <button class="inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200 {{ $jamaah->completion_status === 'complete' ? 'bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-gray-300' : 'bg-[#001D5F] text-white hover:bg-[#001440] hover:shadow-md' }}" 
                                @click="openEditJamaah({{ $jamaah->id }}, {{ $index + 1 }})">
                            {{ $jamaah->completion_status === 'complete' ? 'Edit Data' : 'Lengkapi Data' }}
                        </button>
                    </div>
                    @endforeach
                    
                    <div class="mt-4 flex items-start gap-3 p-3 bg-blue-50 text-blue-800 rounded-lg text-sm border border-blue-100">
                        <svg class="w-5 h-5 shrink-0 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        <p class="leading-relaxed">Mohon lengkapi data seluruh jamaah untuk memudahkan proses administrasi keberangkatan.</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 2: Pembayaran DP -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col h-full">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg>
                        Pembayaran DP
                    </h3>
                    @php
                        $dpStatusClass = 'bg-gray-100 text-gray-600 border-gray-200';
                        $dpStatusText = 'Belum Upload';
                        if($dpPayment && $dpPayment->status === 'verified') {
                            $dpStatusClass = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                            $dpStatusText = 'Verified';
                        } elseif($dpPayment && $dpPayment->proof_path) {
                            $dpStatusClass = 'bg-blue-50 text-blue-700 border-blue-100';
                            $dpStatusText = 'Menunggu Verifikasi';
                        }
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide border {{ $dpStatusClass }}">
                        {{ $dpStatusText }}
                    </span>
                </div>
                
                @if($dpPayment && $dpPayment->status === 'verified')
                    <!-- DP Verified -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="rounded-xl p-4 flex gap-3 text-sm bg-emerald-50 text-emerald-800 border border-emerald-100 items-start">
                            <svg class="w-5 h-5 shrink-0 text-emerald-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <div>
                                <strong class="block font-semibold mb-1">DP Sudah Diverifikasi!</strong>
                                <span class="text-emerald-700/80">Verified pada {{ $dpPayment->verified_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>
                    
                @elseif($dpPayment && ($dpPayment->proof_path || $dpPayment->status === 'bg-gray-100 text-gray-500 border-gray-200'))
                    <!-- DP Uploaded/Confirmed Cash, Waiting Verification -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="rounded-xl p-4 flex gap-3 text-sm bg-blue-50 text-blue-800 border border-blue-100 mb-4 items-start">
                            <svg class="w-5 h-5 shrink-0 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                            <div>
                                <strong class="block font-semibold mb-1">
                                    @if($dpPayment->payment_method === 'cash')
                                        Menunggu Pembayaran Cash
                                    @else
                                        Bukti DP Sudah Diupload
                                    @endif
                                </strong>
                                <span class="text-blue-700/80">
                                    @if($dpPayment->payment_method === 'cash')
                                        Silakan datang ke kantor untuk melakukan pembayaran.
                                    @else
                                        Menunggu verifikasi admin (1x24 jam)
                                    @endif
                                </span>
                            </div>
                        </div>

                        @if($dpPayment->payment_method === 'cash')
                            <div class="mt-auto text-center">
                                <a href="https://wa.me/6282184515310?text=Assalamu'alaikum%20Admin,%20saya%20{{ urlencode($registration->full_name) }}%20(Reg:%20{{ $registration->registration_number }})%20ingin%20melakukan%20pembayaran%20DP%20secara%20Cash%20di%20kantor.%20Mohon%20infonya." 
                                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-[#25D366] text-white rounded-full font-bold hover:bg-[#20bd5a] transition-colors shadow-sm w-full sm:w-auto" 
                                   target="_blank">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg>
                                    Konfirmasi Janji Temu via WA
                                </a>
                                <div class="mt-3">
                                    <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="text-sm text-gray-500 hover:text-[#001D5F] hover:underline flex items-center justify-center gap-1">
                                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                        Lihat Lokasi Kantor di Google Maps
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                @else
                    <!-- Need to Upload DP -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="text-center mb-6 mt-4">
                        <h4 class="text-gray-500 font-medium mb-1">Transfer DP 30%</h4>
                        <p class="text-2xl font-bold text-[#001D5F]">
                            Rp {{ number_format($registration->dp_amount, 0, ',', '.') }}
                        </p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 mb-6 space-y-3">
                        <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                            <div class="flex items-center gap-3">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" alt="BRI" class="h-6 w-auto">
                                <span class="font-mono text-lg font-bold text-gray-700">0117 0100 4252 303</span>
                            </div>
                            <button @click="copyAccount('011701004252303')" class="text-gray-400 hover:text-blue-600 p-2 rounded-md hover:bg-blue-50 transition-colors" title="Salin">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </button>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200">
                            <div class="flex items-center gap-3">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a0/Bank_Syariah_Indonesia.svg" alt="BSI" class="h-6 w-auto">
                                <span class="font-mono text-lg font-bold text-gray-700">7256 7665 79</span>
                            </div>
                            <button @click="copyAccount('7256766579')" class="text-gray-400 hover:text-blue-600 p-2 rounded-md hover:bg-blue-50 transition-colors" title="Salin">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </button>
                        </div>
                        <p class="text-xs text-center text-gray-400 uppercase tracking-widest font-bold mt-2">PT. Makkah Madinah Berkah Bersama</p>
                    </div>
                    
                    <form action="{{ route('register.payment', $registration->id) }}" 
                          method="POST" 
                          enctype="multipart/form-data" 
                          class="space-y-4"
                          x-data="{ method: 'transfer' }">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Metode Pembayaran</label>
                            <select name="payment_method" class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-gray-700 bg-white" x-model="method" required>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cash">Cash di Kantor</option>
                            </select>
                        </div>
                        
                        <div x-show="method === 'transfer'" class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Upload Bukti Transfer</label>
                            <input type="file" 
                                   name="payment_proof" 
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all text-sm text-gray-500" 
                                   accept="image/*,application/pdf"
                                   :required="method === 'transfer'">
                            <p class="text-xs text-gray-500">JPG, PNG, PDF (Max 2MB)</p>
                        </div>

                        <div x-show="method === 'cash'" class="rounded-lg bg-blue-50 p-4 border border-blue-100 flex gap-3 text-sm text-blue-800">
                            <svg class="w-5 h-5 shrink-0 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            <div>
                                <strong class="block mb-1">Pembayaran Cash</strong>
                                Silakan lakukan pembayaran di kantor kami. Klik tombol di bawah untuk konfirmasi.
                                <div class="mt-2">
                                    <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="text-blue-700 hover:underline flex items-center gap-1 font-semibold">
                                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                        Lihat Lokasi Kantor
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-[#001D5F] text-white py-2.5 rounded-lg font-semibold hover:bg-[#001440] transition-colors shadow-lg shadow-blue-900/10 flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" :class="method === 'transfer' ? '' : 'hidden'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <svg class="w-5 h-5" :class="method === 'transfer' ? 'hidden' : ''" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span x-text="method === 'transfer' ? 'Upload Bukti DP' : 'Konfirmasi Pembayaran Cash'"></span>
                        </button>
                    </form>
                    </div>
                @endif
            </div>
            
            <!-- Pelunasan Section -->
            @php
                $pelunasan = $registration->pelunasanPayment();
                $needsPelunasan = $registration->needsPelunasan();
            @endphp

            @if($registration->is_lunas)
                <!-- STATUS LUNAS -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col h-full mb-6">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-bold text-[#001D5F] flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Status Pembayaran
                        </h3>
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border bg-emerald-50 text-emerald-700 border-emerald-100">LUNAS</span>
                    </div>
                    <div class="p-6">
                        <div class="rounded-xl p-5 flex flex-col items-center justify-center text-center gap-3 bg-emerald-50/50 border border-emerald-100">
                            <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                            <h4 class="font-bold text-emerald-800 text-lg">Pembayaran Lunas!</h4>
                            <p class="text-sm text-emerald-700/70">Seluruh pembayaran telah diterima. Terima kasih.</p>
                        </div>
                    </div>
                </div>

            @elseif($needsPelunasan)
                <!-- CARD PELUNASAN -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col h-full mb-6">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-bold text-[#001D5F] flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg>
                            Pelunasan
                        </h3>
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border {{ $pelunasan && $pelunasan->status === 'pending' ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-amber-50 text-amber-700 border-amber-100' }}">
                            @if($pelunasan && $pelunasan->status === 'pending')
                                Menunggu Verifikasi
                            @else
                                Belum Bayar
                            @endif
                        </span>
                    </div>
                    
                    <div class="p-6">
                        <div class="text-center mb-6">
                            <span class="block text-xs text-gray-400 uppercase tracking-widest font-bold mb-1">Sisa Pelunasan</span>
                            <p class="text-3xl font-bold text-red-600">Rp {{ number_format($registration->sisaPelunasan(), 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Deadline: <strong class="text-red-600">{{ $registration->pelunasan_deadline?->format('d M Y') }}</strong></p>
                        </div>
                        
                        @if($pelunasan && ($pelunasan->status === 'pending' || $pelunasan->proof_path))
                            <div class="rounded-xl p-4 flex items-start gap-3 text-sm bg-blue-50 text-blue-800 border border-blue-100 mb-4">
                                <i class="bi bi-clock-history text-blue-500 text-lg shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="block mb-0.5">
                                        @if($pelunasan->payment_method === 'cash')
                                            Menunggu Pelunasan Cash
                                        @else
                                            Bukti Pelunasan Sudah Diupload
                                        @endif
                                    </strong>
                                    <span class="text-blue-700/70 text-xs">
                                        @if($pelunasan->payment_method === 'cash')
                                            Silakan datang ke kantor untuk melakukan pelunasan.
                                        @else
                                            Menunggu verifikasi admin (1x24 jam)
                                        @endif
                                    </span>
                                </div>
                            </div>

                            @if($pelunasan->payment_method === 'cash')
                                <div class="text-center space-y-2">
                                    <a href="https://wa.me/6282184515310?text=Assalamu'alaikum%20Admin,%20saya%20{{ urlencode($registration->full_name) }}%20(Reg:%20{{ $registration->registration_number }})%20ingin%20melakukan%20PELUNASAN%20secara%20Cash%20di%20kantor.%20Mohon%20infonya." 
                                       class="inline-flex items-center justify-center gap-2 w-full py-3 bg-[#25D366] text-white rounded-xl font-bold hover:shadow-lg transition-all no-underline" 
                                       target="_blank">
                                        <i class="bi bi-whatsapp"></i> Konfirmasi Janji Temu via WA
                                    </a>
                                    <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="inline-flex items-center justify-center gap-1 text-xs text-gray-500 hover:text-[#001D5F] no-underline">
                                        <i class="bi bi-geo-alt-fill text-red-500"></i> Lihat Lokasi Kantor
                                    </a>
                                </div>
                            @endif
                        @elseif($pelunasan && $pelunasan->status === 'rejected')
                            <div class="rounded-xl p-4 flex items-start gap-3 text-sm bg-red-50 text-red-800 border border-red-100 mb-4">
                                <i class="bi bi-exclamation-triangle-fill text-red-500 shrink-0 mt-0.5"></i>
                                <div>
                                    <strong class="block mb-0.5">Bukti ditolak!</strong>
                                    <span class="text-xs text-red-700/70">{{ $pelunasan->rejection_notes }}</span>
                                </div>
                            </div>
                        @else
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 mb-6 space-y-3">
                                <p class="text-xs text-center text-gray-400 uppercase tracking-widest font-bold">PT. Makkah Madinah Berkah Bersama</p>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded-xl">
                                        <div class="flex items-center gap-3">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg" alt="BRI" class="h-6">
                                            <span class="font-mono text-sm font-bold opacity-80">0117 0100 4252 303</span>
                                        </div>
                                        <button @click="copyAccount('011701004252303')" class="p-2 text-gray-400 hover:text-[#001D5F] hover:bg-white rounded-lg transition-colors cursor-pointer"><i class="bi bi-clipboard"></i></button>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded-xl">
                                        <div class="flex items-center gap-3">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a0/Bank_Syariah_Indonesia.svg" alt="BSI" class="h-6">
                                            <span class="font-mono text-sm font-bold opacity-80">7256 7665 79</span>
                                        </div>
                                        <button @click="copyAccount('7256766579')" class="p-2 text-gray-400 hover:text-[#001D5F] hover:bg-white rounded-lg transition-colors cursor-pointer"><i class="bi bi-clipboard"></i></button>
                                    </div>
                                </div>
                            </div>

                            @if($needsPelunasan && !$pelunasan)
                            <div class="mb-6 space-y-3">
                                <a href="https://wa.me/6282184515310?text=Halo%20Admin%20Mahira%20Tour,%0A%0ASaya%20ingin%20melakukan%20pelunasan:%0ANo.%20Registrasi:%20{{ $registration->registration_number }}%0ANama:%20{{ $registration->full_name }}%0ASisa%20Pelunasan:%20Rp%20{{ number_format($registration->sisaPelunasan(), 0, ',', '.') }}%0A%0AMohon%20info%20rekening.%20Terima%20kasih!" 
                                target="_blank"
                                class="flex items-center justify-center gap-2 w-full py-3 bg-[#25D366] text-white rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-[#20bd5a] transition-all no-underline">
                                    <i class="bi bi-whatsapp text-xl"></i>
                                    Bayar via WhatsApp Admin
                                </a>
                                <p class="text-center text-xs text-gray-400">Atau upload bukti transfer di bawah:</p>
                            </div>
                            @endif    
                            <form action="{{ route('registration.submit-pelunasan', $registration->id) }}" 
                                  method="POST" 
                                  enctype="multipart/form-data" 
                                  class="space-y-4"
                                  x-data="{ method: 'transfer' }">
                                @csrf
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Metode Pembayaran</label>
                                    <select name="payment_method" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none" x-model="method" required>
                                        <option value="transfer">Transfer Bank</option>
                                        <option value="cash">Tunai di Kantor</option>
                                    </select>
                                </div>
                                <div x-show="method === 'transfer'" class="space-y-2">
                                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider">Bukti Pelunasan (JPG/PDF)</label>
                                    <input type="file" name="payment_proof" class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[11px] file:font-bold file:bg-[#001D5F]/10 file:text-[#001D5F] hover:file:bg-[#001D5F]/20" accept="image/*,.pdf" :required="method === 'transfer'">
                                </div>

                                <div x-show="method === 'cash'" class="rounded-xl p-4 flex items-start gap-3 text-sm bg-blue-50 text-blue-800 border border-blue-100">
                                    <i class="bi bi-info-circle-fill text-blue-500 shrink-0 mt-0.5"></i>
                                    <div>
                                        <strong class="block mb-0.5">Pembayaran Tunai</strong>
                                        <span class="text-xs text-blue-700/70">Silakan datang ke kantor kami untuk pelunasan.</span>
                                        <div class="mt-2">
                                            <a href="https://www.google.com/maps/place/Travel+Umroh+Mahira+Tour/@-2.050239,101.3896565,15z" target="_blank" class="inline-flex items-center gap-1 text-xs font-bold text-blue-700 hover:underline no-underline">
                                                <i class="bi bi-geo-alt-fill text-red-500"></i> Lihat Lokasi Kantor
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="w-full py-3 rounded-xl bg-[#001D5F] text-white font-bold hover:bg-[#001440] transition-all cursor-pointer shadow-lg shadow-[#001D5F]/20 flex justify-center items-center gap-2">
                                    <i class="bi" :class="method === 'transfer' ? 'bi-cloud-upload-fill' : 'bi-check-circle-fill'"></i>
                                    <span x-text="method === 'transfer' ? 'Upload Bukti Pelunasan' : 'Konfirmasi Pelunasan Cash'"></span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
            
            <!-- Card 3: Upload Dokumen -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col h-full mb-6">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-[#001D5F] flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>
                        Upload Dokumen
                    </h3>
                    @php
                        $totalDocs = $registration->jamaah->sum(fn($j) => $j->documents->count());
                        $requiredDocs = $registration->num_people * 3;
                    @endphp
                    <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider border {{ $totalDocs >= $requiredDocs ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-amber-50 text-amber-700 border-amber-100' }}">
                        {{ $totalDocs }} / {{ $requiredDocs }} Dokumen
                    </span>
                </div>
                
                <div class="p-6">
                    @if($registration->hasDPVerified())
                        <div class="rounded-xl p-4 flex items-start gap-3 text-xs bg-blue-50/50 text-blue-800 border border-blue-100 mb-4">
                            <i class="bi bi-info-circle-fill text-blue-500 shrink-0 mt-0.5"></i>
                            <span>Upload dokumen KTP, KK, Foto, dan Buku Nikah (jika menikah) untuk setiap jamaah</span>
                        </div>
                        
                        <div class="space-y-3">
                        @foreach($registration->jamaah as $index => $jamaah)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100/80 transition-colors border border-gray-200">
                            <div>
                                <h4 class="font-bold text-[#001D5F] text-sm">{{ $jamaah->isPlaceholder() ? 'Jamaah ' . ($index + 1) : $jamaah->display_name }}</h4>
                                <span class="text-xs text-gray-400 flex items-center gap-1 mt-0.5">
                                    <i class="bi bi-file-earmark"></i> {{ $jamaah->documents->count() }} dokumen
                                </span>
                            </div>
                            <button class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg text-[13px] font-bold text-gray-600 hover:text-[#001D5F] hover:border-[#001D5F]/30 transition-colors shadow-sm cursor-pointer" @click="openDocumentModal({{ $jamaah->id }}, '{{ $jamaah->isPlaceholder() ? 'Jamaah ' . ($index + 1) : $jamaah->display_name }}', {{ $index + 1 }})">
                                <i class="bi bi-cloud-upload"></i> Upload
                            </button>
                        </div>
                        @endforeach
                        </div>
                    @else
                        <div class="rounded-xl p-4 flex items-start gap-3 text-sm bg-amber-50 text-amber-800 border border-amber-100">
                            <i class="bi bi-lock-fill text-amber-500 shrink-0 mt-0.5"></i>
                            <span class="text-xs">Upload dokumen dapat dilakukan setelah DP diverifikasi admin</span>
                        </div>
                    @endif
                </div>
            </div>
            
        </div>
        
    </div>
    
    <!-- MODAL: Edit Data Jamaah (Alpine.js) -->
    <div x-show="showJamaahModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 backdrop-blur-sm"
         @click.self="showJamaahModal = false">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col" @click.stop>
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-bold text-[#001D5F] flex items-center gap-2">
                    <i class="bi bi-person-fill-gear text-[#D4AF37]"></i> Lengkapi Data Jamaah <span x-text="jamaahNumber"></span>
                </h3>
                <button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-200 transition-colors text-gray-400 hover:text-gray-600 cursor-pointer" @click="showJamaahModal = false">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <div class="p-6 overflow-y-auto flex-1">
                <form id="formEditJamaah" @submit.prevent="submitJamaahForm">
                    <input type="hidden" x-model="jamaahId">
                    
                    <!-- Identitas -->
                    <h6 class="text-[#001D5F] font-bold mb-4 flex items-center gap-2 text-sm">
                        <i class="bi bi-person-badge text-[#D4AF37]"></i> Identitas
                    </h6>
                    
                    <div class="grid grid-cols-4 gap-3">
                        <div class="col-span-4 md:col-span-1">
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Gelar <span class="text-red-500">*</span></label>
                            <select x-model="jamaahData.title" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none bg-white" required>
                                <option value="">Pilih</option>
                                <option value="Tn.">Tn.</option>
                                <option value="Ny.">Ny.</option>
                                <option value="Nn.">Nn.</option>
                            </select>
                        </div>
                        <div class="col-span-4 md:col-span-3">
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Lengkap (Sesuai KTP) <span class="text-red-500">*</span></label>
                            <input type="text" x-model="jamaahData.full_name" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none" required>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-4 gap-3 mt-3">
                        <div class="col-span-4 md:col-span-2">
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">NIK <span class="text-red-500">*</span></label>
                            <input type="text" x-model="jamaahData.nik" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none" maxlength="16" required>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Kelamin <span class="text-red-500">*</span></label>
                            <select x-model="jamaahData.gender" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none bg-white" required>
                                <option value="">-</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-span-2 md:col-span-1">
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Gol. Darah</label>
                            <select x-model="jamaahData.blood_type" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none bg-white">
                                <option value="">-</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" x-model="jamaahData.birth_place" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" x-model="jamaahData.birth_date" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none" required>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Status Pernikahan <span class="text-red-500">*</span></label>
                            <select x-model="jamaahData.marital_status" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none bg-white" required>
                                <option value="">Pilih</option>
                                <option value="single">Belum Menikah</option>
                                <option value="married">Menikah</option>
                                <option value="divorced">Cerai</option>
                                <option value="widowed">Duda/Janda</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Ayah Kandung <span class="text-red-500">*</span></label>
                            <input type="text" x-model="jamaahData.father_name" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none" required>
                            <span class="text-[10px] text-gray-400 mt-1">Untuk keperluan passport</span>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Pekerjaan <span class="text-red-500">*</span></label>
                        <input type="text" x-model="jamaahData.occupation" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none" required>
                    </div>
                    
                    <!-- Alamat -->
                    <h6 class="text-[#001D5F] font-bold mt-8 mb-4 flex items-center gap-2 text-sm">
                        <i class="bi bi-geo-alt-fill text-[#D4AF37]"></i> Alamat
                    </h6>
                    
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea x-model="jamaahData.address" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none" rows="2" required></textarea>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Provinsi</label>
                            <input type="text" x-model="jamaahData.province" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Kota/Kabupaten</label>
                            <input type="text" x-model="jamaahData.city" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none">
                        </div>
                    </div>
                    
                    <!-- Kontak Darurat -->
                    <h6 class="text-[#001D5F] font-bold mt-8 mb-4 flex items-center gap-2 text-sm">
                        <i class="bi bi-telephone-fill text-[#D4AF37]"></i> Kontak Darurat
                    </h6>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Nama <span class="text-red-500">*</span></label>
                            <input type="text" x-model="jamaahData.emergency_name" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none" required>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Hubungan <span class="text-red-500">*</span></label>
                            <select x-model="jamaahData.emergency_relation" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none bg-white" required>
                                <option value="">Pilih</option>
                                <option value="ayah">Ayah</option>
                                <option value="ibu">Ibu</option>
                                <option value="suami">Suami</option>
                                <option value="istri">Istri</option>
                                <option value="anak">Anak</option>
                                <option value="saudara">Saudara</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">No. Telepon <span class="text-red-500">*</span></label>
                            <input type="tel" x-model="jamaahData.emergency_phone" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#001D5F]/20 outline-none" required>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3 bg-gray-50/50">
                <button type="button" class="px-5 py-2.5 text-gray-500 font-bold hover:bg-gray-100 rounded-xl transition-colors cursor-pointer text-sm" @click="showJamaahModal = false">Batal</button>
                <button type="button" class="px-5 py-2.5 bg-[#001D5F] text-white font-bold rounded-xl hover:bg-[#001440] transition-colors shadow-lg shadow-[#001D5F]/20 flex items-center gap-2 cursor-pointer text-sm" @click="submitJamaahForm" :disabled="isSubmitting">
                    <span x-show="!isSubmitting"><i class="bi bi-save"></i> Simpan Data</span>
                    <span x-show="isSubmitting"><i class="bi bi-hourglass-split"></i> Menyimpan...</span>
                </button>
            </div>
        </div>
    </div>
    
    <!-- MODAL: Upload Dokumen (Alpine.js) -->
    <div x-show="showDocModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 backdrop-blur-sm"
         @click.self="showDocModal = false">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col" @click.stop>
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-bold text-[#001D5F] flex items-center gap-2">
                    <i class="bi bi-file-earmark-arrow-up text-[#D4AF37]"></i> Upload Dokumen - <span x-text="docJamaahName"></span>
                </h3>
                <button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-200 transition-colors text-gray-400 hover:text-gray-600 cursor-pointer" @click="showDocModal = false">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            
            <div class="p-6 overflow-y-auto flex-1">
                <form id="formUploadDoc" @submit.prevent="submitDocuments">
                    <input type="hidden" x-model="docJamaahId">
                    
                    <!-- KTP & KK (Wajib Mutlak) -->
                    <div class="mb-6">
                        <h6 class="text-[#001D5F] font-bold mb-4 flex items-center gap-2 text-sm">
                            <i class="bi bi-star-fill text-[#D4AF37]"></i> Dokumen Wajib
                        </h6>
                        
                        <!-- KTP -->
                        <div class="border border-gray-200 rounded-xl p-4 bg-gray-50 transition-colors mb-3" :class="{ 'bg-emerald-50/50 border-emerald-200': documents.ktp.file }">
                            <div class="flex justify-between items-center mb-2">
                                <div class="font-bold text-[#001D5F] text-sm">KTP <span class="text-red-500">*</span></div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border" :class="documents.ktp.file ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-gray-100 text-gray-400 border-gray-200'">
                                    <span x-text="documents.ktp.file ? 'Siap Upload' : 'Belum Upload'"></span>
                                </span>
                            </div>
                            
                            <template x-if="!documents.ktp.file">
                                <label class="mt-2 cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-[#001D5F] hover:bg-[#001D5F]/5 transition-all text-center gap-2">
                                    <input type="file" class="hidden" accept="image/*,.pdf" @change="handleFileSelect($event, 'ktp')">
                                    <i class="bi bi-cloud-upload text-gray-400 text-xl"></i>
                                    <span class="text-sm text-gray-500 font-medium">Klik untuk upload KTP</span>
                                    <span class="text-[10px] text-gray-400">JPG, PNG, PDF (Max 2MB)</span>
                                </label>
                            </template>
                            
                            <template x-if="documents.ktp.file">
                                <div class="flex justify-between items-center p-3 bg-white rounded-xl border border-gray-200 mt-2">
                                    <div class="flex items-center gap-2 text-sm text-gray-600 truncate">
                                        <i class="bi bi-file-earmark-check-fill text-emerald-500 text-lg"></i>
                                        <span x-text="documents.ktp.file.name"></span>
                                    </div>
                                    <button type="button" class="text-red-400 hover:text-red-600 p-1 cursor-pointer" @click="removeFile('ktp')"><i class="bi bi-trash"></i></button>
                                </div>
                            </template>
                        </div>
                        
                        <!-- Kartu Keluarga -->
                        <div class="border border-gray-200 rounded-xl p-4 bg-gray-50 transition-colors mb-3" :class="{ 'bg-emerald-50/50 border-emerald-200': documents.kk.file }">
                            <div class="flex justify-between items-center mb-2">
                                <div class="font-bold text-[#001D5F] text-sm">Kartu Keluarga (KK) <span class="text-red-500">*</span></div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border" :class="documents.kk.file ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-gray-100 text-gray-400 border-gray-200'">
                                    <span x-text="documents.kk.file ? 'Siap Upload' : 'Belum Upload'"></span>
                                </span>
                            </div>
                            
                            <template x-if="!documents.kk.file">
                                <label class="mt-2 cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-[#001D5F] hover:bg-[#001D5F]/5 transition-all text-center gap-2">
                                    <input type="file" class="hidden" accept="image/*,.pdf" @change="handleFileSelect($event, 'kk')">
                                    <i class="bi bi-cloud-upload text-gray-400 text-xl"></i>
                                    <span class="text-sm text-gray-500 font-medium">Klik untuk upload KK</span>
                                    <span class="text-[10px] text-gray-400">JPG, PNG, PDF (Max 2MB)</span>
                                </label>
                            </template>
                            
                            <template x-if="documents.kk.file">
                                <div class="flex justify-between items-center p-3 bg-white rounded-xl border border-gray-200 mt-2">
                                    <div class="flex items-center gap-2 text-sm text-gray-600 truncate">
                                        <i class="bi bi-file-earmark-check-fill text-emerald-500 text-lg"></i>
                                        <span x-text="documents.kk.file.name"></span>
                                    </div>
                                    <button type="button" class="text-red-400 hover:text-red-600 p-1 cursor-pointer" @click="removeFile('kk')"><i class="bi bi-trash"></i></button>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Dokumen Pendukung (Pilih Satu) -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <h6 class="text-[#001D5F] font-bold mb-2 flex items-center gap-2 text-sm">
                            <i class="bi bi-check-circle-fill text-emerald-500"></i> Dokumen Pendukung (Wajib Pilih Salah Satu)
                        </h6>
                        <p class="text-xs text-gray-400 mb-4">Silakan upload minimal satu dari dokumen berikut:</p>
                        
                        <div class="flex gap-2 mb-4">
                            <button type="button" class="px-4 py-2 rounded-lg text-xs font-bold transition-all cursor-pointer" :class="activeTab === 'ijazah' ? 'bg-[#001D5F] text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-500 hover:border-[#001D5F] hover:text-[#001D5F]'" @click="activeTab = 'ijazah'">Ijazah</button>
                            <button type="button" class="px-4 py-2 rounded-lg text-xs font-bold transition-all cursor-pointer" :class="activeTab === 'buku_nikah' ? 'bg-[#001D5F] text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-500 hover:border-[#001D5F] hover:text-[#001D5F]'" @click="activeTab = 'buku_nikah'">Buku Nikah</button>
                            <button type="button" class="px-4 py-2 rounded-lg text-xs font-bold transition-all cursor-pointer" :class="activeTab === 'akta' ? 'bg-[#001D5F] text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-500 hover:border-[#001D5F] hover:text-[#001D5F]'" @click="activeTab = 'akta'">Akta Lahir</button>
                        </div>

                        <!-- Ijazah Upload -->
                        <div x-show="activeTab === 'ijazah'" x-transition>
                            <label class="cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-[#001D5F] hover:bg-[#001D5F]/5 transition-all text-center gap-2">
                                <input type="file" class="hidden" accept="image/*,.pdf" @change="handleFileSelect($event, 'ijazah')">
                                <i class="bi bi-cloud-upload text-gray-400 text-xl"></i>
                                <span class="text-sm text-gray-500 font-medium" x-text="documents.ijazah.file ? documents.ijazah.file.name : 'Upload Ijazah Terakhir'"></span>
                            </label>
                            <div class="mt-2 flex items-center justify-end gap-2" x-show="documents.ijazah.file">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-100">Siap Upload</span>
                                <button type="button" class="text-xs text-red-500 hover:text-red-700 font-bold cursor-pointer" @click="removeFile('ijazah')">Hapus</button>
                            </div>
                        </div>

                        <!-- Buku Nikah Upload -->
                        <div x-show="activeTab === 'buku_nikah'" x-transition>
                            <label class="cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-[#001D5F] hover:bg-[#001D5F]/5 transition-all text-center gap-2">
                                <input type="file" class="hidden" accept="image/*,.pdf" @change="handleFileSelect($event, 'buku_nikah')">
                                <i class="bi bi-cloud-upload text-gray-400 text-xl"></i>
                                <span class="text-sm text-gray-500 font-medium" x-text="documents.buku_nikah.file ? documents.buku_nikah.file.name : 'Upload Buku Nikah'"></span>
                            </label>
                            <div class="mt-2 flex items-center justify-end gap-2" x-show="documents.buku_nikah.file">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-100">Siap Upload</span>
                                <button type="button" class="text-xs text-red-500 hover:text-red-700 font-bold cursor-pointer" @click="removeFile('buku_nikah')">Hapus</button>
                            </div>
                        </div>

                        <!-- Akta Upload -->
                        <div x-show="activeTab === 'akta'" x-transition>
                            <label class="cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-[#001D5F] hover:bg-[#001D5F]/5 transition-all text-center gap-2">
                                <input type="file" class="hidden" accept="image/*,.pdf" @change="handleFileSelect($event, 'akta_kelahiran')">
                                <i class="bi bi-cloud-upload text-gray-400 text-xl"></i>
                                <span class="text-sm text-gray-500 font-medium" x-text="documents.akta_kelahiran.file ? documents.akta_kelahiran.file.name : 'Upload Akta Kelahiran'"></span>
                            </label>
                            <div class="mt-2 flex items-center justify-end gap-2" x-show="documents.akta_kelahiran.file">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-100">Siap Upload</span>
                                <button type="button" class="text-xs text-red-500 hover:text-red-700 font-bold cursor-pointer" @click="removeFile('akta_kelahiran')">Hapus</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Passport Section (Optional) -->
                    <div class="pt-4 border-t border-gray-200">
                         <div class="flex justify-between items-center mb-4">
                            <h6 class="text-[#001D5F] font-bold flex items-center gap-2 text-sm">
                                <i class="bi bi-passport text-[#D4AF37]"></i> Passport (Opsional)
                            </h6>
                            <label class="relative inline-flex items-center cursor-pointer gap-2">
                                <input type="checkbox" class="sr-only peer" id="hasPassport" x-model="showPassportUpload">
                                <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#001D5F]"></div>
                                <span class="text-xs text-gray-500 font-medium">Sudah punya passport</span>
                            </label>
                        </div>

                        <div x-show="showPassportUpload" x-transition>
                            <div class="border border-gray-200 rounded-xl p-4 bg-gray-50 transition-colors" :class="{ 'bg-emerald-50/50 border-emerald-200': documents.passport.file }">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="font-bold text-[#001D5F] text-sm">Upload Passport</div>
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border" :class="documents.passport.file ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-gray-100 text-gray-400 border-gray-200'">
                                        <span x-text="documents.passport.file ? 'Siap Upload' : 'Belum Upload'"></span>
                                    </span>
                                </div>
                                <template x-if="!documents.passport.file">
                                    <label class="mt-2 cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-[#001D5F] hover:bg-[#001D5F]/5 transition-all text-center gap-2">
                                        <input type="file" class="hidden" accept="image/*,.pdf" @change="handleFileSelect($event, 'passport')">
                                        <i class="bi bi-cloud-upload text-gray-400 text-xl"></i>
                                        <span class="text-sm text-gray-500 font-medium">Klik untuk upload Passport</span>
                                    </label>
                                </template>
                                <template x-if="documents.passport.file">
                                    <div class="flex justify-between items-center p-3 bg-white rounded-xl border border-gray-200 mt-2">
                                        <div class="flex items-center gap-2 text-sm text-gray-600 truncate"><span x-text="documents.passport.file.name"></span></div>
                                        <button type="button" class="text-red-400 hover:text-red-600 p-1 cursor-pointer" @click="removeFile('passport')"><i class="bi bi-trash"></i></button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3 bg-gray-50/50">
                <button type="button" class="px-5 py-2.5 text-gray-500 font-bold hover:bg-gray-100 rounded-xl transition-colors cursor-pointer text-sm" @click="showDocModal = false">Batal</button>
                <button type="button" class="px-5 py-2.5 bg-[#001D5F] text-white font-bold rounded-xl hover:bg-[#001440] transition-colors shadow-lg shadow-[#001D5F]/20 flex items-center gap-2 cursor-pointer text-sm" @click="submitDocuments" :disabled="isUploading || !canSubmitDocs">
                    <span x-show="!isUploading"><i class="bi bi-cloud-upload"></i> Upload Dokumen</span>
                    <span x-show="isUploading"><i class="bi bi-hourglass-split"></i> Mengupload...</span>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Contact CS Sticky -->
<div class="fixed bottom-6 right-6 z-40">
    <a href="https://wa.me/6282184515310?text=Halo%20Mahira%20Tour,%20saya%20butuh%20bantuan.%20Nomor%20Registrasi:%20{{ $registration->registration_number }}" 
       class="flex items-center gap-2 px-5 py-3 bg-[#25D366] text-white rounded-full font-bold shadow-lg hover:bg-[#20bd5a] transition-all transform hover:scale-105" 
       target="_blank">
        <i class="bi bi-whatsapp"></i>
        <span>Butuh Bantuan?</span>
    </a>
</div>
@endsection

@push('scripts')
<script>
function dashboardApp() {
    return {
        // Modal States
        showJamaahModal: false,
        showDocModal: false,
        
        // Jamaah Data
        jamaahId: null,
        jamaahNumber: '',
        jamaahData: {
            title: '',
            full_name: '',
            nik: '',
            gender: '',
            blood_type: '',
            birth_place: '',
            birth_date: '',
            marital_status: '',
            father_name: '',
            occupation: '',
            address: '',
            province: '',
            city: '',
            emergency_name: '',
            emergency_relation: '',
            emergency_phone: ''
        },
        
        // Document Data
        docJamaahId: null,
        docJamaahName: '',
        activeTab: 'ijazah',
        documents: {
            ktp: { file: null, preview: null, exists: false },
            kk: { file: null, preview: null, exists: false },
            ijazah: { file: null, preview: null, exists: false },
            akta_kelahiran: { file: null, preview: null, exists: false },
            buku_nikah: { file: null, preview: null, exists: false },
            passport: { file: null, preview: null, exists: false }
        },
        noPassport: false,
        
        // Loading States
        isSubmitting: false,
        isUploading: false,
        
        // Computed
        get canSubmitDocs() {
            return this.documents.ktp.file && this.documents.kk.file && this.documents.photo.file;
        },
        
        // Methods
        copyAccount(text) {
            navigator.clipboard.writeText(text);
            this.showToast('Nomor rekening berhasil dicopy!', 'success');
        },

        showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;
            const toast = document.createElement('div');
            
            // Tailwind classes
            const bgColor = type === 'success' ? 'bg-emerald-50 text-emerald-800 border-emerald-100' : 'bg-red-50 text-red-800 border-red-100';
            const iconColor = type === 'success' ? 'text-emerald-500' : 'text-red-500';
            const iconClass = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill';
            
            toast.className = `${bgColor} border shadow-lg rounded-xl p-4 flex items-center gap-3 transform transition-all duration-300 translate-x-10 opacity-0 pointer-events-auto min-w-[300px]`;
            
            toast.innerHTML = `
                <i class="bi ${iconClass} ${iconColor} text-xl"></i>
                <div class="font-medium text-sm">${message}</div>
            `;
            
            container.appendChild(toast);
            
            // Trigger animation
            requestAnimationFrame(() => {
                toast.classList.remove('translate-x-10', 'opacity-0');
            });
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-10', 'opacity-0');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        },
        
        async openEditJamaah(id, number) {
            this.jamaahId = id;
            this.jamaahNumber = number;
            
            try {
                const response = await fetch(`/api/jamaah/${id}?token={{ request('token') }}`);
                const data = await response.json();
                
                this.jamaahData = {
                    title: data.title || '',
                    full_name: data.full_name && !data.full_name.includes('Belum Dilengkapi') ? data.full_name : '',
                    nik: data.nik !== 'PENDING' ? data.nik : '',
                    gender: data.gender || '',
                    blood_type: data.blood_type || '',
                    birth_place: data.birth_place !== '-' ? data.birth_place : '',
                    birth_date: data.birth_date || '',
                    marital_status: data.marital_status || '',
                    father_name: data.father_name !== '-' ? data.father_name : '',
                    occupation: data.occupation !== '-' ? data.occupation : '',
                    address: data.address !== '-' ? data.address : '',
                    province: data.province || '',
                    city: data.city || '',
                    emergency_name: data.emergency_name !== '-' ? data.emergency_name : '',
                    emergency_relation: data.emergency_relation !== '-' ? data.emergency_relation : '',
                    emergency_phone: data.emergency_phone !== '-' ? data.emergency_phone : ''
                };
                
                this.showJamaahModal = true;
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memuat data jamaah');
            }
        },
        
        async submitJamaahForm() {
            this.isSubmitting = true;
            
            try {
                const response = await fetch(`/api/jamaah/${this.jamaahId}?token={{ request('token') }}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(this.jamaahData)
                });
                
                const data = await response.json();
                
                if (data.success) {
                    alert('✅ Data jamaah berhasil disimpan!');
                    location.reload();
                } else {
                    alert('❌ ' + (data.message || 'Gagal menyimpan data'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan saat menyimpan data');
            } finally {
                this.isSubmitting = false;
            }
        },
        
        async openDocumentModal(jamaahId, jamaahName, index) {
            this.docJamaahId = jamaahId;
            this.docJamaahName = jamaahName;
            
            // Reset state
            this.activeTab = 'ijazah';
            this.showPassportUpload = false;
            this.noPassport = false;

            // Reset documents
            this.documents = {
                ktp: { file: null, preview: null, exists: false },
                kk: { file: null, preview: null, exists: false },
                ijazah: { file: null, preview: null, exists: false },
                akta_kelahiran: { file: null, preview: null, exists: false },
                buku_nikah: { file: null, preview: null, exists: false },
                passport: { file: null, preview: null, exists: false }
            };
            this.noPassport = false;
            
            // Fetch existing documents
            try {
                const response = await fetch(`/api/jamaah/${jamaahId}?token={{ request('token') }}`);
                const data = await response.json();
                
                if (data.documents) {
                    Object.keys(data.documents).forEach(type => {
                        if (this.documents[type]) {
                            this.documents[type].exists = true;
                            this.documents[type].preview = data.documents[type].url;
                            // Dummy file object for display logic
                            this.documents[type].file = { name: data.documents[type].file_name, size: 0 }; 
                        }
                    });

                    // Set active tab based on existing docs
                    if (this.documents.buku_nikah.exists) this.activeTab = 'buku_nikah';
                    else if (this.documents.akta_kelahiran.exists) this.activeTab = 'akta';
                    else if (this.documents.ijazah.exists) this.activeTab = 'ijazah';
                    
                    if (this.documents.passport.exists) this.showPassportUpload = true;
                }
                
                if (data.need_passport) {
                    this.noPassport = true;
                }
            } catch (error) {
                console.error('Error fetching docs:', error);
            }
            
            this.showDocModal = true;
        },
        
        handleFileSelect(event, docType) {
            const file = event.target.files[0];
            if (!file) return;
            
            // Validate file size (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('❌ Ukuran file maksimal 2MB');
                event.target.value = '';
                return;
            }
            
            this.documents[docType].file = file;
            this.documents[docType].exists = false; // Reset exists flag as this is new
            
            // Create preview for images
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.documents[docType].preview = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                this.documents[docType].preview = null;
            }
        },
        
        removeFile(docType) {
            this.documents[docType] = { file: null, preview: null, exists: false };
        },
        
        formatFileSize(bytes) {
            if (bytes === 0) return 'Existing File';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },
        
        async submitDocuments() {
            // Check if required docs are present (either existing or new file)
            // Note: KTP, KK are always required
            const ktpOk = this.documents.ktp.file;
            const kkOk = this.documents.kk.file;
            
            if (!ktpOk || !kkOk) {
                alert('❌ Mohon upload dokumen wajib: KTP dan Kartu Keluarga');
                return;
            }

            // Check One of Three (Ijazah / Buku Nikah / Akta)
            const hasIjazah = this.documents.ijazah.file;
            const hasBukuNikah = this.documents.buku_nikah.file;
            const hasAkta = this.documents.akta_kelahiran.file;
            
            if (!hasIjazah && !hasBukuNikah && !hasAkta) {
                alert('❌ Wajib upload salah satu: Ijazah / Buku Nikah / Akta Kelahiran');
                return;
            }
            
            this.isUploading = true;
            this.showToast('Sedang mengupload dokumen...', 'info');
            
            try {
                const docTypes = ['ktp', 'kk', 'ijazah', 'akta_kelahiran', 'buku_nikah', 'passport'];
                let uploadCount = 0;
                
                for (const docType of docTypes) {
                    // Only upload if it's a NEW file (instanceof File)
                    if (this.documents[docType].file && this.documents[docType].file instanceof File) {
                        const formData = new FormData();
                        formData.append('jamaah_id', this.docJamaahId);
                        formData.append('document_type', docType);
                        formData.append('document', this.documents[docType].file);
                        
                        const response = await fetch(`/register/{{ $registration->id }}/documents`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });
                        
                        if (!response.ok) {
                            throw new Error(`Gagal upload ${docType}`);
                        }
                        uploadCount++;
                    }
                }
                
                // Save no passport preference
                if (this.noPassport) {
                    await fetch(`/api/jamaah/${this.docJamaahId}/passport-request?token={{ request('token') }}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ need_passport: true })
                    });
                }
                
                if (uploadCount > 0 || this.noPassport) {
                    alert('✅ Dokumen berhasil diupdate!');
                    location.reload();
                } else {
                    alert('⚠️ Tidak ada dokumen baru yang diupload.');
                    this.showDocModal = false;
                }
                
            } catch (error) {
                console.error('Error:', error);
                alert('❌ ' + error.message);
            } finally {
                this.isUploading = false;
            }
        }
    }
}
</script>
@endpush