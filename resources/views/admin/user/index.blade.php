@extends('layouts.admin')

@section('content')
<div class="mb-12">
    <h1 class="text-3xl font-bold font-serif leading-tight">Master Jurnalis</h1>
    <p class="text-gray-400 font-medium italic mt-1">Kelola hak akses dan peran pengguna portal berita</p>
</div>

<div class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 uppercase text-[10px] font-bold text-gray-400 tracking-[0.2em]">
                <th class="px-8 py-6">Personal Profile</th>
                <th class="px-6 py-6">Access Level</th>
                <th class="px-6 py-6 text-center">Last Activity</th>
                <th class="px-8 py-6 text-right">Peran & Otoritas</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($users as $user)
            <tr class="hover:bg-gray-50/50 transition duration-300">
                <td class="px-8 py-6">
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <div class="w-12 h-12 rounded-2xl bg-[#004743] overflow-hidden flex items-center justify-center text-brand font-black text-lg">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            @if($user->role == 'ADMIN')
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-brand rounded-full border-2 border-white flex items-center justify-center">
                                    <i data-lucide="shield-check" class="w-2.5 h-2.5 text-black"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 leading-none mb-1">{{ $user->name }}</div>
                            <div class="text-xs text-gray-400 font-medium">{{ $user->email }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest
                        {{ $user->role == 'ADMIN' ? 'bg-[#004743] text-white shadow-lg shadow-brand/10' : 'bg-gray-100 text-gray-500' }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td class="px-6 py-6 text-center">
                    <div class="flex flex-col items-center">
                        <span class="text-sm font-bold text-gray-600 italic">
                            {{ $user->last_login ? $user->last_login->diffForHumans() : 'Belum aktif' }}
                        </span>
                        <span class="text-[9px] text-gray-300 uppercase font-black mt-1">Status Login</span>
                    </div>
                </td>
                <td class="px-8 py-6 text-right">
                    @if(auth()->id() != $user->id_user)
                        <form action="{{ route('admin.users.update', $user->id_user) }}" method="POST" class="inline-block relative">
                            @csrf @method('PUT')
                            <select name="role" onchange="this.form.submit()" class="appearance-none bg-gray-50 border-none rounded-xl text-xs font-bold py-2 px-4 pr-10 focus:ring-2 focus:ring-brand/20 cursor-pointer">
                                <option value="USER" {{ $user->role == 'USER' ? 'selected' : '' }}>Set as User</option>
                                <option value="ADMIN" {{ $user->role == 'ADMIN' ? 'selected' : '' }}>Set as Admin</option>
                            </select>
                            <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                                <i data-lucide="chevron-down" class="w-3 h-3 text-gray-400"></i>
                            </div>
                        </form>
                    @else
                        <div class="inline-flex items-center space-x-2 text-brand font-black text-[10px] uppercase tracking-[0.2em] italic">
                            <i data-lucide="check-circle" class="w-3 h-3"></i>
                            <span>You (Main Admin)</span>
                        </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @if($users->hasPages())
    <div class="p-8 border-t border-gray-50">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
